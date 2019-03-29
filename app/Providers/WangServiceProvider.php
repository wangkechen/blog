<?php

namespace App\Providers;

use App\Services\WangService;
use Illuminate\Support\ServiceProvider;

class WangServiceProvider extends ServiceProvider
{
    //protected $defer = true;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('wang', function ($app) {
            return new WangService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /*public function provides()
    {
        return ['wang'];
    }*/
    
}
