<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Cart;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.cart');
    }

    public function view(User $user, Cart $cart): bool
    {
        return $user->hasPermission('view.cart');
    }

    public function show(User $user, Cart $cart): bool
    {
        return $user->hasPermission('show.cart-details');
    }

    public function delete(User $user, Cart $cart): bool
    {
        return $user->hasPermission('delete.cart');
    }
}
