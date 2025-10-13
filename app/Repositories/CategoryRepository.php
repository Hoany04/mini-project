<?php

namespace App\Repositories;

use App\Models\Category;

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

    public function findById($id) 
    {
        return Category::findOrFail($id);
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
}
