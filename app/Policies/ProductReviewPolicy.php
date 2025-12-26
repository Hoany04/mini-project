<?php
namespace App\Policies;

use App\Models\User;
use App\Models\ProductReview;

class ProductReviewPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view.product-review');
    }

    public function delete(User $user, ProductReview $review): bool
    {
        return $user->hasPermission('delete.product-review');
    }
}
