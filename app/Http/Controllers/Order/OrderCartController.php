<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\OrderService;
use App\Support\OrderSessionCart;
use App\Support\OrderUnits;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderCartController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    public function index()
    {
        return redirect()->route('order.catalog', ['cart' => 'open']);
    }

    public function data()
    {
        return response()->json($this->cartPayload());
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty'        => 'integer|min:1|max:9999',
            'unit'       => ['nullable', Rule::in(OrderUnits::all())],
            'note'       => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($request->product_id);

        try {
            $this->orderService->addProductToCart(
                $product,
                (int) ($request->qty ?? 1),
                $request->unit ?? 'pcs',
                $request->note
            );
        } catch (\InvalidArgumentException $e) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }

            return back()->with('error', $e->getMessage());
        }

        $payload = array_merge(['status' => 'success', 'message' => $product->name . ' ditambahkan'], $this->cartPayload());

        if ($request->expectsJson()) {
            return response()->json($payload);
        }

        return back()->with('success', $product->name . ' ditambahkan ke keranjang.');
    }

    public function update(Request $request, string $lineKey)
    {
        $request->validate([
            'qty'  => 'required|integer|min:0|max:9999',
            'unit' => ['nullable', Rule::in(OrderUnits::all())],
            'note' => 'nullable|string|max:500',
        ]);

        try {
            $this->orderService->updateCartItem(
                $lineKey,
                (int) $request->qty,
                $request->unit,
                $request->has('note') ? $request->note : null
            );
        } catch (\InvalidArgumentException $e) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }

            return back()->with('error', $e->getMessage());
        }

        if ($request->expectsJson()) {
            return response()->json(array_merge(['status' => 'success'], $this->cartPayload()));
        }

        return redirect()->route('order.catalog', ['cart' => 'open'])->with('success', 'Keranjang diperbarui.');
    }

    public function remove(string $lineKey, Request $request)
    {
        $this->orderService->removeFromCart($lineKey);

        if ($request->expectsJson()) {
            return response()->json(array_merge(['status' => 'success'], $this->cartPayload()));
        }

        return redirect()->route('order.catalog', ['cart' => 'open'])->with('success', 'Item dihapus dari keranjang.');
    }

    private function cartPayload(): array
    {
        $cart  = OrderSessionCart::get();
        $items = [];

        foreach ($cart as $id => $item) {
            $unit = $item['unit'] ?? 'pcs';
            $items[] = [
                'id'         => (string) $id,
                'name'       => $item['name'],
                'qty'        => (int) $item['qty'],
                'unit'       => $unit,
                'unit_label' => OrderUnits::label($unit),
                'note'       => $item['note'] ?? null,
                'stock'      => (int) ($item['stock'] ?? 9999),
            ];
        }

        return [
            'items'     => $items,
            'total_qty' => OrderSessionCart::totalQty(),
            'count'     => count($cart),
        ];
    }
}
