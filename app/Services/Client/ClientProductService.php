<?php

namespace App\Services\Client;

use App\Repositories\ProductRepository;

class ClientProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getProductsForList()
    {
        return $this->productRepo->getActivePaginated();
    }

    public function getProductDetail($id)
    {
        return $this->productRepo->findActiveById($id);
    }

    public function getRelatedProducts($product)
    {
        return $this->productRepo->getRelatedProducts($product);
    }
}
