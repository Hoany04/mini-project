<?php
namespace App\Repositories;

use App\Models\ProductReview;

class ProductReviewRepository
{
    public function getApprovedByProduct($productId)
    {
        return ProductReview::with('user')
        ->where('product_id', $productId)
        ->latest()
        ->get();
    }

    public function createReview(array $data)
    {
        return ProductReview::create($data);
    }

    public function findById($id)
    {
        return ProductReview::findOrFail($id);
    }

    public function updateReview(ProductReview $review, array $data)
    {
        return $review->update($data);
    }

    public function deleteReview(ProductReview $review)
    {
        return $review->delete();
    }
}
?>