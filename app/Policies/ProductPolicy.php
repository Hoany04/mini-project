<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.product');
    }

    /**
     * Determine whether the user hasPermission view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->hasPermission('view.product');
    }

    /**
     * Determine whether the user hasPermission create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('create.product');
    }

    public function edit(User $user): bool
    {
        return $user->hasPermission('create.product');
    }

    /**
     * Determine whether the user hasPermission update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->hasPermission('update.product');
    }

    /**
     * Determine whether the user hasPermission delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->hasPermission('delete.product');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
