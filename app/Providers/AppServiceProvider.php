<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\HangSanXuat;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['clientStore.layout.header', 'clientStore.layout.footer', 'clientStore.layout.master', 'clientStore.page.thanhtoan'] , function($view){
            $hangsanxuat = HangSanXuat::all();
            $total = Cart::subtotal(0,',','.');
            $content = Cart::content();
            $count = Cart::count();
            
            $view->with(['hangsanxuat'=>$hangsanxuat,'total'=>$total,'content'=>$content,'count'=>$count]);
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
