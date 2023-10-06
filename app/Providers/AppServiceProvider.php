<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        //   5 => Programmer
        //   3 => Super Admin
        //   6 => Admin
        //   9 => Simple User
//        $user = Auth::loginUsingId(3);


    }
}
