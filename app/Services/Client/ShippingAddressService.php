<?php

namespace App\Services\Client;

use App\Models\ShippingAddress;
use App\Repositories\ShippingAddressRepository;

class ShippingAddressService
{
    protected ShippingAddressRepository $addressRepo;

    public function __construct(ShippingAddressRepository $addressRepo)
    {
        $this->addressRepo = $addressRepo;
    }

    public function getAddresses($userId)
    {
        return ShippingAddress::where('user_id', $userId)
            ->orderByDesc('is_default')
            ->get();
    }

    public function getDefaultAddress($userId)
    {
        return ShippingAddress::where('user_id', $userId)
            ->where('is_default', 1)
            ->first();
    }

    public function store($userId, array $data)
    {
        $data['user_id'] = $userId;

        if (!empty($data['is_default']) && $data['is_default']) {
            ShippingAddress::where('user_id', $userId)
                ->update(['is_default' => 0]);
        }

        return ShippingAddress::create($data);
    }

    public function addAddress($userId, array $data)
    {
        $data['user_id'] = $userId;
        return $this->addressRepo->create($data);
    }
}
