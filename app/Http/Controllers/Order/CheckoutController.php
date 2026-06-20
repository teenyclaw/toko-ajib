<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use App\Support\OrderSessionCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class CheckoutController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    public function show()
    {
        $cart = OrderSessionCart::get();

        if (empty($cart)) {
            return redirect()->route('order.catalog')->with('error', 'Keranjang masih kosong.');
        }

        $cartCount = OrderSessionCart::totalQty();

        return view('order.checkout', compact('cart', 'cartCount'));
    }

    public function store(Request $request)
    {
        $cart = OrderSessionCart::get();

        if (empty($cart)) {
            return redirect()->route('order.catalog')->with('error', 'Keranjang masih kosong.');
        }

        $key = 'order-checkout:' . ($request->ip() ?? 'unknown');
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->with('error', 'Terlalu banyak percobaan. Coba lagi dalam ' . $seconds . ' detik.');
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:30',
            'address' => 'nullable|string|max:1000',
            'notes'   => 'nullable|string|max:1000',
        ]);

        RateLimiter::hit($key, 60);

        try {
            $order = $this->orderService->createFromCart($validated, $cart);
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal membuat pesanan. Silakan coba lagi.');
        }

        return redirect()->route('order.thanks', $order->order_number);
    }

    public function thanks(string $orderNumber)
    {
        $order = Order::with('items')
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        $storeWhatsAppUrl = $this->orderService->buildNewOrderToStoreWhatsAppUrl($order);
        $storeName        = $this->orderService->storeSettings()->store_name;

        return view('order.thanks', compact('order', 'storeWhatsAppUrl', 'storeName'));
    }
}
