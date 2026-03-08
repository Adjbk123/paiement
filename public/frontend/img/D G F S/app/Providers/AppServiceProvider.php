<?php

namespace App\Providers;
use Illuminate\pagination\paginator;
use App\models\Setting;

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
        paginator::useBootstrap();
        $websiteSetting = Setting::first();
        view::share('appSetting' , $websiteSetting);
    }
}
