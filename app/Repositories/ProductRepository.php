<?php

namespace App\Repositories;
use App\Models\Product;
use Illuminate\Http\Request;

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
            $query->where('status', $filters['status']);
        }

        return $query->paginate(10);
    }

    // client
    public function filterProducts(Request $request)
    {

        $query = Product::query();

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [
                intval($request->min_price),
                intval($request->max_price),
            ]);
        }

        // FILTER COLOR
        if ($request->filled('colors')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('variant_name', 'Màu')
                ->whereIn('variant_value', $request->colors);
            });
        }

        // FILTER SIZE
        if ($request->filled('sizes')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('variant_name', 'Size')
                ->whereIn('variant_value', $request->sizes);
            });
        }

        return $query->paginate(12);
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
