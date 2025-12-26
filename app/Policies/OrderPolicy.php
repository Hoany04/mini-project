<?php
namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.order');
    }

    public function view(User $user, Order $order): bool
    {
        return $user->hasPermission('view.order');
    }

    public function updateOrderStatus(User $user, Order $order): bool
    {
        return $user->hasPermission('update.order-status');
    }

    public function updateOrderShipping(User $user, Order $order): bool
    {
        return $user->hasPermission('update.order-shipping');
    }
}
