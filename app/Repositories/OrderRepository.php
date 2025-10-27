<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderShipping;
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
        return Order::create([
            'user_id' => $data['user_id'],
            'coupon_id' => $data['coupon_id'] ?? null,
            'total_amount' => $data['total_amount'],
            'status' => $data['status'] ?? 'pending',
        ]);
    }

    //
    public function createShipping($orderId, array $data)
    {
        $shippingMethod = \App\Models\ShippingMethod::find($data['shipping_method_id']);
        $fee = $shippingMethod ? $shippingMethod->fee : 0;

        return OrderShipping::create([
            'order_id' => $orderId,
            'shipping_method_id' => $data['shipping_method_id'] ?? null,
            'shipping_address_id' => $data['shipping_address_id'] ?? null,
            'shipping_fee' => $data['shipping_fee'] ?? 0,
            'tracking_number' => $data['tracking_number'] ?? null,
            'delivery_note' => $data['delivery_note'] ?? null,
            'status' => 'pending',
        ]);
    }


    /**
     * Lấy danh sách đơn hàng của user
     */
    public function findByUser($userId)
    {
        return Order::where('user_id', $userId)
            ->with([
                'items.product',
                'items.variant',
                'coupon',
                'paymentTransactions.paymentMethod',
                'shipping.method',
                'shipping.address'
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Lấy chi tiết một đơn hàng cụ thể
     */
    public function findById($orderId)
    {
        return Order::with([
            'items.product',
            'items.variant',
            'coupon',
            'paymentTransactions.paymentMethod',
            'shipping.method',
            'shipping.address'
        ])->findOrFail($orderId);
    }

    /**
     * Cập nhật trạng thái đơn hàng (pending, paid, shipped, completed, canceled)
     */
    public function updateStatus($orderId, $status)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        return $order;
    }

    /**
     * Xóa đơn hàng
     */
    public function delete($orderId)
    {
        return Order::where('id', $orderId)->delete();
    }

    public function findWithRelations($id, $throw = true)
    {
        $query = Order::with([
            'items.product',
            'items.variant',
            'coupon',
            'shipping.method',
            'shipping.address',
            'paymentTransactions.paymentMethod'
        ]);
        return $throw ? $query->findOrFail($id) : $query->find($id);
    }
}
