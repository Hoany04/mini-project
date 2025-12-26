<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Coupon;

class CouponPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.coupon');
    }

    public function view(User $user, Coupon $coupon): bool
    {
        return $user->hasPermission('view.coupon');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create.coupon');
    }

    public function update(User $user, Coupon $coupon): bool
    {
        return $user->hasPermission('update.coupon');
    }

    public function delete(User $user, Coupon $coupon): bool
    {
        return $user->hasPermission('delete.coupon');
    }
}
