<?php

namespace App\Repositories;

use App\Models\ShippingAddress;

class ShippingAddressRepository
{
    public function getByUser($userId)
    {
        return ShippingAddress::where('user_id', $userId)->get();
    }

    public function getDefaultByUser($userId)
    {
        return ShippingAddress::where('user_id', $userId)
            ->where('is_default', 1)
            ->first();
    }

    public function find($id)
    {
        return ShippingAddress::find($id);
    }

    public function create(array $data)
    {
        if (!empty($data['is_default'])) {
            // Hủy mặc định địa chỉ cũ nếu có
            ShippingAddress::where('user_id', $data['user_id'])->update(['is_default' => 0]);
        }

        return ShippingAddress::create($data);
    }
}
