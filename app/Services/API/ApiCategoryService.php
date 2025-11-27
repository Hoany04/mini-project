<?php

namespace App\Services\API;

use App\Repositories\API\ApiCategoryRepository;

class ApiCategoryService
{
    protected ApiCategoryRepository $categoryRepo;

    public function __construct(ApiCategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllActive()
    {
        return $this->categoryRepo->getActiveCategories();
    }

    public function findCategoryWithProducts($id)
    {
        $category = $this->categoryRepo->findActiveById($id);
        $products = $this->categoryRepo->getActiveProductsByCategory($category);

        return compact('category', 'products');
    }
}
