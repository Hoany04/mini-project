<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientCategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();

        $childrenIds = $category->children()->pluck('id')->toArray();

        $categoryIds = array_merge([$category->id], $childrenIds);

        $products = Product::whereIn('category_id', $categoryIds)
            ->where('status', 1)
            ->paginate(8);

        $categories = Category::withCount('products')
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('client.pages.products.index', compact('categories', 'products', 'category'));
    }
}
