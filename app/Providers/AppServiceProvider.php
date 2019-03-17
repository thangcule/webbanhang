<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\productsCatagories;
use App\productSlide;
use App\Products;
use App\Orders;
use Cart;
use App\Providers\session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('admin/addProducts', function ($view) {
            $allCatagories = productsCatagories::all();
            $view->with('allCatagories', $allCatagories);
        });
        view()->composer('admin/editProducts', function ($view) {
            $allCatagories = productsCatagories::all();
            $view->with('allCatagories', $allCatagories);
        });
        
        view()->composer('*', function ($view) {
            $allSlides = productSlide::all();
            $allCatagories = productsCatagories::all();
            $orders = Orders::all();
            $view->with(['orders' => $orders,'allCatagories' => $allCatagories,'allSlides' => $allSlides]);
        });
        view()->composer("includes/header",function ($view){
            $countCart = Cart::count();
            $view->with(['countCart' => $countCart]); 
        });
        view()->composer("includes/sidebar",function ($view){
            $items = Cart::content();
            $view->with(['items' => $items]); 
        });
        view()->composer("includes/footer",function ($view){
            $products = Products::take(3)->get();
            $view->with(['products' => $products]); 
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
