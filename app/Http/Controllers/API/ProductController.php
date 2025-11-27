<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\ApiProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ApiProductService $apiProductService;

    public function __construct(ApiProductService $apiProductService)
    {
        $this->apiProductService = $apiProductService;
    }
    // GET /api/products
    public function index(Request $request)
    {
        $filters = $request->only(['category_id', 'search']);
        $products = $this->apiProductService->listProducts($filters);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = $this->apiProductService->getProductDetail($id);

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }

}
