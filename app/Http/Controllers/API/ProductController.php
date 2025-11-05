<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products
    public function index(Request $request)
    {
        $query = Product::where('status', 'active')
            ->select('id', 'name', 'price', 'average_rating', 'total_review')
            ->with('mainImage');

        // Lọc theo danh mục
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Tìm kiếm theo từ khóa sản phẩm
        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $products = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::where('status', 'active')
            ->with([
                'images:id,product_id,image_url,is_main',
                'variants:id,product_id,variant_name,variant_value,stock',
                'reviews' => function($q){
                    $q->select('id','product_id','user_id','rating','comment','created_at')
                    ->with('user:id,username');
                }
            ])
            ->select('id', 'name', 'price', 'description', 'average_rating', 'total_review')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }

}
