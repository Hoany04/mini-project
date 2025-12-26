<?php
namespace App\Policies;

use App\Models\User;
use App\Models\ShippingMethod;

class ShippingMethodPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.shipping');
    }

    public function view(User $user, ShippingMethod $shippingMethod): bool
    {
        return $user->hasPermission('view.shipping');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create.shipping');
    }

    public function update(User $user, ShippingMethod $shippingMethod): bool
    {
        return $user->hasPermission('update.shipping');
    }

    public function delete(User $user, ShippingMethod $shippingMethod): bool
    {
        return $user->hasPermission('delete.shipping');
    }
}
