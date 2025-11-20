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

    public function getFilteredProducts($request)
    {
        $filters = [];

        if ($request->has('price_range') && $request->price_range !== null) {

            [$min, $max] = explode('-', $request->price_range);

            // Xóa khoảng trắng để tránh lỗi
            $filters['price_min'] = (int) trim($min);
            $filters['price_max'] = (int) trim($max);
        }

        return $this->productRepo->filterProducts($filters);
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
