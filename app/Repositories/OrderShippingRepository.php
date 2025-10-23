<?php

namespace App\Repositories;

use App\Models\OrderShipping;

class OrderShippingRepository
{
    public function create(array $data)
    {
        return OrderShipping::create($data);
    }

    public function findByOrderId($orderId)
    {
        return OrderShipping::where('order_id', $orderId)->first();
    }

    public function updateStatus($orderId, $status)
    {
        $shipping = $this->findByOrderId($orderId);
        if ($shipping) {
            $shipping->update(['status' => $status]);
        }
        return $shipping;
    }
}
