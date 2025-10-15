<?php

namespace App\Services;

use App\Repositories\CouponRepository;
use Carbon\Carbon;

class CouponService
{
    /**
     * Create a new class instance.
     */

     protected $couponRepo;
    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepo = $couponRepo;
    }

    public function getAllCoupons($filters = [])
    {
        return $this->couponRepo->getAll($filters);
    }

    public function getCouponById($id)
    {
        return $this->couponRepo->findById($id);
    }

    public function createCoupon(array $data)
    {
        return $this->couponRepo->create($data);
    }

    public function updateCoupon($id, array $data)
    {
        $coupon = $this->couponRepo->findById($id);
        return $this->couponRepo->update($coupon, $data);
    }

    public function deleteCoupon($id)
    {
        $coupon = $this->couponRepo->findById($id);
        return $this->couponRepo->delete($coupon);
    }
}
