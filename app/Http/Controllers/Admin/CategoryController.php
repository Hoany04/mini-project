<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        $filters = $request->only(['search']);
        $categories = $this->categoryService->getAllCategories($filters);

        return view('admin.categorys.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = $this->categoryService->getParentCategories();
        return view('admin.categorys.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());
        return redirect()->route('admin.categorys.index')->with('success', 'Them danh muc thanh cong');
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
        $category = $this->categoryService->getCategoryById($id);

        if(!$category) {
            return redirect()->route('admin.categorys.index')->with('error', 'Danh muc khong ton tai');
        }
        $parentCategories = $this->categoryService->getParentCategories();
        return view('admin.categorys.edit', compact('parentCategories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->categoryService->updateCategory($id, $request->validated());
        return redirect()->route('admin.categorys.index')->with('success', 'Cap nhat danh muc thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('admin.categorys.index')->with('success', 'Xoa danh muc thanh cong');
    }
}
