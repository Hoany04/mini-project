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
        $itemQuery = $cart->items()
            ->where('product_id', $data['product_id']);

        // Nếu có variant_id thì thêm điều kiện
        if (!empty($data['variant_id'])) {
            $itemQuery->where('variant_id', $data['variant_id']);
        } else {
            $itemQuery->whereNull('variant_id');
        }

        // Nếu có text (ví dụ "Size: L, Màu: Đỏ") thì cũng so sánh
        if (!empty($data['variant_text'])) {
            $itemQuery->where('variant_text', $data['variant_text']);
        }

        $item = $itemQuery->first();

        if ($item) {
            $item->quantity += $data['quantity'];
            $item->save();
        } else {
            // Bảo đảm có cart_id để tạo item đúng
            $data['cart_id'] = $cart->id;
            $item = CartItem::create($data);
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

    public function clearCart($cartId)
    {
        $cart = Cart::findOrFail($cartId);

        // Xóa các sản phẩm trong giỏ
        $cart->items()->delete();

        // Đặt lại tổng giá trị giỏ
        $cart->update(['total_price' => 0]);

        return true;
    }

    public function findItemById($itemId)
    {
        return CartItem::with(['cart', 'product', 'variant'])->find($itemId);
    }

    public function findItemInCart(Cart $cart, $productId, $variantId = null, $variantText = null)
    {
        $query = $cart->items()->where('product_id', $productId);

        if ($variantId) {
            $query->where('variant_id', $variantId);
        } else {
            $query->whereNull('variant_id');
        }

        if ($variantText) {
            $query->where('variant_text', $variantText);
        }

        return $query->first();
    }

}
