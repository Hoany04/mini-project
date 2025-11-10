<?php
namespace App\Repositories;

use App\Models\ProductReview;

class ProductReviewRepository
{
    public function getAllPaginated($perPage = 10)
    {
        return ProductReview::with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function createReview(array $data)
    {
        return ProductReview::create($data);
    }

    public function findById($id)
    {
        return ProductReview::findOrFail($id);
    }

    public function toggleVisibility(ProductReview $review)
    {
        $review->is_visible = !$review->is_visible;
        $review->save();

        return $review;
    }

    public function updateReview(ProductReview $review, array $data)
    {
        return $review->update($data);
    }

    public function delete(ProductReview $review)
    {
        return $review->delete();
    }
}
?>