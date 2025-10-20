<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
class CartRepository
{
    /**
     * Create a new class instance.
     */

     public function getAllCarts()
     {
        return Cart::with('items.product.images')->get();
     }

     public function findById($id)
     {
         return Cart::with('items.product.images')->findOrFail($id);
     }

    public function getUserCart($userId)
    {
        return Cart::with('items.product.images')
            ->firstOrCreate(['user_id' => $userId]);
    }

    public function addItem(Cart $cart, array $data)
    {
        $item = $cart->items()
            ->where('product_id', $data['product_id'])
            ->where('variant_text', $data['variant_text'])
            ->first();

        if ($item) {
            $item->quantity += $data['quantity'];
            $item->save();
        } else {
            $item = $cart->items()->create($data);
        }

        return $item;
    }

    public function updateItemQuantity($itemId, $quantity)
    {
        $item = CartItem::findOrFail($itemId);
        $item->update(['quantity' => $quantity]);
        return $item;
    }

    public function deleteItem($itemId)
    {
        return CartItem::findOrFail($itemId)->delete();
    }
}
