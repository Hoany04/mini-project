<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    /**
     * Create a new class instance.
     */
    public function getAllOrders($filters = [])
    {
        $query = Order::with('user', 'coupon');

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('username', 'like', "%{search}%")->orWhere('email', 'like', "%{search}%");
            });
        }
        return $query->orderByDesc('id')->paginate(10);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function findByUser($userId)
    {
        return Order::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->with('items.product', 'coupon')
            ->get();
    }

    public function findById($id)
    {
        return Order::with('user', 'coupon', 'items.product')->findOrFail($id);
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);
        return $order;
    }

    public function deleteOrder($id)
    {
        return Order::findOrFail($id)->delete();
    }
}
