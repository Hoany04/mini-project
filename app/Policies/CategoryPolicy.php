<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.category');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.category');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create.category');
    }

    public function update(User $user): bool
    {
        return $user->checkPermissionTo('update.category');
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.category');
    }
}
