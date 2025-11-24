<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\API\ApiOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(ApiOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
         $data = $request->validate([
            'user_id' => 'required|integer',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        return $this->orderService->createOrder($data);
    }
}
