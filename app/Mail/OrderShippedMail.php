<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class OrderShippedMail extends Mailable
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject("Order #{$this->order->id} currently being delivered")
            ->view('emails.orders.shipped');
    }
}
