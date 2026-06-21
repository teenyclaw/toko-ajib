<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NonMemberController;
use App\Http\Controllers\OrderSettingController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\Order\CatalogController;
use App\Http\Controllers\Order\CheckoutController;
use App\Http\Controllers\Order\OrderCartController;
use App\Http\Controllers\PosOrderController;
use App\Models\Product;
use App\Models\Customer;

Route::get('/', fn() => redirect('/dashboard'));

// ── CUSTOMER ORDERING (PUBLIC) ───────────────────────
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/cart', [OrderCartController::class, 'index'])->name('cart');
    Route::get('/cart/data', [OrderCartController::class, 'data'])->name('cart.data');
    Route::post('/cart/add', [OrderCartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{productId}', [OrderCartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{productId}', [OrderCartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/thanks/{orderNumber}', [CheckoutController::class, 'thanks'])->name('thanks');
});

Route::middleware(['auth'])->group(function () {

    // ── KASIR + ADMIN ──────────────────────────────────
    Route::get('/dashboard', function () {
        $products  = Product::with('category')->get();

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

    Route::get('/cart-data',                     [CartController::class, 'cartData']);
    Route::post('/cart/add',                     [CartController::class, 'add']);
    Route::post('/cart/add-manual',              [CartController::class, 'addManual']);
    Route::post('/cart/update-manual',           [CartController::class, 'updateManual']);
    Route::get('/cart',                          [CartController::class, 'index']);
    Route::get('/cart/delete/{id}',              [CartController::class, 'delete']);
    Route::get('/cart/update/{id}/{action}',     [CartController::class, 'update']);
    Route::post('/cart/clear',                   [CartController::class, 'clear']);
    Route::post('/checkout-ajax',                [CartController::class, 'checkoutAjax']);
    Route::get('/receipt/{id}',                  [SaleController::class, 'print']);

    Route::get('/pos/orders',                    [PosOrderController::class, 'index']);
    Route::get('/pos/orders/count',              [PosOrderController::class, 'pendingCount']);
    Route::get('/online-orders',                 [PosOrderController::class, 'history'])->name('online-orders.index');
    Route::get('/pos/orders/{id}',               [PosOrderController::class, 'show']);
    Route::post('/pos/orders/{id}/load',         [PosOrderController::class, 'loadToCart']);
    Route::post('/pos/orders/{id}/cancel',       [PosOrderController::class, 'cancel']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/settings/order',                [OrderSettingController::class, 'edit'])->name('settings.order');
    Route::post('/settings/order',               [OrderSettingController::class, 'update']);

    Route::get('/settings/users',                [UserManagementController::class, 'index'])->name('settings.users');
    Route::post('/settings/users',               [UserManagementController::class, 'store'])->name('settings.users.store');
    Route::post('/settings/users/{user}/update', [UserManagementController::class, 'update'])->name('settings.users.update');
    Route::post('/settings/users/{user}/password', [UserManagementController::class, 'updatePassword'])->name('settings.users.password');
    Route::post('/settings/users/{user}/delete', [UserManagementController::class, 'destroy'])->name('settings.users.destroy');

    Route::get('/products',                      [ProductController::class, 'index']);
    Route::post('/products',                     [ProductController::class, 'store']);
    Route::delete('/products/{id}',              [ProductController::class, 'destroy']);
    Route::post('/products/{id}/update-modal',   [ProductController::class, 'updateModal']);
    Route::post('/products/{id}/update-margin',  [ProductController::class, 'updateMargin']);
    Route::post('/products/{id}/update-stock',   [ProductController::class, 'updateStock']);
    Route::post('/products/{id}/update-details', [ProductController::class, 'updateDetails']);
    Route::post('/products/{id}/toggle-orderable', [ProductController::class, 'toggleOrderable']);
    Route::post('/products/update-margin-category',       [ProductController::class, 'updateMarginByCategory']);
    Route::get('/products/category-margins/{categoryId}', [ProductController::class, 'getCategoryMargins']);
    Route::post('/products/preview-price',       [ProductController::class, 'previewPrice']);

    Route::get('/import',                        [ImportController::class, 'index']);
    Route::post('/import',                       [ImportController::class, 'import']);

    Route::get('/customers',                     [CustomerController::class, 'index']);
    Route::post('/customers',                    [CustomerController::class, 'store']);
    Route::post('/customers/{id}/update',        [CustomerController::class, 'update']);
    Route::delete('/customers/{id}',             [CustomerController::class, 'destroy']);
    Route::get('/customers/{id}/detail',         [CustomerController::class, 'detail']);

    Route::post('/debts/{debtId}/pay',           [CustomerController::class, 'payDebt']);
    Route::post('/debts/{debtId}/note',          [CustomerController::class, 'updateDebtNote']);

    Route::get('/nonmember',                     [NonMemberController::class, 'index']);
    Route::post('/nonmember/update-all',         [NonMemberController::class, 'updateAll']);
    Route::post('/nonmember/update-by-category', [NonMemberController::class, 'updateByCategory']);
    Route::post('/nonmember/preview',            [NonMemberController::class, 'preview']);

    Route::get('/transactions',                  [SaleController::class, 'index']);
    Route::get('/transactions/{id}/detail',      [SaleController::class, 'detail']);
    Route::post('/transactions/{id}/update',     [SaleController::class, 'update']);
    Route::delete('/transactions/{id}',          [SaleController::class, 'destroy']);
    Route::get('/transactions/{id}/print',       [SaleController::class, 'print']);

    Route::get('/set-admin', function () {
        $user = \App\Models\User::first();
        if ($user) { $user->role = 'admin'; $user->save(); return 'OK: ' . $user->name . ' sekarang admin'; }
        return 'User tidak ditemukan';
    });
});

require __DIR__.'/auth.php';
