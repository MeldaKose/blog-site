<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('config',Config::find(1));
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        Route::resourceverbs([
            'create'=>'olustur',
            'edit'=>'guncelle',
        ]);
    }
}
