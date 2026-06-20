<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class PosOrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    public function index()
    {
        $orders = $this->orderService->pendingOrdersQuery()->get()->map(fn (Order $order) => [
            'id'             => $order->id,
            'order_number'   => $order->order_number,
            'customer_name'  => $order->customer_name,
            'customer_phone' => $order->customer_phone,
            'customer_address' => $order->customer_address,
            'notes'          => $order->notes,
            'status'         => $order->status,
            'item_count'     => $order->items->sum('qty'),
            'items_preview'  => $order->items->take(3)->pluck('product_name')->join(', '),
            'created_at'     => $order->created_at?->format('d/m/Y H:i'),
        ]);

        return response()->json([
            'count'  => $this->orderService->pendingCount(),
            'orders' => $orders,
        ]);
    }

    public function pendingCount()
    {
        return response()->json([
            'count'     => $this->orderService->pendingCount(),
            'latest_id' => $this->orderService->latestPendingId(),
        ]);
    }

    public function history(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = trim((string) $request->get('search', ''));

        $orders = $this->orderService
            ->historyQuery($status !== 'all' ? $status : null, $search ?: null)
            ->paginate(25)
            ->withQueryString();

        $stats = $this->orderService->orderStats();

        return view('orders.index', compact('orders', 'stats', 'status', 'search'));
    }

    public function show(int $id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return response()->json([
            'id'               => $order->id,
            'order_number'     => $order->order_number,
            'customer_name'    => $order->customer_name,
            'customer_phone'   => $order->customer_phone,
            'customer_address' => $order->customer_address,
            'notes'            => $order->notes,
            'status'           => $order->status,
            'created_at'       => $order->created_at?->format('d/m/Y H:i'),
            'items'            => $order->items->map(fn ($item) => [
                'product_name' => $item->product_name,
                'qty'          => $item->qty,
                'unit'         => $item->unit,
                'stock'        => $item->product?->stock,
            ]),
        ]);
    }

    public function loadToCart(int $id)
    {
        $order = Order::findOrFail($id);

        try {
            $result = $this->orderService->loadToPosCart($order, auth()->id());
        } catch (\InvalidArgumentException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }

        return response()->json(array_merge(['status' => 'success'], $result));
    }

    public function cancel(int $id)
    {
        $order = Order::findOrFail($id);

        try {
            $this->orderService->cancelOrder($order, auth()->id());
        } catch (\InvalidArgumentException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Pesanan dibatalkan',
            'count'   => $this->orderService->pendingCount(),
        ]);
    }
}
