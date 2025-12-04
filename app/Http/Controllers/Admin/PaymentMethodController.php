<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentMethodService;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;

class PaymentMethodController extends Controller
{
    protected PaymentMethodService $service;

    public function __construct(PaymentMethodService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $methods = $this->service->list();
        return view('admin.payment_methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment_methods.create');
    }

    public function store(StorePaymentMethodRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Thêm phương thức thanh toán thành công!');
    }

    public function edit($id)
    {
        $method = $this->service->find($id);
        return view('admin.payment_methods.edit', compact('method'));
    }

    public function update(UpdatePaymentMethodRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success', 'Xoá thành công!');
    }
}
