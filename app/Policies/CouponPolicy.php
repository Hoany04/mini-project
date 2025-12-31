<?php
namespace App\Policies;

use App\Models\User;

class CouponPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.coupon');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.coupon');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create.coupon');
    }

    public function update(User $user): bool
    {
        return $user->checkPermissionTo('update.coupon');
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.coupon');
    }
}
