<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {
        $products = Product::with('images')->where('status', 'active')->latest()->take(5)->get();

        return view('client.home', compact('products'));
    }
}
