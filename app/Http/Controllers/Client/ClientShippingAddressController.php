<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ShippingAddressService;
use Illuminate\Http\Request;

class ClientShippingAddressController extends Controller
{
    protected $addressService;

    public function __construct(ShippingAddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function index()
    {
        $addresses = $this->addressService->getAddresses(auth()->id());
        $defaultAddress = $this->addressService->getDefaultAddress(auth()->id());
        return view('client.pages.checkout.index', compact('addresses', 'defaultAddress'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:150',
            'phone' => 'required|string|max:15',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
            'address_detail' => 'required|string|max:255',
            'is_default' => 'nullable|boolean',
        ]);

        $this->addressService->addAddress(auth()->id(), $data);

        return back()->with('success', 'Đã thêm địa chỉ giao hàng mới');
    }
}
