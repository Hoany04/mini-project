<?php

namespace App\Repositories\API;

use App\Models\Category;
use App\Enums\CategoryStatus;

class ApiCategoryRepository
{
    public function getActiveCategories()
    {
        return Category::where('status', CategoryStatus::ACTIVE->value)
            ->select('id', 'name', 'description')
            ->orderBy('name')
            ->get();
    }

    public function findActiveById($id)
    {
        return Category::where('status', CategoryStatus::ACTIVE->value)
            ->select('id', 'name')
            ->findOrFail($id);
    }

    public function getActiveProductsByCategory(Category $category, $perPage = 10)
    {
        return $category->products()
            ->where('status', CategoryStatus::ACTIVE->value)
            ->select('id', 'name', 'price', 'average_rating', 'total_review')
            ->paginate($perPage);
    }
}
