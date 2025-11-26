<?php

namespace App\Services\Client;

use App\Repositories\OrderShippingRepository;

class OrderShippingService
{
    protected OrderShippingRepository $orderShippingRepo;

    public function __construct(OrderShippingRepository $orderShippingRepo)
    {
        $this->orderShippingRepo = $orderShippingRepo;
    }

    public function createShipping($orderId, $shippingMethodId, $shippingAddressId, $note = null)
    {
        return $this->orderShippingRepo->create([
            'order_id' => $orderId,
            'shipping_method_id' => $shippingMethodId,
            'shipping_address_id' => $shippingAddressId,
            'delivery_note' => $note,
            'status' => 'pending',
        ]);
    }

    public function updateStatus($orderId, $status)
    {
        return $this->orderShippingRepo->updateStatus($orderId, $status);
    }
}
