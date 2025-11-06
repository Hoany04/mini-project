<?php

namespace App\Services\Client;

use App\Repositories\CartRepository;
use App\Models\Product;
use App\Models\ProductVariant;

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
        $product = Product::findOrFail($data['product_id']);

        // --- Kiểm tra tồn kho (nếu có variant) ---
        if (!empty($data['variant_id'])) {
            $variant = ProductVariant::find($data['variant_id']);
            if (!$variant) {
                throw new \Exception('Biến thể không tồn tại.');
            }

            if ($data['quantity'] > $variant->stock) {
                throw new \Exception('Số lượng vượt quá tồn kho của sản phẩm này.');
            }
        } else {
            // Nếu sản phẩm có biến thể mà chưa chọn
            $hasVariants = ProductVariant::where('product_id', $product->id)->exists();
            if ($hasVariants) {
                throw new \Exception('Vui lòng chọn đủ size và màu trước khi thêm vào giỏ hàng.');
            }

            // Nếu sản phẩm không có variant, kiểm tra stock sản phẩm
            if ($data['quantity'] > $product->stock) {
                throw new \Exception('Số lượng vượt quá tồn kho sản phẩm.');
            }
        }

        // --- Thêm vào giỏ ---
        $cart = $this->cartRepo->getUserCart($userId);
        $item = $this->cartRepo->addItem($cart, $data);

        $this->updateTotal($cart);
        return $item;
    }

    public function updateQuantity($itemId, $quantity)
    {
        $item = $this->cartRepo->findItemById($itemId);

        if (!$item) {
            throw new \Exception('Không tìm thấy sản phẩm trong giỏ hàng.');
        }

        $product = $item->product;

        // Kiểm tra tồn kho
        if ($item->variant_id) {
            // Nếu có variant -> kiểm tra tồn kho theo variant
            $variant = $item->variant;
            if (!$variant) {
                throw new \Exception('Biến thể sản phẩm không hợp lệ.');
            }

            if ($quantity > $variant->stock) {
                throw new \Exception("Số lượng tồn kho chỉ còn {$variant->stock} sản phẩm.");
            }
        } else {
            // Nếu không có variant -> kiểm tra tồn kho sản phẩm chính
            if ($quantity > $product->stock) {
                throw new \Exception("Số lượng tồn kho chỉ còn {$product->stock} sản phẩm.");
            }
        }

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
