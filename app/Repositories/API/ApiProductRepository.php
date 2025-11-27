<?php
namespace App\Repositories\API;

use App\Models\Product;
use App\Enums\ProductStatus;

class ApiProductRepository
{
    public function getActiveProducts(array $filters = [])
    {
        $query = Product::where('status', ProductStatus::ACTIVE)
            ->select('id', 'name', 'price', 'average_rating', 'total_review')
            ->with('mainImage');

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Tìm kiếm theo từ khóa sản phẩm
        if (!empty($filters['search'])) {
            $query->where('name', 'LIKE', "%{$filters['search']}%");
        }

        return $query->paginate(10);
    }

    public function findActiveProduct($id)
    {
        return Product::where('status', ProductStatus::ACTIVE)
            ->with([
                    'images:id,product_id,image_url,is_main',
                    'variants:id,product_id,variant_name,variant_value,stock',
                    'reviews' => function($q){
                        $q->select('id','product_id','user_id','rating','comment','created_at')
                        ->with('user:id,username');
                    },
                ])
                ->select('id', 'name', 'price', 'description', 'average_rating', 'total_review')
                ->findOrFail($id);
    }
    public function getProductsByIds(array $ids)
    {
        return Product::whereIn('id', $ids)->get()->keyBy('id');
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
