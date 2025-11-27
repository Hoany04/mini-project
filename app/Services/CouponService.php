<?php

namespace App\Services;

use App\Enums\CouponStatus;
use App\Repositories\CouponRepository;
use Carbon\Carbon;

class CouponService
{
    /**
     * Create a new class instance.
     */

     protected CouponRepository $couponRepo;
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
        return $this->couponRepo->findById($id, false);
    }

    public function createCoupon(array $data)
    {
        if (!empty($data['status'])) {
            try {
                $data['status'] = CouponStatus::from($data['status'])->value;
            } catch (\ValueError $e) {
                throw new \Exception("Trạng thái coupon không hợp lệ");
            }
        }
        return $this->couponRepo->create($data);
    }

    public function updateCoupon($id, array $data)
    {
        if (!empty($data["status"])) {
            try {
                $data['status'] = CouponStatus::from($data['status'])->value;
            } catch (\ValueError $e) {
                throw new \Exception("Trạng thái coupon không hợp lệ");
            }
        }
        $coupon = $this->couponRepo->findById($id);
        return $this->couponRepo->update($coupon, $data);
    }

    public function deleteCoupon($id)
    {
        $coupon = $this->couponRepo->findById($id);
        return $this->couponRepo->delete($coupon);
    }
}
