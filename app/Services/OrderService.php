<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    /**
     * Create a new class instance.
     */

     protected $orderRepo;
    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function getAllOrders($filters = [])
    {
        return $this->orderRepo->getAllOrders($filters);
    }

    public function getOrderById($id)
    {
        return $this->orderRepo->findById($id);
    }

    public function updateStatus($id, $status)
    {
        return $this->orderRepo->updateStatus($id, $status);
    }

    public function deleteOrder($id)
    {
        return $this->orderRepo->deleteOrder($id);
    }
}
