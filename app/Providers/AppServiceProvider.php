<?php

namespace App\Providers;

use App\User;
use function foo\func;
use Illuminate\Support\ServiceProvider;

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
        return 123;
        User::created(function($user){
            return 123;
           dd($user->id,$user->name);
        });
    }
}
