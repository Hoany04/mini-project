<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Requests\UpdateOrderShippingRequest;
use App\Events\OrderStatusUpdated;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;


    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['status', 'search']);
        $orders = $this->orderService->getAllOrders($filters);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product', 'shipping.shippingMethod', 'shipping.shippingAddress'])->findOrFail($id);
        $shippingMethods = \App\Models\ShippingMethod::where('status', 'active')->get();
        $addresses = \App\Models\ShippingAddress::where('user_id', $order->user_id)->get();
        return view('admin.orders.show', compact('order', 'shippingMethods', 'addresses'));
    }

    public function updateStatus(UpdateOrderStatusRequest  $request, $id)
    {
        $this->orderService->updateStatus($id, $request->status);

        return redirect()->route('admin.orders.index')->with('success', 'Cap nhat trang thai thanh cong');
    }

    public function updateShipping(UpdateOrderShippingRequest $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $shipping = $order->shipping ?: new OrderShipping(['order_id' => $order->id]);
        $shipping->fill($request->only([
            'shipping_method_id',
            'shipping_address_id',
            'shipping_fee',
            'tracking_number',
            'delivery_note',
            'status'
        ]));

        // Thời gian cập nhật
        if ($request->status === 'shipping' && !$shipping->shipped_at) {
            $shipping->shipped_at = now();
        }
        if ($request->status === 'delivered' && !$shipping->delivered_at) {
            $shipping->delivered_at = now();
        }

        $shipping->save();

        event(new OrderStatusUpdated($order));
        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật thông tin giao hàng thành công!');
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);
        return redirect()->route('admin.orders.index')->with('success', 'Da xoa don hang');
    }
}
