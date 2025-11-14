<?php

namespace App\Repositories\API;

use App\Models\Order;
use App\Models\OrderItem;
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

    public function createOrder($data)
    {
        return Order::create($data);
    }

    public function createOrderItems($orderId, $items)
    {
        foreach ($items as $item) {
            OrderItem::created([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'variant_text' => $item['variant_text'],
            ]);
        }
    }
}
