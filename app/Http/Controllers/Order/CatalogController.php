<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Support\OrderSessionCart;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    public function index(Request $request)
    {
        $query = $this->orderService->orderableProductsQuery();

        if ($categoryId = $request->get('category')) {
            $query->where('category_id', $categoryId);
        }

        $products   = $query->get();
        $categories = $products->pluck('category')->filter()->unique('id')->sortBy('name');
        $cart       = OrderSessionCart::get();
        $cartCount  = OrderSessionCart::totalQty();
        $search     = trim((string) $request->get('q', ''));

        return view('order.catalog', compact('products', 'categories', 'cart', 'cartCount', 'search'));
    }
}
