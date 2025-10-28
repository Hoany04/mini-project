<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ProductReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProductReviewController extends controller
{
    protected $reviewService;

    public function __construct(ProductReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(Request $request, $productId)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $this->reviewService->createReview(Auth::id(), $productId, $data);

        return redirect()->back()->with('success', 'Cam on ban da danh gia san pham!');
    }
}
?>