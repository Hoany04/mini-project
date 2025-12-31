<?php
namespace App\Policies;

use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.order');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.order');
    }

    public function updateOrderStatus(User $user): bool
    {
        return $user->checkPermissionTo('update.order-status');
    }

    public function updateOrderShipping(User $user): bool
    {
        return $user->checkPermissionTo('update.order-shipping');
    }
}
