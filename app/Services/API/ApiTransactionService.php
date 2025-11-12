<?php

namespace App\Services\API;

use App\Repositories\API\ApiPaymentTransactionRepository;

class ApiTransactionService
{
    protected $transactionRepo;

    public function __construct(ApiPaymentTransactionRepository $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    public function getUserTransactions($userId)
    {
        return $this->transactionRepo->getByUserId($userId);
    }

    public function getTransactionDetail($id, $userId)
    {
        return $this->transactionRepo->getByIdAndUser($id, $userId);
    }
}
