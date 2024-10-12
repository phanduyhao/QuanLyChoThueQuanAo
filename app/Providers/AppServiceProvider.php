<?php

namespace App\Providers;

use App\Models\Kho;
use App\Models\Chothue;
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
        View::composer('main', function ($view) {
            $product_theokhos = Kho::where('Xoa', null)->orderBy('title')->get()->map(function ($kho) {
                $totalRented = Chothue::where('Xoa', null)->where('id_kho', $kho->id)->sum('quantity');
                $availableQuantity = $kho->quantity - $totalRented;
                $kho->available_quantity = max(0, $availableQuantity);
                return $kho;
            });
            $view->with('product_theokhos', $product_theokhos);
        });
    }
}
