<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')
            ->where('status', 'active')
            ->latest()
            ->paginate(8);

        return view('client.pages.products.index', compact('products'));
    }

    // Trang chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::with(['images', 'variants', 'reviews.user'])
        ->where('status', 'active')
        ->findOrFail($id);

    // Gom nhóm biến thể theo tên (vd: màu sắc, kích thước)
        $groupedVariants = $product->variants->groupBy('variant_name');

        $averageRating = $product->reviews->avg('rating') ?? 0;

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->where('status', 'active')
            ->take(4)
            ->get();

        return view('client.pages.products.detail', compact('product', 'groupedVariants', 'averageRating', 'relatedProducts'));
    }
}
