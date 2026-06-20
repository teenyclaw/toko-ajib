<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NonMemberController;
use App\Models\Product;
use App\Models\Customer;

Route::get('/', fn() => redirect('/dashboard'));

Route::middleware(['auth'])->group(function () {

    // ── DASHBOARD ──────────────────────────────────────
    Route::get('/dashboard', function () {
        $products  = Product::with('category')->get();

        // Aman meski tabel debts belum ada
        $hasDebts  = Schema::hasTable('debts');
        $customers = Customer::all()->map(function ($c) use ($hasDebts) {
            $c->total_debt = 0;
            if ($hasDebts) {
                try {
                    $c->total_debt = \App\Models\Debt::where('customer_id', $c->id)
                        ->whereIn('status', ['unpaid', 'partial'])
                        ->sum('remaining');
                } catch (\Exception $e) {}
            }
            return $c;
        });

        return view('dashboard', compact('products', 'customers'));
    });

    // ── CART DATA (AJAX) ───────────────────────────────
    Route::get('/cart-data', function () {
        $cart       = session()->get('cart', []);
        $grandTotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        return response()->json(['cart' => $cart, 'grandTotal' => $grandTotal]);
    });

    // ── CART ───────────────────────────────────────────
    Route::post('/cart/add',                     [CartController::class, 'add']);
    Route::post('/cart/update-manual',           [CartController::class, 'updateManual']);
    Route::get('/cart',                          [CartController::class, 'index']);
    Route::get('/cart/delete/{id}',              [CartController::class, 'delete']);
    Route::get('/cart/update/{id}/{action}',     [CartController::class, 'update']);
    Route::post('/cart/clear',                    [CartController::class, 'clear']);

    // ── CHECKOUT ───────────────────────────────────────
    Route::post('/checkout-ajax',                [CartController::class, 'checkoutAjax']);

    // ── RECEIPT ────────────────────────────────────────
    Route::get('/receipt/{id}',                  [SaleController::class, 'print']);

    // ── PRODUCTS ───────────────────────────────────────
    Route::get('/products',                      [ProductController::class, 'index']);
    Route::post('/products',                     [ProductController::class, 'store']);
    Route::delete('/products/{id}',              [ProductController::class, 'destroy']);
    Route::post('/products/{id}/update-modal',   [ProductController::class, 'updateModal']);
    Route::post('/products/{id}/update-margin',  [ProductController::class, 'updateMargin']);
    Route::post('/products/{id}/update-stock',   [ProductController::class, 'updateStock']);
    Route::post('/products/update-margin-category',       [ProductController::class, 'updateMarginByCategory']);
    Route::get('/products/category-margins/{categoryId}', [ProductController::class, 'getCategoryMargins']);
    Route::post('/products/preview-price',       [ProductController::class, 'previewPrice']);

    // ── IMPORT ─────────────────────────────────────────
    Route::get('/import',                        [ImportController::class, 'index']);
    Route::post('/import',                       [ImportController::class, 'import']);

    // ── CUSTOMERS ──────────────────────────────────────
    Route::get('/customers',                     [CustomerController::class, 'index']);
    Route::post('/customers',                    [CustomerController::class, 'store']);
    Route::post('/customers/{id}/update',        [CustomerController::class, 'update']);
    Route::delete('/customers/{id}',             [CustomerController::class, 'destroy']);
    Route::get('/customers/{id}/detail',         [CustomerController::class, 'detail']);

    // ── DEBTS ──────────────────────────────────────────
    Route::post('/debts/{debtId}/pay',           [CustomerController::class, 'payDebt']);
    Route::post('/debts/{debtId}/note',          [CustomerController::class, 'updateDebtNote']);

    // ── NON-MEMBER PRICING ─────────────────────────────
    Route::get('/nonmember',                     [NonMemberController::class, 'index']);
    Route::post('/nonmember/update-all',         [NonMemberController::class, 'updateAll']);
    Route::post('/nonmember/update-by-category', [NonMemberController::class, 'updateByCategory']);
    Route::post('/nonmember/preview',            [NonMemberController::class, 'preview']);

    // ── TRANSACTIONS ───────────────────────────────────
    Route::get('/transactions',                  [SaleController::class, 'index']);
    Route::get('/transactions/{id}/detail',      [SaleController::class, 'detail']);
    Route::post('/transactions/{id}/update',     [SaleController::class, 'update']);
    Route::delete('/transactions/{id}',          [SaleController::class, 'destroy']);
    Route::get('/transactions/{id}/print',       [SaleController::class, 'print']);

    // ── SET ADMIN (hapus di production) ───────────────
    Route::get('/set-admin', function () {
        $user = \App\Models\User::first();
        if ($user) { $user->role = 'admin'; $user->save(); return 'OK: ' . $user->name . ' sekarang admin'; }
        return 'User tidak ditemukan';
    });

});

require __DIR__.'/auth.php';
