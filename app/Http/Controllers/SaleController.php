<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Customer;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->period ?? 'daily';
        $date   = $request->date   ?? now()->toDateString();
        $week   = $request->week   ?? now()->format('Y-\WW');
        $month  = $request->month  ?? now()->format('Y-m');

        $query = Sale::with(['customer', 'items.product']);

        if ($period === 'daily') {
            $query->whereDate('created_at', $date);
        } elseif ($period === 'weekly') {
            $start = Carbon::parse($week . '-1')->startOfWeek();
            $end   = $start->copy()->endOfWeek();
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($period === 'monthly') {
            [$y, $m] = explode('-', $month);
            $query->whereYear('created_at', $y)->whereMonth('created_at', $m);
        }

        $sales      = $query->latest()->get();
        $totalOmzet = $sales->sum('total');
        $customers  = Customer::orderBy('name')->get();
        $products   = Product::with('category')->orderBy('name')->get();

        return view('transactions.index', compact(
            'sales','totalOmzet','customers','products',
            'period','date','week','month'
        ));
    }

    // GET detail untuk panel
    public function detail($id)
    {
        $sale = Sale::with(['customer','items.product'])->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'sale'   => [
                'id'          => $sale->id,
                'invoice'     => $sale->invoice,
                'customer_id' => $sale->customer_id,
                'customer'    => $sale->customer?->name ?? 'Umum',
                'total'       => $sale->total,
                'paid'        => $sale->paid,
                'change'      => $sale->change,
                'created_at'  => $sale->created_at->format('d M Y, H:i'),
                'items'       => $sale->items->map(fn($i) => [
                    'id'         => $i->id,
                    'product_id' => $i->product_id,
                    'name'       => $i->name ?? $i->product?->name ?? '—',
                    'qty'        => $i->qty,
                    'price'      => $i->price,
                    'total'      => $i->total,
                ]),
            ],
        ]);
    }

    // UPDATE transaksi (edit items + paid + customer)
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'paid'        => 'required|numeric|min:0',
            'items'       => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty'        => 'required|integer|min:1',
            'items.*.price'      => 'required|numeric|min:0',
        ]);

        $sale  = Sale::with('items')->findOrFail($id);
        $items = $request->items;

        // Restore stok lama
        foreach ($sale->items as $old) {
            if (!$old->product_id) continue;
            $p = Product::find($old->product_id);
            if ($p) { $p->increment('stock', $old->qty); }
        }

        // Hapus items lama
        $sale->items()->delete();

        // Hitung total baru
        $grandTotal = collect($items)->sum(fn($i) => $i['price'] * $i['qty']);
        $paid       = (float) $request->paid;
        $change     = $paid - $grandTotal;

        // Update sale
        $sale->update([
            'customer_id' => $request->customer_id,
            'total'       => $grandTotal,
            'paid'        => $paid,
            'change'      => max(0, $change),
        ]);

        // Insert items baru + kurangi stok
        foreach ($items as $item) {
            SaleItem::create([
                'sale_id'    => $sale->id,
                'product_id' => $item['product_id'],
                'qty'        => $item['qty'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['qty'],
            ]);
            $p = Product::find($item['product_id']);
            if ($p) { $p->decrement('stock', $item['qty']); }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Transaksi berhasil diperbarui',
            'sale_id' => $sale->id,
        ]);
    }

    // DELETE transaksi
    public function destroy($id)
    {
        $sale = Sale::with('items')->findOrFail($id);

        // Restore stok
        foreach ($sale->items as $item) {
            if (!$item->product_id) continue;
            $p = Product::find($item->product_id);
            if ($p) { $p->increment('stock', $item->qty); }
        }

        $sale->items()->delete();
        $sale->delete();

        return response()->json(['status' => 'success', 'message' => 'Transaksi dihapus']);
    }

    public function print($id)
    {
        $sale = Sale::with('items.product')->findOrFail($id);
        return view('receipt_print', compact('sale'));
    }
}
