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
        // Lấy mã giảm giá
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá không tồn tại.',
            ]);
        }

        // Kiểm tra trạng thái mã
        if ($coupon->status !== 'active') {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá không còn hiệu lực.',
            ]);
        }

        // Kiểm tra thời gian hiệu lực
        $now = now();
        if ($coupon->start_date && $now->lt($coupon->start_date)) {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá chưa đến thời gian sử dụng.',
            ]);
        }
        //
        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá đã hết lượt sử dụng.',
            ]);
        }

        if ($coupon->end_date && $now->gt($coupon->end_date)) {
            throw ValidationException::withMessages([
                'coupon' => 'Mã giảm giá đã hết hạn.',
            ]);
        }

        // Lấy giỏ hàng người dùng
        $cart = Cart::with('items')->where('user_id', $userId)->first();

        if (!$cart || $cart->items->isEmpty()) {
            throw ValidationException::withMessages([
                'coupon' => 'Giỏ hàng trống, không thể áp dụng mã.',
            ]);
        }

        // Tính tổng tiền giỏ hàng
        $cartTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        // Kiểm tra giá trị tối thiểu
        if ($cartTotal < $coupon->min_order_value) {
            throw ValidationException::withMessages([
                'coupon' => 'Giá trị đơn hàng chưa đủ điều kiện để áp dụng mã.',
            ]);
        }

        // Tính giảm giá
        $discount = 0;
        if ($coupon->discount_type === 'percent') {
            $discount = $cartTotal * ($coupon->discount_value / 100);
        } elseif ($coupon->discount_type === 'fixed') {
            $discount = $coupon->discount_value;
        }

        // Giới hạn giảm tối đa
        if ($coupon->max_discount && $discount > $coupon->max_discount) {
            $discount = $coupon->max_discount;
        }

        // Cập nhật giỏ hàng
        $cart->update([
            'coupon_id' => $coupon->id,
            'discount' => $discount,
            'total_price' => $cartTotal - $discount,
        ]);

        $cart->refresh();
        //  Tăng số lần sử dụng mã
        $coupon->increment('used_count');

        return [
            'success' => true,
            'message' => "Áp dụng mã {$coupon->code} thành công, giảm " . number_format($discount) . "đ!",
            'discount' => $discount,
            'new_total' => $cartTotal - $discount,
            'coupon' => $coupon,
        ];
    }
}
