<?php
namespace App\Services\Client;

use App\Repositories\ProductReviewRepository;

class ProductReviewService
{
    protected $reviewRepo;

    public function __construct(ProductReviewRepository $reviewRepo)
    {
        $this->reviewRepo = $reviewRepo;
    }

    public function getApprovedReviews($productId)
    {
        return $this->reviewRepo->getApprovedByProduct($productId);
    }

    public function createReview($userId, $productId, $data)
    {
        $data['user_id'] = $userId;
        $data['product_id'] = $productId;
        return $this->reviewRepo->createReview($data);
    }
}
?>