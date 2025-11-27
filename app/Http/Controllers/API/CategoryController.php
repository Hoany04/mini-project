<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\ApiCategoryService;

class CategoryController extends Controller
{
    protected ApiCategoryService $apiCategoryService;

    public function __construct(ApiCategoryService $apiCategoryService)
    {
        $this->apiCategoryService = $apiCategoryService;
    }
    // GET /api/categories
    public function index()
    {
        $categories = $this->apiCategoryService->getAllActive();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

        // GET /api/categories/{id}
    public function show($id)
    {
        $data = $this->apiCategoryService->findCategoryWithProducts($id);

        return response()->json([
            'success' => true,
            'category' => $data['category'],
            'products' => $data['products']
        ]);
    }
}
