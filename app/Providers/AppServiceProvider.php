<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrap();
        //
        // Blade::directive('getstatuscolor', function ($status) {
        //     switch ($status) {
        //         case 0:
        //             return 'bg-primary';
        //             break;

        //         case 1:
        //             return 'bg-success';
        //             break;

        //         case 2:
        //             return 'bg-danger';
        //             break;
        //         default:
        //             # code...
        //             break;
        //     }
        // });
    }
}
