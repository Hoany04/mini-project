<?php
namespace App\Policies;

use App\Models\User;
use App\Models\PaymentTransaction;

class PaymentTransactionsPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.payment-transaction');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('show.payment-transaction-details');
    }
}
