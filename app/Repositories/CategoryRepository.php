<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;

class CategoryRepository
{
    /**
     * Create a new class instance.
     */
    public function getAll($filters = [])
    {
        $query = Category::with('parent', 'creator');

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->orderBy('id', 'desc')->paginate(10);
    }

    public function findById($id, $throw = true) 
    {
        $query = Category::query();
        return $throw ? $query->findOrFail($id) : $query->find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        return $category->update($data);
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }

    public function getParentCategories()
    {
        return Category::whereNull('parent_id')->get();
    }

    public function getCategoriesWithProductCount()
    {
        return Category::withCount('products')
        ->whereNull('parent_id')
        ->with(['children' => function ($query) {
            $query->withCount('products');
        }])
        ->get();
    }
    // client
    // tim danh muc theo slug
    public function findBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    // Lay id cua cac danh muc con
    public function getChildrenIds(Category $category)
    {
        return $category->children()->pluck('id')->toArray();
    }

    // Lay danh sach san pham trong cac danh muc chi dinh
    public function getProductsByCategoryIds(array $categoryIds)
    {
        return Product::whereIn('category_id', $categoryIds)
            ->where('status', 1)
            ->paginate(8);
    }

    //Lay toan bo danh muc cha(cap 1) va danh muc con kem so luong san pham
    public function getAllParentCategoriesWithChildren()
    {
        return Category::withCount('products')
            ->whereNull('parent_id')
            ->with('children')
            ->get();
    }
}
