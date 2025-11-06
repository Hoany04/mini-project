<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingAddressRequest;
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

    public function store(ShippingAddressRequest $request)
    {
        $this->addressService->addAddress(auth()->id(), $request->validated());

        return back()->with('success', 'Đã thêm địa chỉ giao hàng mới');
    }
}
