<?php

namespace App\Services;

use App\Repositories\AccessLogRepository;

class AccessLogService
{
    /**
     * Create a new class instance.
     */

     protected AccessLogRepository $accessLogRepo;
    public function __construct(AccessLogRepository $accessLogRepo)
    {
        $this->accessLogRepo = $accessLogRepo;
    }

    public function getListFitter($data)
    {
        return $this->accessLogRepo->getListFitter($data);
    }
}
