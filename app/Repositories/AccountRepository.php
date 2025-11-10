<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Models\UserProfile;

class AccountRepository
{
    /**
     * Lấy danh sách đơn hàng của user (kèm quan hệ)
     */
    public function getOrdersByUser($userId)
    {
        return Order::where('user_id', $userId)
            ->with([
                'items.product.images',
                'paymentTransactions.paymentMethod',
                'coupon'
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Lấy thông tin user kèm profile
     */
    public function getUserWithProfile($userId)
    {
        return User::with('profile')->findOrFail($userId);
    }

    /**
     * Lấy hoặc tạo profile cho user
     */
    public function getOrCreateProfile($user)
    {
        return $user->profile ?? new UserProfile(['user_id' => $user->id]);
    }
}
