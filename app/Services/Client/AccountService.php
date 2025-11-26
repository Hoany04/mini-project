<?php

namespace App\Services\Client;

use App\Repositories\AccountRepository;

class AccountService
{
    protected AccountRepository $accountRepo;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepo = $accountRepo;
    }

    /**
     * Lấy dữ liệu cho trang tài khoản người dùng
     */
    public function getAccountData($userId)
    {
        $orders = $this->accountRepo->getOrdersByUser($userId);
        $user = $this->accountRepo->getUserWithProfile($userId);
        $profile = $this->accountRepo->getOrCreateProfile($user);

        return compact('user', 'orders', 'profile');
    }
}
