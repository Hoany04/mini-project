<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientCouponService;
use Illuminate\Http\Request;

class ClientCouponController extends Controller
{
    protected $couponService;

    public function __construct(ClientCouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function apply(Request $request)
    {
        $request->validate([
            'coupon' => 'required|string',
        ], [
            'coupon.required' => 'Vui lòng nhập mã giảm giá trước khi áp dụng!',
        ]);

        try {
            $userId = auth()->id();
            $couponCode = $request->input('coupon');

            $result = $this->couponService->applyCoupon($userId, $couponCode);

            // Lưu thông tin coupon vào session để hiển thị trên giao diện
            session([
                'coupon' => [
                    'id' => $result['coupon']->id ?? null,
                    'code' => $couponCode,
                    'discount' => $result['discount'],
                    'new_total' => $result['new_total'],
                ]
            ]);

            return redirect()->back()->with('success', $result['message']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['coupon' => 'Có lỗi xảy ra khi áp dụng mã.']);
        }
    }


    public function remove(Request $request)
    {
        $userId = auth()->id();

        // Xóa coupon khỏi session
        session()->forget('coupon');

        // Cập nhật lại giỏ hàng trong DB
        $cart = \App\Models\Cart::where('user_id', $userId)->first();

        if ($cart) {
            $cartTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);

            $cart->update([
                'coupon_id' => null,
                'discount' => 0,
                'total_price' => $cartTotal,
            ]);
        }

        return redirect()->route('client.pages.cart.index')
            ->with('success', 'Đã hủy mã giảm giá');
    }
}
