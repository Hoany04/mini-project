<?php
namespace App\Policies;

use App\Models\User;

class ShippingMethodPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.shipping');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.shipping');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create.shipping');
    }

    public function update(User $user): bool
    {
        return $user->checkPermissionTo('update.shipping');
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.shipping');
    }
}
