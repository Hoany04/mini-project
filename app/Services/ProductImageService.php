<?php

namespace App\Services;

use App\Repositories\ProductImageRepository;
use Illuminate\Http\UploadedFile;

class ProductImageService
{
    protected $productImageRepo;

    public function __construct(ProductImageRepository $productImageRepo)
    {
        $this->productImageRepo = $productImageRepo;
    }

    /**
     * Xử lý upload nhiều ảnh sản phẩm
     */
    public function uploadImages($productId, array $images)
    {
        $product = $this->productImageRepo->findProduct($productId);

        foreach ($images as $index => $image) {
            if (!($image instanceof UploadedFile)) {
                throw new \Exception('File tải lên không hợp lệ!');
            }

            // Lưu vào thư mục storage/app/public/products
            $path = $image->store('products', 'public');

            $this->productImageRepo->createImage($product->id, $path, $index === 0);
        }

        return true;
    }

    /**
     * Xử lý xóa ảnh sản phẩm
     */
    public function deleteImage($productId, $imageId)
    {
        $image = $this->productImageRepo->findImage($imageId);

        if ($image->product_id != $productId) {
            throw new \Exception("Ảnh không thuộc về sản phẩm này!");
        }

        return $this->productImageRepo->deleteImage($image);
    }
}
