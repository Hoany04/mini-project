<?php

namespace App\Events;

use App\Models\OrderShipping;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class OrderShipped
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shipping;

    public function __construct(OrderShipping $shipping)
    {
        $this->shipping = $shipping;
    }
}
