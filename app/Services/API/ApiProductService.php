<?php
namespace App\Services\API;

use App\Repositories\API\ApiProductRepository;

class ApiProductService
{
    protected ApiProductRepository $productRepo;

    public function __construct(ApiProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function listProducts(array $filters)
    {
        return $this->productRepo->getActiveProducts($filters);
    }

    public function getProductDetail($id)
    {
        return $this->productRepo->findActiveProduct($id);
    }
}
