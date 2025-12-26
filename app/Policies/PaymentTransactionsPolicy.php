<?php
namespace App\Policies;

use App\Models\User;
use App\Models\PaymentTransaction;

class PaymentTransactionsPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.payment-transaction');
    }

    public function view(User $user, PaymentTransaction $transaction): bool
    {
        return $user->hasPermission('show.payment-transaction-details');
    }
}
