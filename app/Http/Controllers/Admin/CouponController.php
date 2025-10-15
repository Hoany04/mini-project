<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index(Request $request) 
    {
        $filters = $request->only(['search', 'status']);
        $coupons = $this->couponService->getAllCoupons($filters);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(StoreCouponRequest $request)
    {
        $this->couponService->createCoupon($request->validated());
        return redirect()->route('admin.coupons.index')->with('success', 'Da tao coupon');
    }

    public function edit($id)
    {
        $coupon = $this->couponService->getCouponById($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, $id)
    {
        $this->couponService->updateCoupon($id, $request->validated());
        return redirect()->route('admin.coupons.index')->with('success', 'Da cap nhat coupon');
    }

    public function destroy($id)
    {
        $this->couponService->deleteCoupon($id);
        return redirect()->route('admin.coupons.index')->with('success', 'Da xoa coupon');
    }
}
