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

    public function deactivateProduct(Product $product)
    {
        $product->update(['status' => 'inactive']);
        return $product;
    }
}
