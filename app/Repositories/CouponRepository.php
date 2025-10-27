<?php

namespace App\Repositories;

use App\Models\Coupon;

class CouponRepository
{
    /**
     * Create a new class instance.
     */
    public function getAll($filters = [])
    {
        $query = Coupon::query();

        if (!empty($filters['search'])) {
            $query->where('code', 'like', '%' .$filters['search'].'%')
            ->orwhere('description', 'like', '%' .$filters['search']. '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->orderByDesc('id')->paginate(10);
    }

    public function findById($id, $throw = true)
    {
        $query = Coupon::query();
        return $throw ? $query->findOrFail($id) : $query->find($id);
    }

    public function create(array $data)
    {
        return Coupon::create($data);
    }

    public function update(Coupon $coupon, array $data)
    {
        $coupon->fill($data);
        $coupon->save();
        return $coupon;
    }

    public function delete(Coupon $coupon)
    {
        return $coupon->delete();
    }
}
