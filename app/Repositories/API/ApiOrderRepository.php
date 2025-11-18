<?php

namespace App\Repositories\API;

use App\Models\Order;
use App\Models\OrderItem;
class ApiOrderRepository
{
    // public function find($id)
    // {
    //     return Order::find($id);
    // }

    // public function updateStatus(Order $order, $status)
    // {
    //     $order->update(['status' => $status]);
    //     return $order;
    // }

    public function createOrder($data)
    {
        return Order::create($data);
    }

    public function createOrderItems($data)// $orderId, $items
    {
        return OrderItem::create($data);
    }
}
