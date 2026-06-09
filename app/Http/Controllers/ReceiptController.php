<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class ReceiptController extends Controller
{
    public function show($id)
{
    $sale = \App\Models\Sale::findOrFail($id);

    $items = \App\Models\SaleItem::where('sale_id', $id)->get();

    return view('receipt', [
        'sale' => $sale,
        'cart' => $items,
        'total' => $sale->total // 🔥 INI SOLUSI UTAMA
    ]);
}
}