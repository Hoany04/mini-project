<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductReviewService;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $productReviewService;

    public function __construct(ProductReviewService $productReviewService)
    {
        $this->productReviewService = $productReviewService;
    }
    public function index(Request $request)
    {
        $reviews = $this->productReviewService->getPaginatedReviews(10);
        return view('admin.product_reviews.index', compact('reviews'));
    }

    public function toggleVisibility($id)
    {
        try {
            $this->productReviewService->toggleVisibility($id);
            return back()->with('success', 'Đã cập nhật trạng thái hiển thị của đánh giá');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->productReviewService->deleteReview($id);
            return back()->with('success', 'Đã xóa đánh giá thành công');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
}
