<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

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
            'is_main' => $isMain ? 1 : 0,
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
        if (Storage::disk('public')->exists($image->image_url))
        {
            Storage::disk('public')->delete($image->image_url);
        }

        if ($image->is_main) {
            $nextImage = ProductImage::where('product_id', $image->product_id)
            ->where('id', '!=', $image->id)
            ->first();

            if ($nextImage) {
                $nextImage->update(['is_main' => true]);
            }
        }
        return $image->delete();
    }

    /**
     * Lấy danh sách ảnh của sản phẩm
     */
    public function getImagesByProduct($productId)
    {
        return ProductImage::where('product_id', $productId)->orderByDesc('is_main')->get();
    }

}
