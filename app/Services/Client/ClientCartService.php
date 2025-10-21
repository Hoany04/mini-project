<?php

namespace App\Services\Client;

use App\Repositories\CartRepository;

class ClientCartService
{
    /**
     * Create a new class instance.
     */

     protected $cartRepo;
    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function getCart($userId)
    {
        return $this->cartRepo->getUserCart($userId);
    }

    public function addToCart($userId, array $data)
    {
        $cart = $this->cartRepo->getUserCart($userId);
        $item = $this->cartRepo->addItem($cart, $data);

        $this->updateTotal($cart);
        return $item;
    }

    public function updateQuantity($itemId, $quantity)
    {
        $item = $this->cartRepo->updateItemQuantity($itemId, $quantity);
        $this->updateTotal($item->cart);
        return $item;
    }

    public function deleteItem($itemId)
    {
        $item = $this->cartRepo->deleteItem($itemId);
    }

    protected function updateTotal($cart)
{
    // Tổng tiền gốc của tất cả sản phẩm
    $subtotal = $cart->items->sum(fn($i) => $i->price * $i->quantity);

    $discountAmount = 0;

    // Nếu cart có mã giảm giá
    if ($cart->coupon_id) {
        $coupon = $cart->coupon;

        if ($coupon && $subtotal >= $coupon->minimum_order_value) {
            if ($coupon->discount_type === 'percent') {
                $discountAmount = $subtotal * ($coupon->discount_value / 100);
            } else {
                $discountAmount = $coupon->discount_value;
            }

            // Giới hạn giảm giá không vượt quá tổng tiền
            $discountAmount = min($discountAmount, $subtotal);
        } else {
            // Nếu không đủ điều kiện, bỏ coupon
            $cart->update(['coupon_id' => null]);
        }
    }

    // Tổng thanh toán sau khi giảm
    $total = $subtotal - $discountAmount;

    // Cập nhật lại giỏ hàng
    $cart->update([
        'total_price' => $total,
        'discount' => $discountAmount
    ]);
}

}
