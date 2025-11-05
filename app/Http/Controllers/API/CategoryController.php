<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Category::where('status', 'active')
            ->select('id', 'name', 'description')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

        // GET /api/categories/{id}
    public function show($id)
    {
        $category = Category::where('status', 'active')
            ->select('id', 'name')
            ->findOrFail($id);

        $products = $category->products()
            ->where('status', 'active')
            ->select('id', 'name', 'price', 'average_rating', 'total_review')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'category' => $category,
            'products' => $products
        ]);
    }
}
