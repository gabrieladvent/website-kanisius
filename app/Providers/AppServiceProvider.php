<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $disableButton = session('disableButton');
            $activeStartTime = session('activeStartTime');
            $activeEndTime = session('activeEndTime');
            $currentTime = session('currentTime');
            
            $view->with([
                'disableButton' => $disableButton,
                'activeStartTime' => $activeStartTime,
                'activeEndTime' => $activeEndTime,
                'currentTime' => $currentTime,
            ]);
        });
    }
}
