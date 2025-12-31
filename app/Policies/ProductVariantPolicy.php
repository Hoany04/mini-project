<?php
namespace App\Policies;

use App\Models\User;

class ProductVariantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.product-variant');
    }

    /**
     * Determine whether the user hasPermission view the model.
     */
    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.product-variant');
    }

    /**
     * Determine whether the user hasPermission create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create.product-variant');
    }

    /**
     * Determine whether the user hasPermission update the model.
     */
    public function update(User $user): bool
    {
        return $user->checkPermissionTo('update.product-variant');
    }

    /**
     * Determine whether the user hasPermission delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.product-variant');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return false;
    }
}
