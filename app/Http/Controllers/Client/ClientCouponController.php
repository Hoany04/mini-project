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

            return redirect()->back()->with('success', $result['message']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['coupon' => 'Có lỗi xảy ra khi áp dụng mã.']);
        }
    }

    public function remove(Request $request)
    {
        session()->forget('coupon');
        return back()->with('success', 'Đã hủy mã giảm giá');
    }
}
