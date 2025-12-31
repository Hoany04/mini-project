<?php
namespace App\Policies;

use App\Models\User;

class ProductReviewPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view.product-review');
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionTo('delete.product-review');
    }
}
