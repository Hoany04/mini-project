<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class OrderCancelledMail extends Mailable
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject("Order #{$this->order->id} has been canceled")
            ->view('emails.orders.cancelled');
    }
}

