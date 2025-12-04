<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\AccountService;

class AccountController extends Controller
{
    protected AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
    public function index()
    {
        $userId = auth()->id();
        $data = $this->accountService->getAccountData($userId);

        return view('client.pages.account.index', $data);
    }
}
?>
