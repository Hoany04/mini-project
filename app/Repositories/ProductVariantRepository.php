<?php

namespace App\Repositories;

use App\Models\ProductVariant;
class ProductVariantRepository
{
    /**
     * Create a new class instance.
     */
    public function getAllByProduct($productId)
    {
        return ProductVariant::where('product_id', $productId)->get();
    }

    public function create(array $data)
    {
        return ProductVariant::create($data);
    }

    public function find($id)
    {
        return ProductVariant::findOrFail($id);
    }

    public function update(ProductVariant $variant, array $data)
    {
        return $variant->update($data);
    }

    public function delete(ProductVariant $variant)
    {
        return $variant->delete();
    }
}
