<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class DashboardRepository
{
    public function getPendingOrdersCount()
    {
        return Order::where('status', 'pending')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
    }

    public function getTotalRevenue()
    {
        return Order::where('status', 'paid')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_amount'); // cột tổng tiền trong bảng orders
    }

    public function getFrontendUserCount()
    {
        return User::where('role_id', 3)->count();
    }

    public function getActiveProductCount()
    {
        return Product::where('status', 'active')->count();
    }

    public function getCategoryCount()
    {
        return Category::count();
    }
}
