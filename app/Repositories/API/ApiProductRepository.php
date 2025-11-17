<?php
namespace App\Repositories\API;

use App\Models\Product;

class ApiProductRepository
{
    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function decreaseStock($productId, $qty)
    {
        return Product::where('id', $productId)->decrement('stock', $qty);
    }

    public function increaseSold($productId, $qty)
    {
        return Product::where('id', $productId)->increment('sold', $qty);
    }
}
?>
