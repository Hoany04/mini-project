<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
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
        $order = $this->orderService->getOrderById($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $this->orderService->updateStatus($id, $request->status);

        return redirect()->route('admin.orders.index')->with('success', 'Cap nhat trang thai thanh cong');
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);
        return redirect()->route('admin.orders.index')->with('success', 'Da xoa don hang');
    }
}
