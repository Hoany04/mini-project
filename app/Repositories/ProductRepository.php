<?php

namespace App\Repositories;
use App\Models\Product;

class ProductRepository
{
    /**
     * Create a new class instance.
     */
    public function getAll($filters = [])
    {
        $query = Product::with(['category', 'user', 'mainImage']);

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['status'])) {
            $query->orderByDesc('id');
        }

        return $query->paginate(10);
    }

    // client
    public function filterProducts(array $filters)
    {

        $query = Product::query()->where('status', 1);

        if (isset($filters['price_min']) && isset($filters['price_max'])) {
            $query->whereBetween('price', [
                $filters['price_min'],
                $filters['price_max'],
            ]);
        }

        return $query->paginate(12)->withQueryString();
    }

    public function findById($id, $throw = true)
    {
        $query = Product::with(['category', 'user', 'mainImage']);
        return $throw ? $query->findOrFail($id) : $query->find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        return $product->update($data);
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }

    public function getAllWithTrashed($filters = [])
    {
        $query = Product::withTrashed()->with(['category', 'user', 'mainImage']);

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->paginate(10);
    }

    public function getOnlyTrashed()
    {
        return Product::onlyTrashed()->with(['category', 'user', 'mainImage'])->paginate(10);
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return $product;
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        return $product->forceDelete();
    }

    public function deactivateProduct(Product $product)
    {
        $product->update(['status' => 'inactive']);
        return $product;
    }

    // client

    public function getActivePaginated($perPage = 8)
    {
        return Product::where('status', 'active')->paginate($perPage);
    }

    public function findActiveById($id)
    {
        return Product::with(['images', 'variants', 'reviews.user'])
        ->where('status', 'active')
        ->find($id);
    }

    public function getRelatedProducts($product, $limit = 4)
    {
        return Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take($limit)
            ->get();
    }

}
