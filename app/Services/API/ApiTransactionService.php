<?php

namespace App\Services\API;


use App\Repositories\API\ApiPaymentTransactionRepository;
use App\Repositories\API\ApiOrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ApiTransactionService
{
    protected $transactionRepo;
    protected $orderRepo;

    public function __construct(ApiPaymentTransactionRepository $transactionRepo, ApiOrderRepository $orderRepo)
    {
        $this->transactionRepo = $transactionRepo;
        $this->orderRepo = $orderRepo;
    }

    public function getUserTransactions($userId)
    {
        return $this->transactionRepo->getByUserId($userId);
    }

    public function getTransactionDetail($id, $userId)
    {
        return $this->transactionRepo->getByIdAndUser($id, $userId);
    }

    public function getAll()
    {
        return $this->transactionRepo->getAll();
    }

    public function findById($id)
    {
        return $this->transactionRepo->findById($id);
    }

    public function process($id, $status)
    {
        return DB::transaction(function () use ($id, $status) {
            $transaction = $this->transactionRepo->findById($id);

            if (!$transaction) {
                throw ValidationException::withMessages(['transaction' => 'Transaction not found']);
            }

            // Cập nhật trạng thái giao dịch
            $this->transactionRepo->updateStatus($transaction, $status);

            // Đồng bộ trạng thái đơn hàng
            $order = $transaction->order;
            if ($order) {
                switch ($status) {
                    case 'paid':
                        $order->status = 'paid';
                        break;
                    case 'failed':
                        $order->status = 'cancelled';
                        break;
                    case 'refunded':
                        $order->status = 'completed';
                        break;
                    default:
                        $order->status = 'pending';
                }
                $order->save();
            }

            return $transaction;
        });
    }
}
