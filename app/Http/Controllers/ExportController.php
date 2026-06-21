<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function productsCsv(): StreamedResponse
    {
        $filename = 'produk-' . date('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, [
                'name', 'category', 'harga_beli_dus', 'qty_per_dus',
                'margin_dus', 'margin_dus_type', 'margin_pcs', 'margin_pcs_type',
                'stock', 'barcode', 'is_orderable',
            ]);

            Product::with('category')
                ->orderBy('name')
                ->chunk(200, function ($products) use ($out) {
                    foreach ($products as $p) {
                        fputcsv($out, [
                            $p->name,
                            $p->category?->name ?? '',
                            $p->harga_beli_dus,
                            $p->qty_per_dus,
                            $p->margin_dus,
                            $p->margin_dus_type,
                            $p->margin_pcs,
                            $p->margin_pcs_type,
                            $p->stock,
                            $p->barcode ?? '',
                            $p->is_orderable ? 1 : 0,
                        ]);
                    }
                });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function customersCsv(): StreamedResponse
    {
        $filename = 'pelanggan-' . date('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, ['name', 'phone', 'address']);

            Customer::orderBy('name')
                ->chunk(200, function ($customers) use ($out) {
                    foreach ($customers as $c) {
                        fputcsv($out, [
                            $c->name,
                            $c->phone ?? '',
                            $c->address ?? '',
                        ]);
                    }
                });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function databaseSql(): StreamedResponse
    {
        $filename = 'backup-toko-ajib-' . date('Y-m-d-His') . '.sql';

        $tables = [
            'users',
            'categories',
            'customers',
            'products',
            'sales',
            'sale_items',
            'debts',
            'store_settings',
            'orders',
            'order_items',
        ];

        return response()->streamDownload(function () use ($tables) {
            $out = fopen('php://output', 'w');

            fwrite($out, "-- Toko Ajib database backup\n");
            fwrite($out, '-- Generated: ' . date('Y-m-d H:i:s') . "\n\n");
            fwrite($out, "SET FOREIGN_KEY_CHECKS=0;\n");
            fwrite($out, "SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';\n\n");

            foreach ($tables as $table) {
                if (! $this->tableExists($table)) {
                    continue;
                }
                $this->writeTableSql($out, $table);
            }

            fwrite($out, "\nSET FOREIGN_KEY_CHECKS=1;\n");
            fclose($out);
        }, $filename, [
            'Content-Type' => 'application/sql',
        ]);
    }

    private function tableExists(string $table): bool
    {
        return DB::getSchemaBuilder()->hasTable($table);
    }

    private function writeTableSql($out, string $table): void
    {
        fwrite($out, "\n-- --------------------------------------------------------\n");
        fwrite($out, "-- Table: `{$table}`\n");
        fwrite($out, "-- --------------------------------------------------------\n\n");
        fwrite($out, "DELETE FROM `{$table}`;\n");

        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        if (empty($columns)) {
            return;
        }

        $orderCol = in_array('id', $columns, true) ? 'id' : $columns[0];

        DB::table($table)
            ->orderBy($orderCol)
            ->chunk(100, function ($rows) use ($out, $table, $columns) {
                foreach ($rows as $row) {
                    $data = (array) $row;
                    $vals = array_map(fn ($col) => $this->sqlValue($data[$col] ?? null), $columns);
                    $colList = implode('`, `', $columns);
                    $valList = implode(', ', $vals);
                    fwrite($out, "INSERT INTO `{$table}` (`{$colList}`) VALUES ({$valList});\n");
                }
            });

        fwrite($out, "\n");
    }

    private function sqlValue(mixed $value): string
    {
        if ($value === null) {
            return 'NULL';
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        return "'" . str_replace(["\\", "'"], ["\\\\", "\\'"], (string) $value) . "'";
    }
}
