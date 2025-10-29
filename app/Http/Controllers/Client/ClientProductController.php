<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
        ->whereNull('parent_id')
        ->with(['children' => function ($query) {
            $query->withCount('products');
        }])
        ->get();

        $products = Product::where('status', 1)->paginate(8);

        return view('client.pages.products.index', compact('products', 'categories'));
    }

    // Trang chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::with(['images', 'variants', 'reviews.user'])
        ->where('status', 'active')
        ->find($id);

        if (!$product) {
            return redirect()->route('client.pages.products.index')->with('error', 'San pham khong ton tai');
        }

    // Gom nhóm biến thể theo tên (vd: màu sắc, kích thước)
        $groupedVariants = $product->variants->groupBy('variant_name');

        $averageRating = $product->reviews->avg('rating') ?? 0;

        $reviews = $product->reviews()->where('is_visible', true)->with('user')->latest()->get();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->where('status', 'active')
            ->take(4)
            ->get();

        return view('client.pages.products.detail', compact('product', 'groupedVariants', 'averageRating', 'relatedProducts', 'reviews'));
    }
}
