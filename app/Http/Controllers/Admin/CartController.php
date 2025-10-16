<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $carts = $this->cartService->getAllCarts();
        return view('admin.carts.index', compact('carts'));
    }

    public function show($id)
    {
        $cart = $this->cartService->getCartById($id);
        return view('admin.carts.show', compact('cart'));
    }

    public function destroy($id)
    {
        $this->cartService->deleteCart($id);
        return redirect()->route('admin.carts.index')->with('success', 'Xoa gio hang thanh cong');
    }
}
