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
        $userId = $request->user()->id;

        try {
            $order = $this->orderService->createOrder($userId);

            return response()->json([
                'status' => 'success',
                'message' => 'Order created successfully',
                'data' => $order
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
