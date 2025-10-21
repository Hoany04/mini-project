<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientOrderService;
use Illuminate\Http\Request;

class ClientOrderController extends Controller
{
    protected $orderService;

    public function __construct(ClientOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $cart = app(\App\Services\Client\ClientCartService::class)
                ->getCart(auth()->id());
        return view('client.pages.checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        try {
            $order = $this->orderService->placeOrder(auth()->user(), $request->coupon_code);
            return redirect()->route('client.orders.success')
                ->with('success', 'Đặt hàng thành công! Mã đơn #' . $order->id);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
