<?php

namespace App\Providers;

use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function register()
    {
        Schema::defaultStringLength(191);
        $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('basket');
        });

    }


    public function boot()
    {
        //
    }
}
