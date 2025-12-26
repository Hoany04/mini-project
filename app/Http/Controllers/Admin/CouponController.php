<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected CouponService $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Coupon::class);
        $filters = $request->only(['search', 'status']);
        $coupons = $this->couponService->getAllCoupons($filters);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $this->authorize('create', Coupon::class);
        return view('admin.coupons.create');
    }

    public function store(StoreCouponRequest $request)
    {
        $this->couponService->createCoupon($request->validated());
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $this->authorize('update', $coupon);
        $coupon = $this->couponService->getCouponById($id);

        if (!$coupon) {
            return redirect()->route('admin.coupons.index')->with('error', 'The discount code does not exist.');
        }
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $this->authorize('update', $coupon);
        $this->couponService->updateCoupon($id, $request->validated());

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon has been updated.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $this->authorize('delete', $coupon);
        $this->couponService->deleteCoupon($id);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon has been deleted.');
    }
}
