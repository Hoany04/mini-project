<?php
namespace App\Policies;

use App\Models\User;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.cart');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.cart');
    }

    public function show(User $user): bool
    {
        return $user->checkPermissionTo('show.cart-details');
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.cart');
    }
}
