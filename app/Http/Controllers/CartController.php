<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Debt;
use App\Models\Order;
use App\Services\OrderService;
use App\Support\CartOrder;
use App\Support\OrderUnits;

class CartController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    private function isCustomItem($id, ?array $item = null): bool
    {
        if (!empty($item['product_id'])) {
            return false;
        }

        if (!empty($item['custom'])) {
            return true;
        }

        return str_starts_with((string) $id, 'custom_');
    }

    private function productIdForItem(string $cartKey, array $item): ?int
    {
        if (!empty($item['product_id'])) {
            return (int) $item['product_id'];
        }

        if ($this->isCustomItem($cartKey, $item)) {
            return null;
        }

        if (ctype_digit((string) $cartKey)) {
            return (int) $cartKey;
        }

        return null;
    }

    private function priceForUnit(?Product $product, string $unit, ?int $fallback = null): int
    {
        if (!$product) {
            return (int) ($fallback ?? 0);
        }

        return $unit === 'dus'
            ? (int) ($product->harga_jual_dus ?? $product->harga_jual_pcs)
            : (int) $product->harga_jual_pcs;
    }

    private function saleItemName(array $item): string
    {
        $name = $item['name'] ?? 'Item';
        $unit = $item['unit'] ?? 'pcs';

        if ($unit !== 'pcs') {
            $name .= ' [' . OrderUnits::label($unit) . ']';
        }

        if (!empty($item['note'])) {
            $name .= ' — ' . $item['note'];
        }

        return $name;
    }

    public function updateManual(Request $request)
    {
        $request->validate([
            'id'    => 'required|string',
            'name'  => 'nullable|string|max:255',
            'qty'   => 'nullable|integer|min:1|max:9999',
            'price' => 'nullable|integer|min:0',
            'unit'  => ['nullable', 'in:' . implode(',', OrderUnits::all())],
            'note'  => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        $id   = $request->id;

        if (!isset($cart[$id])) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Item tidak ditemukan di keranjang',
            ], 404);
        }

        if ($request->has('name') && trim((string) $request->name) !== '') {
            $cart[$id]['name'] = trim((string) $request->name);
        }

        if ($request->has('unit')) {
            $unit = OrderUnits::normalize($request->unit);
            $cart[$id]['unit'] = $unit;

            $productId = $this->productIdForItem($id, $cart[$id]);
            if ($productId) {
                $product = Product::find($productId);
                if ($product) {
                    $cart[$id]['price'] = $this->priceForUnit($product, $unit, $cart[$id]['price'] ?? 0);
                    $cart[$id]['harga_pcs'] = $product->harga_jual_pcs;
                    $cart[$id]['harga_dus'] = $product->harga_jual_dus ?? $product->harga_jual_pcs;
                }
            }
        }

        if ($request->has('note')) {
            $note = trim((string) $request->note);
            $cart[$id]['note'] = $note !== '' ? $note : null;
        }

        if ($request->has('qty') && $request->has('price')) {
            $cart[$id]['qty']   = max(1, (int) $request->qty);
            $cart[$id]['price'] = max(0, (int) $request->price);
        }

        if ($request->type == 'qty') {
            $cart[$id]['qty'] = max(1, (int) $request->value);
        }

        if ($request->type == 'price') {
            $cart[$id]['price'] = max(0, (int) $request->value);
        }

        session()->put('cart', $cart);

        return response()->json(array_merge(
            ['status' => 'success'],
            $this->calculateCart($cart)
        ));
    }

    public function addManual(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty'   => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $id   = 'custom_' . (int) (microtime(true) * 1000);

        $cart[$id] = [
            'name'   => trim($request->name),
            'price'  => (int) $request->price,
            'qty'    => (int) $request->qty,
            'unit'   => 'pcs',
            'order'  => CartOrder::next($cart),
            'custom' => true,
        ];

        session()->put('cart', $cart);

        return response()->json(['status' => 'success']);
    }

    public function checkoutAjax(Request $request)
    {
        $cart = CartOrder::ensure(session()->get('cart', []));
        if (empty($cart)) {
            return response()->json(['status'=>'error','message'=>'Keranjang kosong']);
        }

        $paid       = (int) $request->paid;
        $customerId = $request->customer_id ?? null;
        $grandTotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        if ($paid < $grandTotal && !$customerId) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Bayar kurang? Pilih pelanggan untuk mencatat utang'
            ]);
        }

        if (!$customerId) {
            return response()->json(['status'=>'error','message'=>'Pilih pelanggan dulu!']);
        }

        $change = max(0, $paid - $grandTotal);

        $sale = Sale::create([
            'invoice'     => 'INV-' . time(),
            'total'       => $grandTotal,
            'paid'        => $paid,
            'change'      => $change,
            'customer_id' => $customerId,
        ]);

        foreach ($cart as $cartKey => $item) {
            $productId = $this->productIdForItem((string) $cartKey, $item);

            SaleItem::create([
                'sale_id'    => $sale->id,
                'product_id' => $productId,
                'name'       => $this->saleItemName($item),
                'qty'        => $item['qty'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['qty'],
            ]);

            if ($productId) {
                $product = Product::find($productId);
                if ($product) {
                    $product->stock -= $item['qty'];
                    $product->save();
                }
            }
        }

        $debtAmount = $grandTotal - $paid;
        if ($debtAmount > 0 && $customerId) {
            Debt::create([
                'customer_id' => $customerId,
                'sale_id'     => $sale->id,
                'amount'      => $debtAmount,
                'paid'        => 0,
                'remaining'   => $debtAmount,
                'note'        => $request->debt_note ?? 'Kekurangan pembayaran invoice ' . $sale->invoice,
                'status'      => 'unpaid',
                'due_date'    => $request->due_date ?? null,
            ]);
        }

        $pendingOrderId = session('pending_order_id');
        session()->forget('cart');

        $whatsappUrl = null;
        $orderNumber = null;

        if ($pendingOrderId) {
            $order = Order::find($pendingOrderId);
            if ($order && in_array($order->status, ['pending', 'processing'], true)) {
                $order = $this->orderService->completeOrder($order, $sale, auth()->id());
                $orderNumber = $order->order_number;
                $whatsappUrl = $this->orderService->buildReceiptWhatsAppUrl(
                    $sale,
                    $order->customer_phone
                );
            }
            session()->forget('pending_order_id');
        }

        return response()->json([
            'status'        => 'success',
            'change'        => $change,
            'sale_id'       => $sale->id,
            'has_debt'      => $debtAmount > 0,
            'debt_amount'   => $debtAmount,
            'order_number'  => $orderNumber,
            'whatsapp_url'  => $whatsappUrl,
        ]);
    }

    public function update($id, $action)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json([
                'status'     => 'error',
                'message'    => 'Item tidak ditemukan di keranjang',
                'cart'       => $cart,
                'grandTotal' => 0,
            ], 404);
        }

        if ($action === 'plus') {
            $cart[$id]['qty']++;
        } elseif ($action === 'minus') {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Aksi tidak valid',
            ], 422);
        }

        session()->put('cart', $cart);

        return response()->json(array_merge(
            ['status' => 'success'],
            $this->calculateCart($cart)
        ));
    }

    public function cartData()
    {
        $cart = session()->get('cart', []);
        $data = $this->calculateCart($cart);

        $pendingOrderId = session('pending_order_id');
        if ($pendingOrderId) {
            $order = Order::find($pendingOrderId);
            if ($order) {
                $data['pending_order'] = [
                    'id'           => $order->id,
                    'order_number' => $order->order_number,
                    'status'       => $order->status,
                ];
            }
        }

        return response()->json($data);
    }

    private function calculateCart($cart)
    {
        $cart = CartOrder::ensure($cart);
        session()->put('cart', $cart);

        $grandTotal = 0;
        foreach ($cart as $id => $item) {
            $unit = $item['unit'] ?? 'pcs';
            $cart[$id]['unit']       = $unit;
            $cart[$id]['unit_label'] = OrderUnits::label($unit);
            $cart[$id]['note']       = $item['note'] ?? null;
            $cart[$id]['total']      = $item['price'] * $item['qty'];
            $cart[$id]['cart_key']   = (string) $id;
            $cart[$id]['is_custom']  = $this->isCustomItem($id, $item);
            $cart[$id]['from_order'] = !empty($item['from_order']);
            $grandTotal += $cart[$id]['total'];
        }

        return [
            'cart'       => $cart,
            'grandTotal' => $grandTotal,
            'units'      => OrderUnits::unitOptions(),
        ];
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart    = session()->get('cart', []);
        $price   = $request->price ?? $product->harga_jual_pcs;
        $qty     = max(1, (int) ($request->qty ?? 1));
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
            $cart[$product->id]['order'] = CartOrder::next($cart);
        } else {
            $cart[$product->id] = [
                'name'       => $product->name,
                'price'      => (int) $price,
                'qty'        => $qty,
                'unit'       => 'pcs',
                'product_id' => $product->id,
                'order'      => CartOrder::next($cart),
                'harga_pcs'  => $product->harga_jual_pcs,
                'harga_dus'  => $product->harga_jual_dus ?? $product->harga_jual_pcs,
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['status' => 'success']);
    }

    public function delete($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) unset($cart[$id]);
        session()->put('cart', $cart);
        return response()->json(array_merge(
            ['status' => 'success'],
            $this->calculateCart($cart)
        ));
    }

    public function index()
    {
        $cart = CartOrder::ensure(session()->get('cart', []));
        session()->put('cart', $cart);

        return view('cart.index', compact('cart'));
    }

    public function clear()
    {
        $this->orderService->releaseProcessingOrder(session('pending_order_id'));

        session()->forget(['cart', 'pending_order_id']);

        return response()->json([
            'status'     => 'success',
            'cart'       => [],
            'grandTotal' => 0,
            'message'    => 'Keranjang dikosongkan',
        ]);
    }
}
