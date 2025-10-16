<?php

namespace App\Repositories;

use App\Models\Cart;
class CartRepository
{
    /**
     * Create a new class instance.
     */
    public function getAllCarts()
    {
        return Cart::with('user', 'items.product', 'items.variant')
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function findById($id)
    {
        return Cart::with('user', 'items.product', 'items.variant')->findOrFail($id);
    }

    public function deleteCart($id)
    {
        return Cart::findOrFail($id)->delete();
    }
}
