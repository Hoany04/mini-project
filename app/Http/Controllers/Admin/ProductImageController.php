<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductImage\StoreRequest;

class ProductImageController extends Controller
{
    protected $productImageService;
     public function __construct(
        ProductImageService $productImageService
    )
    {
        $this->productImageService = $productImageService;
    }

    public function store(StoreRequest $request, $productId)
    {
        try {
            $this->productImageService->uploadImages($productId, $request->file('images'));
            return back()->with('success', 'Product images have been added!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function destroy($productId, $id)
    {
        try {
            $this->productImageService->deleteImage($productId, $id);
            return back()->with('success', 'Product image has been deleted!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
