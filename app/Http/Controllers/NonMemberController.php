<?php
// app/Http/Controllers/NonMemberController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class NonMemberController extends Controller
{
    // Halaman utama — tampilkan semua produk + margin nonmember saat ini
    public function index()
{
    $products   = Product::with('category')->latest()->get();
    $categories = Category::orderBy('name')->get();

    $first = $products->first();
    $currentMargins = [
        'margin_nonmember_dus'      => $first->margin_nonmember_dus      ?? 0,
        'margin_nonmember_dus_type' => $first->margin_nonmember_dus_type ?? 'percent',
        'margin_nonmember_pcs'      => $first->margin_nonmember_pcs      ?? 0,
        'margin_nonmember_pcs_type' => $first->margin_nonmember_pcs_type ?? 'percent',
    ];

    // ✅ Tambahkan ini
    $productData = $products->map(fn($p) => [
        'id'     => $p->id,
        'hbd'    => $p->harga_beli_dus,
        'qty'    => $p->qty_per_dus,
        'mdus'   => $p->margin_dus,
        'mdusTy' => $p->margin_dus_type,
        'hjd'    => $p->harga_jual_dus,
        'hjp'    => $p->harga_jual_pcs,
        'cat_id' => $p->category_id,
    ]);

    return view('nonmember.index', compact('products', 'categories', 'currentMargins', 'productData'));
}

    // Update margin nonmember — SEMUA produk sekaligus
    public function updateAll(Request $request)
    {
        $request->validate([
            'margin_nonmember_dus'      => 'required|numeric|min:0',
            'margin_nonmember_dus_type' => 'required|in:percent,nominal',
            'margin_nonmember_pcs'      => 'required|numeric|min:0',
            'margin_nonmember_pcs_type' => 'required|in:percent,nominal',
        ]);

        $products = Product::all();
        $count    = 0;

        foreach ($products as $p) {
            [$hDus, $hPcs] = $this->calcNonMemberPrices(
                $p->harga_beli_dus,
                $p->qty_per_dus,
                $p->margin_dus,
                $p->margin_dus_type,
                $request->margin_nonmember_dus,
                $request->margin_nonmember_dus_type,
                $request->margin_nonmember_pcs,
                $request->margin_nonmember_pcs_type,
            );

            $p->update([
                'margin_nonmember_dus'      => $request->margin_nonmember_dus,
                'margin_nonmember_dus_type' => $request->margin_nonmember_dus_type,
                'margin_nonmember_pcs'      => $request->margin_nonmember_pcs,
                'margin_nonmember_pcs_type' => $request->margin_nonmember_pcs_type,
                'harga_nonmember_dus'       => $hDus,
                'harga_nonmember_pcs'       => $hPcs,
            ]);
            $count++;
        }

        return response()->json([
            'status'  => 'success',
            'count'   => $count,
            'message' => "$count produk berhasil diperbarui",
        ]);
    }

    // Update margin nonmember per kategori
    public function updateByCategory(Request $request)
    {
        $request->validate([
            'category_id'               => 'required|exists:categories,id',
            'margin_nonmember_dus'      => 'required|numeric|min:0',
            'margin_nonmember_dus_type' => 'required|in:percent,nominal',
            'margin_nonmember_pcs'      => 'required|numeric|min:0',
            'margin_nonmember_pcs_type' => 'required|in:percent,nominal',
        ]);

        $products = Product::where('category_id', $request->category_id)->get();
        $count    = 0;

        foreach ($products as $p) {
            [$hDus, $hPcs] = $this->calcNonMemberPrices(
                $p->harga_beli_dus, $p->qty_per_dus,
                $p->margin_dus, $p->margin_dus_type,
                $request->margin_nonmember_dus, $request->margin_nonmember_dus_type,
                $request->margin_nonmember_pcs, $request->margin_nonmember_pcs_type,
            );

            $p->update([
                'margin_nonmember_dus'      => $request->margin_nonmember_dus,
                'margin_nonmember_dus_type' => $request->margin_nonmember_dus_type,
                'margin_nonmember_pcs'      => $request->margin_nonmember_pcs,
                'margin_nonmember_pcs_type' => $request->margin_nonmember_pcs_type,
                'harga_nonmember_dus'       => $hDus,
                'harga_nonmember_pcs'       => $hPcs,
            ]);
            $count++;
        }

        return response()->json([
            'status'  => 'success',
            'count'   => $count,
            'message' => "$count produk di kategori ini diperbarui",
        ]);
    }

    // Preview harga sebelum disimpan (AJAX)
    public function preview(Request $request)
    {
        $products = Product::with('category')
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->get();

        $result = $products->map(function ($p) use ($request) {
            [$hDus, $hPcs] = $this->calcNonMemberPrices(
                $p->harga_beli_dus, $p->qty_per_dus,
                $p->margin_dus, $p->margin_dus_type,
                $request->margin_nonmember_dus      ?? 0,
                $request->margin_nonmember_dus_type ?? 'percent',
                $request->margin_nonmember_pcs      ?? 0,
                $request->margin_nonmember_pcs_type ?? 'percent',
            );
            return [
                'id'                  => $p->id,
                'name'                => $p->name,
                'category'            => $p->category->name ?? '—',
                'harga_jual_dus'      => $p->harga_jual_dus,
                'harga_jual_pcs'      => $p->harga_jual_pcs,
                'harga_nonmember_dus' => $hDus,
                'harga_nonmember_pcs' => $hPcs,
            ];
        });

        return response()->json(['status' => 'success', 'products' => $result]);
    }

    // Kalkulasi harga nonmember dari harga member + margin tambahan
    private function calcNonMemberPrices(
        float  $hbd,   int    $qty,
        float  $mDus,  string $mDusTy,
        float  $nmDus, string $nmDusTy,
        float  $nmPcs, string $nmPcsTy,
    ): array {
        // Harga jual dus (member)
        $hjDus = $mDusTy === 'percent'
            ? $hbd * (1 + $mDus / 100)
            : $hbd + $mDus;

        // Harga nonmember dus = harga jual dus + margin nonmember dus
        $hNmDus = $nmDusTy === 'percent'
            ? $hjDus * (1 + $nmDus / 100)
            : $hjDus + $nmDus;

        // Harga jual pcs (modal per pcs = harga jual dus / qty)
        $hjPcs = $qty > 0 ? $hjDus / $qty : 0;

        // Harga nonmember pcs = harga jual pcs + margin nonmember pcs
        $hNmPcs = $nmPcsTy === 'percent'
            ? $hjPcs * (1 + $nmPcs / 100)
            : $hjPcs + $nmPcs;

        return [(int) ceil($hNmDus), (int) ceil($hNmPcs)];
    }
}
