<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
use App\Services\ProductVariantService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    protected ProductVariantService $variantService;

    public function __construct(ProductVariantService $variantService)
    {
        $this->variantService = $variantService;
    }

    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $variants = $this->variantService->getByProduct($productId);

        return view('admin.product_variants.index', compact('product', 'variants'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('admin.product_variants.create', compact('product'));
    }

    public function store(ProductVariantRequest $request, $productId)
    {
        $data = $request->validated();
        $data['product_id'] = $productId;
        $this->variantService->create($data);

        return redirect()->route('admin.product_variants.index', $productId)->with('success', 'Them bien the thanh cong');
    }

    public function edit($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $variant = $this->variantService->getByProduct($productId)->find($id);

        return view('admin.product_variants.edit', compact('product', 'variant'));
    }

    public function update(ProductVariantRequest $request, $productId, $id)
    {
        $this->variantService->update($id, $request->validated());
        return redirect()->route('admin.product_variants.index', $productId)->with('success', 'Cap nhat bien the thanh cong');
    }

    public function destroy($productId, $id)
    {
        $this->variantService->delete($id);
        return redirect()->route('admin.product_variants.index', $productId)->with('success', 'Da xoa bien the');
    }
}
