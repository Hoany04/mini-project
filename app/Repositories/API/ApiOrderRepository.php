<?php

namespace App\Repositories\API;

use App\Models\Order;
class ApiOrderRepository
{
    public function find($id)
    {
        return Order::find($id);
    }

    public function updateStatus(Order $order, $status)
    {
        $order->update(['status' => $status]);
        return $order;
    }
}
