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
        return $this->subject("Đơn hàng #{$this->order->id} đã bị hủy")
            ->view('emails.orders.cancelled');
    }
}

