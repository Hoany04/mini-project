<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\CartService;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $this->authorize('viewAny', Cart::class);
        $carts = $this->cartService->getAllCarts();
        return view('admin.carts.index', compact('carts'));
    }

    public function show($id)
    {
        $cart = Cart::findOrFail($id);
        $this->authorize('show', $cart);
        $cart = $this->cartService->getCartById($id);
        return view('admin.carts.show', compact('cart'));
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $this->authorize('delete', $cart);
        $this->cartService->deleteCart($id);
        
        return redirect()->route('admin.carts.index')->with('success', 'Shopping cart deleted successfully');
    }
}
