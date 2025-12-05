<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\ApiOrderService;
use App\Http\Requests\ApiOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected ApiOrderService $orderService;

    public function __construct(ApiOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(ApiOrderRequest $request)
    {
        $data = $request->validated();

        return $this->orderService->createOrder($data);
    }
}
