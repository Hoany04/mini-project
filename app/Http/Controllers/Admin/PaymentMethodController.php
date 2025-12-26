<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentMethodService;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    protected PaymentMethodService $service;

    public function __construct(PaymentMethodService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('viewAny', PaymentMethod::class);
        $methods = $this->service->list();
        return view('admin.payment_methods.index', compact('methods'));
    }

    public function create()
    {
        $this->authorize('create', PaymentMethod::class);
        return view('admin.payment_methods.create');
    }

    public function store(StorePaymentMethodRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method added successfully.!');
    }

    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $this->authorize('update', $method);
        $method = $this->service->find($id);
        return view('admin.payment_methods.edit', compact('method'));
    }

    public function update(UpdatePaymentMethodRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Update successful!');
    }

    public function destroy($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $this->authorize('delete', $method);
        $this->service->delete($id);
        return back()->with('success', 'Deleted successfully!');
    }
}
