<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDeliveredMail;
use Illuminate\Support\Facades\Log;

class SendOrderDeliveredEmail
{
    public function handle(OrderShipped $event)
    {
        $order = $event->shipping->order;

        if (!$order || !$order->user) {
            Log::warning(" No user found for order {$order->id}");
            return;
        }

        Mail::to($order->user->email)->send(new OrderDeliveredMail($order));
        Log::info(" OrderDeliveredMail sent to {$order->user->email} for Order #{$order->id}");
    }
}
