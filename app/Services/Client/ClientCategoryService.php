<?php

namespace App\Services\Client;

use App\Repositories\CategoryRepository;

class ClientCategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getCategoriesForFilter()
    {
        return $this->categoryRepo->getCategoriesWithProductCount();
    }
}
