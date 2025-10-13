<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    /**
     * Create a new class instance.
     */

     protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllCategories($filters = [])
    {
        return $this->categoryRepo->getAll($filters);
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepo->findById($id);
    }

    public function createCategory(array $data)
    {
        $data['created_by'] = Auth::id();
        return $this->categoryRepo->create($data);
    }

    public function updateCategory($id, array $data)
    {
        $category = $this->categoryRepo->findById($id);
        $this->categoryRepo->update($category, $data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryRepo->findById($id);
        $this->categoryRepo->delete($category);
    }

    public function getParentCategories()
    {
        return $this->categoryRepo->getParentCategories();
    }
}
