<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $file = $request->file('file');

        $handle = fopen($file->getRealPath(), 'r');

        if (!$handle) {
            return back()->with('error', 'File tidak bisa dibaca');
        }

        // ambil header
        $header = fgetcsv($handle, 0, ',');

        if (!$header) {
            return back()->with('error', 'Header CSV tidak valid');
        }

        // clean BOM + trim + lowercase
        $header = array_map(function ($item) {
            return strtolower(trim(preg_replace('/^\xEF\xBB\xBF/', '', $item)));
        }, $header);

        $inserted = 0;
        $rowNumber = 1;

        while (($row = fgetcsv($handle, 0, ',')) !== false) {

            $rowNumber++;

            // skip kalau kolom tidak cocok
            if (count($row) != count($header)) {
                continue;
            }

            $row = array_combine($header, $row);

            if (!$row || !isset($row['name'])) {
                continue;
            }

            $categoryName = ucwords(strtolower(trim($row['category'] ?? 'uncategorized')));

            $category = Category::firstOrCreate([
                'name' => $categoryName
            ]);

            try {
                $hargaBeliDus = (int) ($row['harga_beli_dus'] ?? 0);
$qty = (int) ($row['qty_per_dus'] ?? 1);

// HITUNG HARGA JUAL DUS
$marginDus = (float) ($row['margin_dus'] ?? 0);
$marginDusType = $row['margin_dus_type'] ?? 'percent';

if ($marginDusType == 'percent') {
    $hargaJualDus = $hargaBeliDus + ($hargaBeliDus * $marginDus / 100);
} else {
    $hargaJualDus = $hargaBeliDus + $marginDus;
}

// HITUNG HARGA PCS
$hargaBeliPcs = $qty > 0 ? $hargaJualDus / $qty : 0;

$marginPcs = (float) ($row['margin_pcs'] ?? 0);
$marginPcsType = $row['margin_pcs_type'] ?? 'percent';

if ($marginPcsType == 'percent') {
    $hargaJualPcs = $hargaBeliPcs + ($hargaBeliPcs * $marginPcs / 100);
} else {
    $hargaJualPcs = $hargaBeliPcs + $marginPcs;
}
                Product::create([
    'name' => trim($row['name']),
    'category_id' => $category->id,
    'harga_beli_dus' => $hargaBeliDus,
    'qty_per_dus' => $qty,
    'margin_dus' => $marginDus,
    'margin_dus_type' => $marginDusType,
    'margin_pcs' => $marginPcs,
    'margin_pcs_type' => $marginPcsType,
    'harga_jual_dus' => $hargaJualDus = ceil($hargaJualDus),
    'harga_jual_pcs' => $hargaJualPcs = ceil($hargaJualPcs),
    'stock' => (int) ($row['stock'] ?? 0),
]);
 
                $inserted++;

            } catch (\Exception $e) {
    logger("ERROR ROW: " . json_encode($row));
    logger("MESSAGE: " . $e->getMessage());
    continue;
}
        }

        fclose($handle);
$total = Product::count();

        return back()->with('success', "Import berhasil! Data masuk: $inserted");
    }
}