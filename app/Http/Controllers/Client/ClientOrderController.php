<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Services\Client\ClientOrderService;
use App\Services\OrderService;
use App\Services\Client\ClientShippingService;
use App\Services\Client\ShippingAddressService;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class ClientOrderController extends Controller
{
    protected $orderService;
    protected $shippingService;
    protected $addressService;

    public function __construct(
        ClientOrderService $orderService,
        ClientShippingService $shippingService,
        ShippingAddressService $addressService,
        )
    {
        $this->orderService = $orderService;
        $this->shippingService = $shippingService;
        $this->addressService = $addressService;
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
        $userId = auth()->id();

        $addresses = $this->addressService->getAddresses($userId);
        $defaultAddress = $this->addressService->getDefaultAddress($userId);

        $methods = $this->shippingService->getAvailableMethods();
        $user = auth()->user()->load('profile');
        $cart = app(\App\Services\Client\ClientCartService::class)
                ->getCart(auth()->id());
        return view('client.pages.checkout.order', compact('cart', 'user', 'methods', 'addresses', 'defaultAddress'));
    }

    public function success($id)
    {
        $order = $this->orderService->findWithRelations($id);

        if(!$order) {
            return redirect()->route('client.pages.checkout.index')->with('error', 'Don hang khong ton tai');
        }
        return view('client.pages.checkout.success', compact('order'));
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $paymentMethod = \App\Models\PaymentMethod::where('name', $data['paymentmethod'])->first();

        $coupon = session('coupon');

        $cartService = app(\App\Services\Client\ClientCartService::class);
        $cart = $cartService->getCart(auth()->id());
        $cartTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        //
        $shippingMethod = \App\Models\ShippingMethod::find($data['shipping_method_id']);
        $shippingFee = $shippingMethod->fee ?? 0;

        //
        $discountPercent = $coupon['discount_value'] ?? 0;
        $discountAmount = $cartTotal * ($discountPercent / 100);
        $finalTotal = $cartTotal - $discountAmount + $shippingFee;

        $couponId = session('coupon.id') ?? null;

        $order = $this->orderService->create(auth()->id(), [
            'payment_method_id' => $paymentMethod->id ?? 1,
            'shipping_address_id' => $data['shipping_address_id'],
            'shipping_method_id' => $data['shipping_method_id'],
            'delivery_note' => $data['delivery_note'] ?? null,
            'coupon_id' => $couponId,
        ]);

        if ($data['paymentmethod'] === 'stripe') {
            return redirect()->route('client.pages.payment.create', $order->id);
        }

        if ($order instanceof \Illuminate\Http\RedirectResponse) {
            return $order;
        }

        session()->forget('coupon');

        return redirect()->route('client.pages.checkout.success', $order->id)
                        ->with('success', 'Đơn hàng đã được đặt thành công');
    }

}
