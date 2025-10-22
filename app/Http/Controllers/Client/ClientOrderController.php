<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientOrderService;
use App\Services\OrderService;
use App\Repositories\OrderRepository;
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
    $orders = \App\Models\Order::where('user_id', auth()->id())
        ->with(['items.product.images', 'paymentTransactions.paymentMethod', 'coupon'])
        ->orderByDesc('created_at')
        ->get();

    return view('client.pages.checkout.index', compact('orders'));
}

public function show($id)
{
    $order = \App\Models\Order::with([
        'items.product.images',
        'items.variant',
        'paymentTransactions.paymentMethod',
        'coupon'
    ])->where('user_id', auth()->id())->findOrFail($id);

    return view('client.pages.checkout.show', compact('order'));
}



    public function create()
    {
        $user = auth()->user()->load('profile');
        $cart = app(\App\Services\Client\ClientCartService::class)
                ->getCart(auth()->id());
        return view('client.pages.checkout.order', compact('cart', 'user'));
    }

    public function success($id)
    {
        $order = $this->orderService->findWithRelations($id);
        return view('client.pages.checkout.success', compact('order'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'paymentmethod' => 'required|string',
        ]);

        $paymentMethod = \App\Models\PaymentMethod::where('name', $data['paymentmethod'])->first();

        $order = $this->orderService->create(auth()->id(), [
            'payment_method_id' => $paymentMethod->id ?? 1,
        ]);

        return redirect()->route('client.pages.checkout.success', $order->id)
                        ->with('success', 'Đơn hàng đã được đặt thành công');
    }
    
}
