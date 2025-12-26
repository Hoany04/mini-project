<?php
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.user');
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasPermission('view.user');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create.user');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermission('update.user');
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasPermission('delete.user');
    }

    public function import(User $user): bool
    {
        return $user->hasPermission('import.user');
    }

    public function export(User $user): bool
    {
        return $user->hasPermission('export.user');
    }
}
