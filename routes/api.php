<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentTransactionController;

Route::middleware('throttle:api')->group(function () {


        Route::post('/login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
        //
        Route::get('/home', [HomeController::class, 'index']);
        //
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/categories/{id}', [CategoryController::class, 'show']);
        //
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/{id}', [ProductController::class, 'show']);
        Route::middleware('auth:sanctum')->group(function () {
        //
        Route::get('/transactions', [TransactionController::class, 'index']);
        Route::get('/transactions/{id}', [TransactionController::class, 'show']);
        //
        Route::get('/payment', [PaymentTransactionController::class, 'index']);
        Route::get('/payment/{id}', [PaymentTransactionController::class, 'show']);
        Route::put('/payment/{id}/process', [PaymentTransactionController::class, 'process']);
        //
        Route::post('/order', [OrderController::class, 'store']);
    });
});

?>
