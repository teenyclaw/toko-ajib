<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function handle($code)
{
    $product = \App\Models\Product::where('barcode', $code)->first();

    if(!$product){
        return response()->json([
            'status' => 'error',
            'message' => 'Produk tidak ditemukan'
        ]);
    }

    $cart = session()->get('cart', []);

    if(isset($cart[$product->id])){
        $cart[$product->id]['qty']++;
    } else {
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->harga_jual_pcs,
            'qty' => 1
        ];
    }

    session()->put('cart', $cart);

    return response()->json([
    'status' => 'success',
    'cart' => $cart,
    'grandTotal' => collect($cart)->sum(function($item){
        return $item['price'] * $item['qty'];
    })
]);

function renderCart(cart, grandTotal) {
    let tbody = document.querySelector('#cart-table tbody');
    tbody.innerHTML = '';

    for (let id in cart) {
        let item = cart[id];

        let row = `
            <tr>
                <td>${item.name}</td>
                <td>${item.qty}</td>
                <td>${item.price * item.qty}</td>
            </tr>
        `;

        tbody.innerHTML += row;
    }

    document.getElementById('grand-total').innerText = grandTotal;
}
}
}
