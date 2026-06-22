<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->search;
        $categoryId = $request->category_id;

        $products = Product::with('category')
            ->when($search,     fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

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

        $data = $this->calcPrices($request->all());
        Product::create($data);

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil ditambahkan']);
    }

    public function updateModal(Request $request, $id)
    {
        $request->validate(['harga_beli_dus' => 'required|numeric|min:0']);
        $product = Product::findOrFail($id);
        $data    = $this->calcPrices(array_merge($product->toArray(), [
            'harga_beli_dus' => $request->harga_beli_dus,
        ]));
        $product->update($data);
        $fresh = $product->fresh();
        return response()->json([
            'status'         => 'success',
            'harga_jual_dus' => $fresh->harga_jual_dus,
            'harga_jual_pcs' => $fresh->harga_jual_pcs,
            'message'        => 'Harga modal diperbarui',
        ]);
    }

    public function updateMargin(Request $request, $id)
    {
        $request->validate([
            'margin_dus'      => 'required|numeric|min:0',
            'margin_dus_type' => 'required|in:percent,nominal',
            'margin_pcs'      => 'required|numeric|min:0',
            'margin_pcs_type' => 'required|in:percent,nominal',
        ]);
        $product = Product::findOrFail($id);
        $data    = $this->calcPrices(array_merge($product->toArray(),
            $request->only(['margin_dus','margin_dus_type','margin_pcs','margin_pcs_type'])
        ));
        $product->update($data);
        $fresh = $product->fresh();
        return response()->json([
            'status'         => 'success',
            'harga_jual_dus' => $fresh->harga_jual_dus,
            'harga_jual_pcs' => $fresh->harga_jual_pcs,
            'message'        => 'Margin diperbarui',
        ]);
    }

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
        foreach ($products as $p) {
            $p->update($this->calcPrices(array_merge($p->toArray(),
                $request->only(['margin_dus','margin_dus_type','margin_pcs','margin_pcs_type'])
            )));
        }
        return response()->json([
            'status'  => 'success',
            'count'   => $products->count(),
            'message' => $products->count() . ' produk berhasil diperbarui',
        ]);
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate(['stock' => 'required|integer|min:0']);
        Product::findOrFail($id)->update(['stock' => $request->stock]);
        return response()->json(['status' => 'success', 'message' => 'Stok diperbarui']);
    }

    public function updateDetails(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'qty_per_dus' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $data    = array_merge($product->toArray(), $validated);
        $product->update($this->calcPrices($data));

        $fresh = $product->fresh('category');

        return response()->json([
            'status'         => 'success',
            'name'           => $fresh->name,
            'category_id'    => $fresh->category_id,
            'category_name'  => $fresh->category?->name ?? '—',
            'qty_per_dus'    => $fresh->qty_per_dus,
            'harga_jual_dus' => $fresh->harga_jual_dus,
            'harga_jual_pcs' => $fresh->harga_jual_pcs,
            'message'        => 'Data produk diperbarui',
        ]);
    }

    public function toggleOrderable($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_orderable' => !$product->is_orderable]);

        return response()->json([
            'status'       => 'success',
            'is_orderable' => $product->is_orderable,
            'message'      => $product->is_orderable ? 'Produk aktif di katalog online' : 'Produk disembunyikan dari katalog online',
        ]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Produk dihapus']);
    }

    public function getCategoryMargins($categoryId)
    {
        $p = Product::where('category_id', $categoryId)->first();
        return response()->json([
            'margin_dus'      => $p->margin_dus      ?? 10,
            'margin_dus_type' => $p->margin_dus_type ?? 'percent',
            'margin_pcs'      => $p->margin_pcs      ?? 15,
            'margin_pcs_type' => $p->margin_pcs_type ?? 'percent',
        ]);
    }

    public function bulkModalPage()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.bulk-modal', compact('categories'));
    }

    public function bulkModalSearch(Request $request)
    {
        $search     = trim((string) $request->get('q', ''));
        $categoryId = $request->get('category_id');

        $products = Product::with('category')
            ->when($search !== '', fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->orderBy('name')
            ->limit(50)
            ->get()
            ->map(fn (Product $p) => $this->productToBulkJson($p));

        return response()->json(['products' => $products]);
    }

    public function bulkUpdateModal(Request $request)
    {
        $request->validate([
            'items'                   => 'required|array|min:1',
            'items.*.id'              => 'required|exists:products,id',
            'items.*.harga_beli_dus'  => 'required|numeric|min:1',
        ]);

        $updated = DB::transaction(function () use ($request) {
            $results = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['id']);
                $data    = $this->calcPrices(array_merge($product->toArray(), [
                    'harga_beli_dus' => $item['harga_beli_dus'],
                ]));
                $product->update($data);
                $fresh = $product->fresh();

                $results[] = [
                    'id'               => $fresh->id,
                    'name'             => $fresh->name,
                    'harga_beli_dus'   => $fresh->harga_beli_dus,
                    'harga_jual_dus'   => $fresh->harga_jual_dus,
                    'harga_jual_pcs'   => $fresh->harga_jual_pcs,
                ];
            }

            return $results;
        });

        return response()->json([
            'status'  => 'success',
            'count'   => count($updated),
            'items'   => $updated,
            'message' => count($updated) . ' produk berhasil diperbarui',
        ]);
    }

    private function productToBulkJson(Product $p): array
    {
        return [
            'id'               => $p->id,
            'name'             => $p->name,
            'category_name'    => $p->category?->name ?? '—',
            'harga_beli_dus'   => (int) $p->harga_beli_dus,
            'harga_jual_dus'   => (int) $p->harga_jual_dus,
            'harga_jual_pcs'   => (int) $p->harga_jual_pcs,
            'qty_per_dus'      => (int) $p->qty_per_dus,
            'margin_dus'       => (float) $p->margin_dus,
            'margin_dus_type'  => $p->margin_dus_type ?? 'percent',
            'margin_pcs'       => (float) $p->margin_pcs,
            'margin_pcs_type'  => $p->margin_pcs_type ?? 'percent',
        ];
    }

    private function calcPrices(array $d): array
    {
        $hbd  = (float) ($d['harga_beli_dus']  ?? 0);
        $qty  = (int)   ($d['qty_per_dus']      ?? 1);
        $md   = (float) ($d['margin_dus']       ?? 0);
        $mdt  =         ($d['margin_dus_type']  ?? 'percent');
        $mp   = (float) ($d['margin_pcs']       ?? 0);
        $mpt  =         ($d['margin_pcs_type']  ?? 'percent');

        $hjd  = $mdt === 'percent' ? $hbd * (1 + $md / 100) : $hbd + $md;
        $hbp  = $qty > 0 ? $hjd / $qty : 0;
        $hjp  = $mpt === 'percent' ? $hbp * (1 + $mp / 100) : $hbp + $mp;

        return [
            'name'            => $d['name']        ?? null,
            'category_id'     => $d['category_id'] ?? null,
            'harga_beli_dus'  => (int) $hbd,
            'qty_per_dus'     => $qty,
            'margin_dus'      => $md,
            'margin_dus_type' => $mdt,
            'margin_pcs'      => $mp,
            'margin_pcs_type' => $mpt,
            'harga_jual_dus'  => (int) ceil($hjd),
            'harga_jual_pcs'  => (int) ceil($hjp),
            'stock'           => (int) ($d['stock'] ?? 0),
        ];
    }
}
