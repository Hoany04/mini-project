<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductImage;
class ProductImageRepository
{
    public function findProduct($productId)
    {
        return Product::findOrFail($productId);
    }

    /**
     * Tạo mới bản ghi ảnh sản phẩm
     */
    public function createImage($productId, $path, $isMain = false)
    {
        return ProductImage::create([
            'product_id' => $productId,
            'image_url' => $path,
            'is_main' => $isMain,
        ]);
    }

    /**
     * Tìm ảnh theo ID
     */
    public function findImage($id)
    {
        return ProductImage::findOrFail($id);
    }

    /**
     * Xóa ảnh trong DB và Storage
     */
    public function deleteImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_url);
        return $image->delete();
    }

    /**
     * Lấy danh sách ảnh của sản phẩm
     */
    public function getImagesByProduct($productId)
    {
        return ProductImage::where('product_id', $productId)->get();
    }

}
