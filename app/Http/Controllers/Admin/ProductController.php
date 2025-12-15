<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use App\Models\Category;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected ProductService $productService;
     protected ProductRepository $productRepo;

    public function __construct(
        ProductService $productService,
        ProductRepository $productRepo
    ) {
        $this->productService = $productService;
        $this->productRepo = $productRepo;
    }
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'status']);

        $products = $this->productService->getAllProducts($filters);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->createProduct($request->validated());

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'The product does not exist.');
        }
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $itemProduct = $this->productService->findProduct($id);
            if (!$itemProduct) {
                return redirect()
                    ->route('admin.products.index')
                    ->with('error', 'The product does not exist.');
            }

            $this->productRepo->update($itemProduct, $data);

            DB::commit();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product update successful.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Có thể ghi log lỗi tại đây
            Log::error($th);
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'An error occurred while updating the product.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->productService->deleteProduct($id);

        if ($result['success']) {
            return redirect()->route('admin.products.index')->with('success', $result['message']);
        }
        return redirect()->route('admin.products.index')->with('warning', $result['message']);
    }

    public function trashed()
    {
        $products = $this->productService->getTrashedProducts();
        return view('admin.products.trashed', compact('products'));
    }

    public function restore($id)
    {
        $this->productService->restoreProduct($id);
        return redirect()->route('admin.products.trashed')->with('success', 'Product restored!');
    }

    public function forceDelete($id)
    {
        $this->productService->forceDeleteProduct($id);
        return redirect()->route('admin.products.trashed')->with('success', 'The product has been permanently removed!');
    }
}
