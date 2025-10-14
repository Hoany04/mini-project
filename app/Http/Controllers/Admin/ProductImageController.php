<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $product = Product::findOrFail($productId);

        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path,
                'is_main' => $index === 0
            ]);
        }

        return back()->with('success', 'Da them anh cho san pham');
    }

    public function destroy($id)
    {
        $image = ProductImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_url);
        $image->delete();

        return back()->with('success', 'Da xoa anh san pham');
    }
}
