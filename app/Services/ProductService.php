<?php

namespace App\Services;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    /**
     * Create a new class instance.
     */

     protected $productRepo;
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
            $this->productRepo->deactivateProduct($product);
            return [
                'success' => false,
                'message' => 'San pham dang ton tai trong don hang, he thong chuyen sang trang thai "Ngung hoat dong" . '
            ];
        }

        $this->productRepo->delete($product);
        return [
            'success' => true,
            'message' => 'Da xoa san pham thanh cong.'
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
