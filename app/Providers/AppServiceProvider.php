<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

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
        if (env('REDIRECT_HTTPS')) {
            URL::forceScheme('https');
        }

        View::composer('backend.layouts.partials.sidebar', function ($view) {
            $baseController = new Controller();
            $menuData = $baseController->getsetmenu();
            $view->with('menuData', $menuData);
        });
    }
}
