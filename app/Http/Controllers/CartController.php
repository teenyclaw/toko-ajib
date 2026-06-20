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

class CartController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    private function isCustomItem($id, ?array $item = null): bool
    {
        if (!empty($item['custom'])) {
            return true;
        }

        return str_starts_with((string) $id, 'custom_');
    }

    public function updateManual(Request $request)
    {
        $cart = session()->get('cart', []);
        $id   = $request->id;
        if (isset($cart[$id])) {
            if ($request->has('name') && trim((string) $request->name) !== '') {
                $cart[$id]['name'] = trim((string) $request->name);
            }
            if ($request->has('qty') && $request->has('price')) {
                $cart[$id]['qty']   = max(1, (int)$request->qty);
                $cart[$id]['price'] = max(0, (int)$request->price);
            }
            if ($request->type == 'qty')   $cart[$id]['qty']   = max(1, (int)$request->value);
            if ($request->type == 'price') $cart[$id]['price'] = max(0, (int)$request->value);
        }
        session()->put('cart', $cart);
        return response()->json($this->calculateCart($cart));
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

        // Jika bayar kurang, WAJIB ada pelanggan untuk mencatat utang
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
            $isCustom = $this->isCustomItem($cartKey, $item);

            SaleItem::create([
                'sale_id'    => $sale->id,
                'product_id' => $isCustom ? null : (int) $cartKey,
                'name'       => $item['name'] ?? null,
                'qty'        => $item['qty'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['qty'],
            ]);

            if (!$isCustom) {
                $product = Product::find((int) $cartKey);
                if ($product) {
                    $product->stock -= $item['qty'];
                    $product->save();
                }
            }
        }

        // Catat utang jika bayar kurang
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
        if (isset($cart[$id])) {
            if ($action == 'plus')  $cart[$id]['qty']++;
            if ($action == 'minus') {
                $cart[$id]['qty']--;
                if ($cart[$id]['qty'] <= 0) unset($cart[$id]);
            }
        }
        session()->put('cart', $cart);
        return response()->json($this->calculateCart($cart));
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
            $cart[$id]['total'] = $item['price'] * $item['qty'];
            $grandTotal += $cart[$id]['total'];
        }

        return ['cart' => $cart, 'grandTotal' => $grandTotal];
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart    = session()->get('cart', []);
        $price   = $request->price ?? $product->harga_jual_pcs;
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                'name'      => $product->name,
                'price'     => (int)$price,
                'qty'       => 1,
                'order'     => CartOrder::next($cart),
                'harga_pcs' => $product->harga_jual_pcs,
                'harga_dus' => $product->harga_jual_dus ?? $product->harga_jual_pcs,
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
        return response()->json($this->calculateCart($cart));
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
