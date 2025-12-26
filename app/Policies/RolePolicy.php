<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.role');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->hasPermission('view.role');
    }
}
