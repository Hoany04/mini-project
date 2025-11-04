<?php

namespace App\Repositories;

use App\Models\PaymentTransaction;

class PaymentTransactionRepository
{
    public function getAll($filters = [])
    {
        return PaymentTransaction::with(['order', 'paymentMethod'])
        ->when(isset($filters['status']), function ($query) use ($filters) {
            $query->where('status', $filters['status']);
        })
        ->when(isset($filters['payment_method_id']), function ($query) use ($filters) {
            $query->where('payment_method_id', $filters['payment_method_id']);
        })
        ->when(isset($filters['order_id']), function ($query) use ($filters) {
            $query->where('order_id', $filters['order_id']);
        })
        ->orderByDesc('created_at')
        ->paginate(10);
    }

    public function find($id)
    {
        return PaymentTransaction::with(['order', 'paymentMethod'])->findOrFail($id);
    }
    public function create(array $data)
    {
        return PaymentTransaction::create($data);
    }
}
