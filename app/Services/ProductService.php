<?php

namespace App\Services;

use App\Enums\ProductStatus;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    /**
     * Create a new class instance.
     */

     protected ProductRepository $productRepo;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getAllProducts($filters = [])
    {
        return $this->productRepo->getAll($filters);
    }

    public function getProductById($id)
    {
        return $this->productRepo->findById($id, false);
    }

    public function createProduct(array $data)
    {
        $data['user_id'] = Auth::id();
        $data['sold'] = 0;
        $data['average_rating'] = 0;
        $data['total_review'] = 0;

        // Convert Status -> enum
        if (!empty($data['status'])) {
            try {
                $data['status'] = ProductStatus::from($data['status'])->value;
            } catch (\ValueError $e) {
                throw new \Exception("Invalid product status");
            }
        }

        return $this->productRepo->create($data);
    }

    public function findProduct($id)
    {
        return $this->productRepo->findById($id);
        // $this->productRepo->update($product, $data);
        // return $product;
    }

    public function deleteProduct($id)
    {
        $product = $this->productRepo->findById($id);

        if ($product->orderItems()->exists()) {

            $product->status = ProductStatus::INACTIVE->value;
            $product->save();

            return [
                'success' => false,
                'message' => 'The product is currently in the order; the system has switched to "Inactive" status . '
            ];
        }

        $this->productRepo->delete($product);

        return [
            'success' => true,
            'message' => 'The product has been successfully removed.'
        ];
    }

    public function getTrashedProducts()
    {
        return $this->productRepo->getOnlyTrashed();
    }

    public function getAllWithTrashed($filters = [])
    {
        return $this->productRepo->getAllWithTrashed($filters);
    }

    public function restoreProduct($id)
    {
        return $this->productRepo->restore($id);
    }

    public function forceDeleteProduct($id)
    {
        return $this->productRepo->forceDelete($id);
    }
}
