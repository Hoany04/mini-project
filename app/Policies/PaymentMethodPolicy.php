<?php
namespace App\Policies;

use App\Models\User;

class PaymentMethodPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.payment-method');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.payment-method');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create.payment-method');
    }

    public function update(User $user): bool
    {
        return $user->checkPermissionTo('update.payment-method');
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.payment-method');
    }
}
