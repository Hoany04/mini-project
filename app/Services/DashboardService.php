<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected $dashboardRepo;

    public function __construct(DashboardRepository $dashboardRepo)
    {
        $this->dashboardRepo = $dashboardRepo;
    }

    public function getDashboardStats()
    {
        return [
            'pending_orders'   => $this->dashboardRepo->getPendingOrdersCount(),
            'total_revenue'    => $this->dashboardRepo->getTotalRevenue(),
            'total_users'      => $this->dashboardRepo->getFrontendUserCount(),
            'total_products'   => $this->dashboardRepo->getActiveProductCount(),
            'total_categories' => $this->dashboardRepo->getCategoryCount(),
        ];
    }
}
