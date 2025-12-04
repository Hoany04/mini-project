<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\ApiTransactionService;
use Illuminate\Http\Request;

class PaymentTransactionController extends Controller
{
    protected ApiTransactionService $transactionService;

    public function __construct(ApiTransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $transactions = $this->transactionService->getAll();
        return response()->json([
            'status' => 'success',
            'data' => $transactions
        ]);
    }

    public function show($id)
    {
        $transaction = $this->transactionService->findById($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $transaction
        ]);
    }

    public function process(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $transaction = $this->transactionService->process($id, $validated['status']);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction processed successfully',
            'data' => $transaction
        ]);
    }
}
