<?php

namespace App\Providers;

use App\Models\StoreSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('order.*', function ($view) {
            $name = 'Toko Ajib';
            if (Schema::hasTable('store_settings')) {
                try {
                    $name = StoreSetting::current()->store_name ?: $name;
                } catch (\Throwable $e) {
                }
            }
            $view->with('storeBrandName', $name);
        });
    }
}
