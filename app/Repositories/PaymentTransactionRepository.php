<?php

namespace App\Repositories;

use App\Models\PaymentTransaction;

class PaymentTransactionRepository
{
    public function create(array $data)
    {
        return PaymentTransaction::create($data);
    }
}
