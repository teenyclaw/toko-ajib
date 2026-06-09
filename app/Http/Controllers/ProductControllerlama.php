<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // ─── LIST ───────────────────────────────────────────────
    public function index(Request $request)
    {
        $search     = $request->search;
        $categoryId = $request->category_id;

        $products = Product::with('category')
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    // ─── STORE (tambah produk baru) ─────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'harga_beli_dus'  => 'required|numeric|min:0',
            'qty_per_dus'     => 'required|integer|min:1',
            'margin_dus'      => 'nullable|numeric|min:0',
            'margin_dus_type' => 'nullable|in:percent,nominal',
            'margin_pcs'      => 'nullable|numeric|min:0',
            'margin_pcs_type' => 'nullable|in:percent,nominal',
            'stock'           => 'nullable|integer|min:0',
        ]);

        $data = $this->calculatePrices($request->all());

        Product::create($data);

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil ditambahkan']);
    }

    // ─── UPDATE HARGA MODAL ─────────────────────────────────
    public function updateModal(Request $request, $id)
    {
        $request->validate([
            'harga_beli_dus' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $data    = $this->calculatePrices(array_merge($product->toArray(), [
            'harga_beli_dus' => $request->harga_beli_dus,
        ]));

        $product->update($data);

        return response()->json([
            'status'         => 'success',
            'harga_jual_dus' => $product->fresh()->harga_jual_dus,
            'harga_jual_pcs' => $product->fresh()->harga_jual_pcs,
            'message'        => 'Harga modal diperbarui',
        ]);
    }

    // ─── UPDATE MARGIN ──────────────────────────────────────
    public function updateMargin(Request $request, $id)
    {
        $request->validate([
            'margin_dus'      => 'required|numeric|min:0',
            'margin_dus_type' => 'required|in:percent,nominal',
            'margin_pcs'      => 'required|numeric|min:0',
            'margin_pcs_type' => 'required|in:percent,nominal',
        ]);

        $product = Product::findOrFail($id);
        $data    = $this->calculatePrices(array_merge($product->toArray(), $request->only([
            'margin_dus', 'margin_dus_type', 'margin_pcs', 'margin_pcs_type',
        ])));

        $product->update($data);

        return response()->json([
            'status'         => 'success',
            'harga_jual_dus' => $product->fresh()->harga_jual_dus,
            'harga_jual_pcs' => $product->fresh()->harga_jual_pcs,
            'message'        => 'Margin diperbarui',
        ]);
    }

    // ─── UPDATE MARGIN MASSAL (per kategori) ───────────────
    public function updateMarginByCategory(Request $request)
    {
        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'margin_dus'      => 'required|numeric|min:0',
            'margin_dus_type' => 'required|in:percent,nominal',
            'margin_pcs'      => 'required|numeric|min:0',
            'margin_pcs_type' => 'required|in:percent,nominal',
        ]);

        $products = Product::where('category_id', $request->category_id)->get();
        $count    = 0;

        foreach ($products as $product) {
            $data = $this->calculatePrices(array_merge($product->toArray(), $request->only([
                'margin_dus', 'margin_dus_type', 'margin_pcs', 'margin_pcs_type',
            ])));
            $product->update($data);
            $count++;
        }

        return response()->json([
            'status'  => 'success',
            'count'   => $count,
            'message' => "$count produk berhasil diperbarui",
        ]);
    }

    // ─── UPDATE STOK ────────────────────────────────────────
    public function updateStock(Request $request, $id)
    {
        $request->validate(['stock' => 'required|integer|min:0']);
        $product = Product::findOrFail($id);
        $product->update(['stock' => $request->stock]);

        return response()->json(['status' => 'success', 'message' => 'Stok diperbarui']);
    }

    // ─── DELETE ─────────────────────────────────────────────
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Produk dihapus']);
    }

    // ─── GET CATEGORIES WITH MARGINS ───────────────────────
    public function getCategoryMargins($categoryId)
    {
        // Ambil rata-rata margin dari produk dalam kategori yang sama
        $product = Product::where('category_id', $categoryId)->first();

        return response()->json([
            'margin_dus'      => $product->margin_dus      ?? 10,
            'margin_dus_type' => $product->margin_dus_type ?? 'percent',
            'margin_pcs'      => $product->margin_pcs      ?? 15,
            'margin_pcs_type' => $product->margin_pcs_type ?? 'percent',
        ]);
    }

    // ─── PREVIEW HARGA (AJAX realtime) ─────────────────────
    public function previewPrice(Request $request)
    {
        $result = $this->calculatePrices($request->all());

        return response()->json([
            'harga_jual_dus' => $result['harga_jual_dus'] ?? 0,
            'harga_jual_pcs' => $result['harga_jual_pcs'] ?? 0,
        ]);
    }

    // ─── HELPER: hitung semua harga dari input ──────────────
    private function calculatePrices(array $data): array
    {
        $hargaBeliDus   = (float)  ($data['harga_beli_dus']  ?? 0);
        $qty            = (int)    ($data['qty_per_dus']      ?? 1);
        $marginDus      = (float)  ($data['margin_dus']       ?? 0);
        $marginDusType  = (string) ($data['margin_dus_type']  ?? 'percent');
        $marginPcs      = (float)  ($data['margin_pcs']       ?? 0);
        $marginPcsType  = (string) ($data['margin_pcs_type']  ?? 'percent');

        // Harga jual dus
        $hargaJualDus = $marginDusType === 'percent'
            ? $hargaBeliDus * (1 + $marginDus / 100)
            : $hargaBeliDus + $marginDus;

        // Harga beli pcs = harga jual dus / qty (modal per pcs)
        $hargaBeliPcs = $qty > 0 ? $hargaJualDus / $qty : 0;

        // Harga jual pcs
        $hargaJualPcs = $marginPcsType === 'percent'
            ? $hargaBeliPcs * (1 + $marginPcs / 100)
            : $hargaBeliPcs + $marginPcs;

        return [
            'name'            => $data['name']            ?? null,
            'category_id'     => $data['category_id']     ?? null,
            'harga_beli_dus'  => (int) $hargaBeliDus,
            'qty_per_dus'     => $qty,
            'margin_dus'      => $marginDus,
            'margin_dus_type' => $marginDusType,
            'margin_pcs'      => $marginPcs,
            'margin_pcs_type' => $marginPcsType,
            'harga_jual_dus'  => (int) ceil($hargaJualDus),
            'harga_jual_pcs'  => (int) ceil($hargaJualPcs),
            'stock'           => (int) ($data['stock'] ?? 0),
        ];
    }
}
