<?php

namespace App\Http\Controllers;

use App\Support\CartOrder;

class ScanController extends Controller
{
    public function handle($code)
    {
        $product = \App\Models\Product::where('barcode', $code)->first();

        if (!$product) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan',
            ]);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                'name'  => $product->name,
                'price' => $product->harga_jual_pcs,
                'qty'   => 1,
                'order' => CartOrder::next($cart),
            ];
        }

        $cart = CartOrder::ensure($cart);
        session()->put('cart', $cart);

        return response()->json([
            'status'     => 'success',
            'cart'       => $cart,
            'grandTotal' => collect($cart)->sum(fn($item) => $item['price'] * $item['qty']),
        ]);
    }
}
