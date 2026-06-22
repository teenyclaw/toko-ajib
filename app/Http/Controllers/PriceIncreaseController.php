<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Support\PriceCalculator;
use Illuminate\Http\Request;

class PriceIncreaseController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.price-increase', compact('categories'));
    }

    public function print(Request $request)
    {
        $rawItems = $request->input('items');

        if ($request->filled('payload')) {
            $decoded = json_decode($request->input('payload'), true);
            $rawItems = $decoded['items'] ?? [];
            $request->merge(['items' => $rawItems]);
        }

        $request->validate([
            'items'                   => 'required|array|min:1',
            'items.*.id'              => 'required|exists:products,id',
            'items.*.margin_dus'      => 'required|numeric|min:0',
            'items.*.margin_dus_type' => 'required|in:percent,nominal',
            'items.*.margin_pcs'      => 'required|numeric|min:0',
            'items.*.margin_pcs_type' => 'required|in:percent,nominal',
        ]);

        $items = [];

        foreach ($request->items as $row) {
            $product = Product::findOrFail($row['id']);

            $prices = PriceCalculator::calcSellingPrices(
                (float) $product->harga_beli_dus,
                (int) $product->qty_per_dus,
                (float) $row['margin_dus'],
                $row['margin_dus_type'],
                (float) $row['margin_pcs'],
                $row['margin_pcs_type'],
            );

            $items[] = [
                'name'           => $product->name,
                'harga_jual_pcs' => $prices['harga_jual_pcs'],
                'harga_jual_dus' => $prices['harga_jual_dus'],
            ];
        }

        $date = now()->format('d/m/Y');

        return view('products.price-increase-print', compact('items', 'date'));
    }
}
