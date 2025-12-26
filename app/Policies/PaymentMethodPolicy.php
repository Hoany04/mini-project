<?php
namespace App\Policies;

use App\Models\User;
use App\Models\PaymentMethod;

class PaymentMethodPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.payment-method');
    }

    public function view(User $user, PaymentMethod $paymentMethod): bool
    {
        return $user->hasPermission('view.payment-method');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create.payment-method');
    }

    public function update(User $user, PaymentMethod $paymentMethod): bool
    {
        return $user->hasPermission('update.payment-method');
    }

    public function delete(User $user, PaymentMethod $paymentMethod): bool
    {
        return $user->hasPermission('delete.payment-method');
    }
}
