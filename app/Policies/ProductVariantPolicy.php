<?php
namespace App\Policies;

use App\Models\ProductVariant;
use App\Models\User;

class ProductVariantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.product-variant');
    }

    /**
     * Determine whether the user hasPermission view the model.
     */
    public function view(User $user, ProductVariant $productVariant): bool
    {
        return $user->hasPermission('view.product-variant');
    }

    /**
     * Determine whether the user hasPermission create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('create.product-variant');
    }

    /**
     * Determine whether the user hasPermission update the model.
     */
    public function update(User $user, ProductVariant $productVariant): bool
    {
        return $user->hasPermission('update.product-variant');
    }

    /**
     * Determine whether the user hasPermission delete the model.
     */
    public function delete(User $user, ProductVariant $productVariant): bool
    {
        return $user->hasPermission('delete.product-variant');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProductVariant $productVariant): bool
    {
        return false;
    }
}
