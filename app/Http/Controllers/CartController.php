<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Debt;

class CartController extends Controller
{
    public function updateManual(Request $request)
    {
        $cart = session()->get('cart', []);
        $id   = $request->id;
        if (isset($cart[$id])) {
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

    public function checkoutAjax(Request $request)
    {
        $cart = session()->get('cart', []);
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

        foreach ($cart as $productId => $item) {
            SaleItem::create([
                'sale_id'    => $sale->id,
                'product_id' => $productId,
                'qty'        => $item['qty'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['qty'],
            ]);
            $product = Product::find($productId);
            if ($product) {
                $product->stock -= $item['qty'];
                $product->save();
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

        session()->forget('cart');

        return response()->json([
            'status'      => 'success',
            'change'      => $change,
            'sale_id'     => $sale->id,
            'has_debt'    => $debtAmount > 0,
            'debt_amount' => $debtAmount,
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

    private function calculateCart($cart)
    {
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
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'status'     => 'success',
            'cart'       => [],
            'grandTotal' => 0,
            'message'    => 'Keranjang dikosongkan',
        ]);
    }
}
