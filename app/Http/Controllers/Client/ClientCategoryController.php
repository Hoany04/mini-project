<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientCategoryService;
use Illuminate\Http\Request;

class ClientCategoryController extends Controller
{
    protected ClientCategoryService $categoryService;

    public function __construct(ClientCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function show($slug)
    {
        $data = $this->categoryService->getCategoryData($slug);

        return view('client.pages.products.index', $data);
    }
}
