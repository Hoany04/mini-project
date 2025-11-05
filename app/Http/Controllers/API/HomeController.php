<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')
            ->select('id', 'name')
            ->take(10)
            ->get();

        $featuredProducts = Product::where('status', 'active')
            ->orderBy('sold', 'desc')
            ->take(10)
            ->get();

        $newProducts = Product::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories,
            'featured_products' => $featuredProducts,
            'new_products' => $newProducts
        ]);
    }
}
