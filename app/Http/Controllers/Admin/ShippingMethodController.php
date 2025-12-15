<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethodRequest;
use App\Services\ShippingMethodService;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    protected ShippingMethodService $service;

    public function __construct(ShippingMethodService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $methods = $this->service->getAll();
        return view('admin.shipping_methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.shipping_methods.create');
    }
    public function store(ShippingMethodRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.shipping_methods.index')->with('success', 'New shipping methods have been added.');
    }

    public function edit($id)
    {
        $method = $this->service->find($id);
        return view('admin.shipping_methods.edit', compact('method'));
    }

    public function update(ShippingMethodRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('admin.shipping_methods.index')->with('success', 'Update successful');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.shipping_methods.index')->with('success', 'Shipping method has been removed.');
    }

    // AJAX bật/tắt trạng thái
    public function toggleStatus($id)
    {
        $method = $this->service->toggleStatus($id);
        return response()->json(['status' => $method->status]);
    }
}
