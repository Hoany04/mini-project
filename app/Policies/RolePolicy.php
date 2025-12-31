<?php
namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.role');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.role');
    }
}
