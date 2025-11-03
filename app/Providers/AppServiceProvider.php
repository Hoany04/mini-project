<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\EventServiceProvider;
use App\Models\OrderShipping;
use App\Observers\OrderShippingObserver;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // App::register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        OrderShipping::observe(OrderShippingObserver::class);
    }
}
