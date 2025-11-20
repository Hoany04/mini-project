<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientProductService;
use App\Services\Client\ClientCategoryService;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ClientProductService $productService, ClientCategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        
        $categories = $this->categoryService->getCategoriesForFilter();
        $products = $this->productService->getProductsForList();
        $product = $this->productService->getFilteredProducts($request);

        return view('client.pages.products.index', compact('products', 'product', 'categories'));
    }

    // Trang chi tiết sản phẩm
    public function show($id)
    {
        $product = $this->productService->getProductDetail($id);

        if (!$product) {
            return redirect()->route('client.pages.products.index')
                ->with('error', 'Sản phẩm không tồn tại');
        }

        $products = $this->productService->getProductsForList();
        $relatedProducts = $this->productService->getRelatedProducts($product);

        $groupedVariants = $product->variants->groupBy('variant_name');
        $averageRating = $product->reviews->avg('rating') ?? 0;
        $reviews = $product->reviews()
                        ->where('is_visible', true)
                        ->with('user')
                        ->latest()
                        ->get();

        $attributes = $product->variants
            ->groupBy('variant_name')
            ->map(fn($group) => $group->pluck('variant_value')->unique()->values());

        return view('client.pages.products.detail', compact(
            'product',
            'products',
            'groupedVariants',
            'averageRating',
            'relatedProducts',
            'reviews',
            'attributes'
        ));
    }
}
