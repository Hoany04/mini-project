<?php

namespace App\Repositories\API;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ApiOrderRepository
{
    public function insertOrderItems(array $items)
    {
        return DB::table('order_items')->insert($items);
    }

    public function createOrder($data)
    {
        return Order::create($data);
    }
}
