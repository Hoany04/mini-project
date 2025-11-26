<?php

namespace App\Services;

use App\Repositories\ProductReviewRepository;

class ProductReviewService
{
    protected ProductReviewRepository $reviewRepo;

    public function __construct(ProductReviewRepository $reviewRepo)
    {
        $this->reviewRepo = $reviewRepo;
    }

    /**
     * Lấy danh sách review có phân trang
     */
    public function getPaginatedReviews($perPage = 10)
    {
        return $this->reviewRepo->getAllPaginated($perPage);
    }

    /**
     * Ẩn/hiện review
     */
    public function toggleVisibility($id)
    {
        $review = $this->reviewRepo->findById($id);
        return $this->reviewRepo->toggleVisibility($review);
    }

    /**
     * Xóa review
     */
    public function deleteReview($id)
    {
        $review = $this->reviewRepo->findById($id);
        return $this->reviewRepo->delete($review);
    }
}
