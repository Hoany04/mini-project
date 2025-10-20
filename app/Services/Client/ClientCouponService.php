<?php

namespace App\Services\Client;

use App\Models\Coupon;
use App\Models\Cart;
use Illuminate\Validation\ValidationException;

class ClientCouponService
{
    /**
     * Áp dụng mã giảm giá cho giỏ hàng của người dùng
     */
    public function applyCoupon($userId, string $couponCode)
    {
        // 1. Lấy mã giảm giá
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá không tồn tại.',
            ]);
        }

        // 2. Kiểm tra trạng thái mã
        if ($coupon->status !== 'active') {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá không còn hiệu lực.',
            ]);
        }

        // 3. Kiểm tra thời gian hiệu lực
        $now = now();
        if ($coupon->start_date && $now->lt($coupon->start_date)) {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá chưa đến thời gian sử dụng.',
            ]);
        }
        if ($coupon->end_date && $now->gt($coupon->end_date)) {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá đã hết hạn.',
            ]);
        }

        // 4. Lấy giỏ hàng người dùng
        $cart = Cart::with('items')->where('user_id', $userId)->first();

        if (!$cart || $cart->items->isEmpty()) {
            throw ValidationException::withMessages([
                'coupon' => 'Giỏ hàng trống, không thể áp dụng mã.',
            ]);
        }

        // 5. Tính tổng tiền giỏ hàng
        $cartTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        // 6. Kiểm tra giá trị tối thiểu
        if ($cartTotal < $coupon->min_order_value) {
            throw ValidationException::withMessages([
                'coupon' => 'Giá trị đơn hàng chưa đủ điều kiện để áp dụng mã.',
            ]);
        }

        // 7. Tính giảm giá
        $discount = 0;
        if ($coupon->discount_type === 'percent') {
            $discount = $cartTotal * ($coupon->discount_value / 100);
        } elseif ($coupon->discount_type === 'fixed') {
            $discount = $coupon->discount_value;
        }

        // 8. Giới hạn giảm tối đa
        if ($coupon->max_discount && $discount > $coupon->max_discount) {
            $discount = $coupon->max_discount;
        }

        // 9. Cập nhật giỏ hàng
        $cart->update([
            'coupon_id' => $coupon->id,
            'discount' => $discount,
            'total_price' => $cartTotal - $discount,
        ]);

        // 10. Tăng số lần sử dụng mã
        $coupon->increment('used_count');

        return [
            'success' => true,
            'message' => "Áp dụng mã {$coupon->code} thành công, giảm " . number_format($discount) . "đ!",
            'discount' => $discount,
            'new_total' => $cart->total_price,
        ];
    }
}
