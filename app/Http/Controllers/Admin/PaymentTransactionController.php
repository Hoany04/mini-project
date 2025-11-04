<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentTransactionService;
use Illuminate\Http\Request;

class PaymentTransactionController extends Controller
{
    protected $service;

    public function __construct(PaymentTransactionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $transactions = $this->service->list($request->only('status', 'payment_method_id', 'order_id'));
        return view('admin.payment_transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = $this->service->find($id);
        return view('admin.payment_transactions.show', compact('transaction'));
    }
}
