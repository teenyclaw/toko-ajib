<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Schema;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Cek apakah tabel debts sudah ada
        $hasDebtsTable = Schema::hasTable('debts');

        if ($hasDebtsTable) {
            // Load dengan relasi debt
            $customers = Customer::with(['activeDebts'])
                ->when($search, fn($q) => $q->where('name','like',"%$search%")
                                            ->orWhere('phone','like',"%$search%"))
                ->orderBy('name')
                ->get()
                ->map(function ($c) {
                    $c->total_debt = $c->activeDebts->sum('remaining');
                    return $c;
                });
        } else {
            // Tanpa relasi debt (tabel belum ada)
            $customers = Customer::when($search, fn($q) =>
                $q->where('name','like',"%$search%")
                  ->orWhere('phone','like',"%$search%"))
                ->orderBy('name')
                ->get()
                ->map(function ($c) {
                    $c->total_debt = 0;
                    $c->activeDebts = collect([]);
                    return $c;
                });
        }

        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:30',
            'address' => 'nullable|string|max:500',
        ]);

        // Cek kolom address ada atau tidak
        $data = ['name' => $validated['name']];
        if (isset($validated['phone']))   $data['phone']   = $validated['phone'];
        if (Schema::hasColumn('customers','address') && isset($validated['address'])) {
            $data['address'] = $validated['address'];
        }

        $customer = Customer::create($data);

        return response()->json([
            'status'   => 'success',
            'message'  => 'Pelanggan berhasil ditambahkan',
            'customer' => [
                'id'      => $customer->id,
                'name'    => $customer->name,
                'phone'   => $customer->phone ?? '',
                'address' => $customer->address ?? '',
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:30',
            'address' => 'nullable|string|max:500',
        ]);

        $customer = Customer::findOrFail($id);

        $data = ['name' => $validated['name'], 'phone' => $validated['phone'] ?? null];
        if (Schema::hasColumn('customers','address')) {
            $data['address'] = $validated['address'] ?? null;
        }

        $customer->update($data);

        return response()->json(['status' => 'success', 'message' => 'Data pelanggan diperbarui']);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        // Cek utang aktif hanya jika tabel ada
        if (Schema::hasTable('debts')) {
            if ($customer->activeDebts()->exists()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Pelanggan masih memiliki utang aktif',
                ], 422);
            }
        }

        $customer->delete();
        return response()->json(['status' => 'success', 'message' => 'Pelanggan dihapus']);
    }

    public function detail($id)
    {
        $hasDebtsTable = Schema::hasTable('debts');

        $customer = Customer::findOrFail($id);

        $debts = [];
        if ($hasDebtsTable) {
            // Load relasi hanya jika tabel ada
            $customer->load(['debts' => fn($q) => $q->with('sale')->orderByDesc('created_at')]);
            $debts = $customer->debts->map(fn($d) => [
                'id'         => $d->id,
                'invoice'    => $d->sale->invoice ?? '—',
                'sale_id'    => $d->sale_id,
                'amount'     => $d->amount,
                'paid'       => $d->paid,
                'remaining'  => $d->remaining,
                'status'     => $d->status,
                'note'       => $d->note,
                'due_date'   => $d->due_date?->format('d M Y') ?? null,
                'created_at' => $d->created_at->format('d M Y'),
            ])->toArray();
        }

        $totalDebt = collect($debts)
            ->whereIn('status', ['unpaid','partial'])
            ->sum('remaining');

        return response()->json([
            'status'   => 'success',
            'customer' => [
                'id'         => $customer->id,
                'name'       => $customer->name,
                'phone'      => $customer->phone ?? '',
                'address'    => $customer->address ?? '',
                'total_debt' => $totalDebt,
                'debts'      => $debts,
            ],
        ]);
    }

    public function payDebt(Request $request, $debtId)
    {
        if (!Schema::hasTable('debts')) {
            return response()->json(['status'=>'error','message'=>'Fitur utang belum aktif'], 422);
        }

        $request->validate(['pay_amount' => 'required|numeric|min:1']);

        $debt = \App\Models\Debt::findOrFail($debtId);

        if ($debt->status === 'paid') {
            return response()->json(['status'=>'error','message'=>'Utang sudah lunas'], 422);
        }

        $pay             = min((float)$request->pay_amount, $debt->remaining);
        $debt->paid     += $pay;
        $debt->remaining = $debt->amount - $debt->paid;

        if ($debt->remaining <= 0)     $debt->status = 'paid';
        elseif ($debt->paid > 0)       $debt->status = 'partial';
        else                           $debt->status = 'unpaid';

        $debt->save();

        return response()->json([
            'status'      => 'success',
            'message'     => 'Pembayaran dicatat',
            'remaining'   => $debt->remaining,
            'debt_status' => $debt->status,
        ]);
    }

    public function updateDebtNote(Request $request, $debtId)
    {
        if (!Schema::hasTable('debts')) {
            return response()->json(['status'=>'error','message'=>'Fitur utang belum aktif'], 422);
        }

        $request->validate(['note' => 'nullable|string|max:500']);
        \App\Models\Debt::findOrFail($debtId)->update(['note' => $request->note]);

        return response()->json(['status'=>'success','message'=>'Catatan disimpan']);
    }
}
