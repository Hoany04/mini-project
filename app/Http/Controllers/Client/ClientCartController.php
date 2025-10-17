<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    public function index()
    {
        return view('client.pages.cart.index');
    }

    public function addCart(Request $request)
    {
        // $productId = $request->input('product_id');
        // $quantity = $request->input('quantity');

        // $product = Product::query()->findOrFail($productId);

        // $cart = session()->get('cart', []);

        // if (isset($cart[$productId])) {
        //     $cart[$productId]['so_luong'] += $quantity;
        // } else {
        //     'name' => $product->name,
        //     'stock' => $product->stock,
        //     'price' => $product->price,
            
        // }
    } 
}
