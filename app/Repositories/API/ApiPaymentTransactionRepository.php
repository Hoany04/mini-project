<?php

namespace App\Repositories\API;

use App\Models\PaymentTransaction;

class ApiPaymentTransactionRepository
{
    public function getByUserId($userId, $perPage = 10)
    {
        return PaymentTransaction::with(['order'])
            ->whereHas('order', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function getByIdAndUser($id, $userId)
    {
        return PaymentTransaction::with([
            'order.items.product',
            'order.user'
            ])
            ->where('id', $id)
            ->whereHas('order', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->first();
    }
}
