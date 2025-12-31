<?php
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.user');
    }

    public function view(User $user): bool
    {
        return $user->checkPermissionTo('view.user');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create.user');
    }

    public function update(User $user): bool
    {
        return $user->checkPermissionTo('update.user');
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.user');
    }

    public function import(User $user): bool
    {
        return $user->checkPermissionTo('import.user');
    }

    public function export(User $user): bool
    {
        return $user->checkPermissionTo('export.user');
    }
}
