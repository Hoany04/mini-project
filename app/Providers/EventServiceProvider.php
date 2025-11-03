<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\OrderShipped;
use App\Listeners\SendOrderDeliveredEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\LogUserLoginLogout::class,
        ],
        \Illuminate\Auth\Events\Logout::class => [
            \App\Listeners\LogUserLoginLogout::class,
        ],
        \Illuminate\Auth\Events\Failed::class => [
            \App\Listeners\LogUserLoginLogout::class,
        ],

        \App\Events\OrderShipped::class => [
            \App\Listeners\SendOrderDeliveredEmail::class,
        ],
        //
        // \App\Events\OrderShippingStatusChanged::class => [
        //     \App\Listeners\SendShippingStatusEmail::class,
        // ],
    ];
   

    public function boot(): void
    {
        parent::boot();
    }
}
