<?php
require __DIR__ . '/admin.php';
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Enums\RoleStatus;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\ClientCategoryController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\ClientProductReviewController;
use App\Http\Controllers\Client\ClientCartController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Client\ClientCouponController;
use App\Http\Controllers\Client\ClientShippingAddressController;
use App\Http\Controllers\Client\ClientShippingController;
use App\Http\Controllers\Client\StripePaymentController;
use App\Http\Controllers\Client\AccountController;

Route::get('/', [HomeController::class, 'index'])->name('client.home');

Route::get('/category/{slug}', [ClientCategoryController::class, 'show'])->name('client.pages.category.show');
//
Route::get('/products', [ClientProductController::class, 'index'])->name('client.pages.products.index');
Route::get('/products/{id}', [ClientProductController::class, 'show'])->name('client.pages.products.detail');
//

Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [AuthController::class, 'showFormForgot'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showFormReset'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ======================== CLIENT SITE ========================
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


Route::middleware(['auth', 'CheckActive'])
    ->prefix('client')
    ->as('client.')
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        //
        Route::get('/account', [AccountController::class, 'index'])->name('pages.account.index');
        //
        Route::post('/account/profile/update', [ClientProfileController::class, 'update'])
        ->name('pages.profile.update');
        //
        // Route::get('/category/{slug}', [ClientCategoryController::class, 'show'])->name('pages.category.show');
        //
        // Route::get('/products', [ClientProductController::class, 'index'])->name('pages.products.index');
        // Route::get('/products/{id}', [ClientProductController::class, 'show'])->name('pages.products.detail');
        //
        Route::post('/products/{id}/reviews', [ClientProductReviewController::class, 'store'])->name('pages.products.reviews.store')->middleware('auth');
        //
        Route::get('/cart', [ClientCartController::class, 'index'])->name('pages.cart.index');
        Route::post('/cart', [ClientCartController::class, 'store'])->name('pages.cart.store');
        Route::put('/cart/{itemId}', [ClientCartController::class, 'update'])->name('pages.cart.update');
        Route::delete('/cart/{itemId}', [ClientCartController::class, 'destroy'])->name('pages.cart.destroy');
        Route::post('/cart/update-ajax', [ClientCartController::class, 'updateAjax'])->name('pages.cart.updateAjax');
        //
        Route::get('/', [ClientOrderController::class, 'index'])->name('pages.checkout.index');
        Route::get('/create', [ClientOrderController::class, 'create'])->name('pages.checkout.order');
        Route::get('/{id}', [ClientOrderController::class, 'show'])->name('pages.checkout.show');
        Route::post('/store', [ClientOrderController::class, 'store'])->name('pages.checkout.store');
        Route::get('/success/{id}', [ClientOrderController::class, 'success'])->name('pages.checkout.success');
        //
        Route::post('/apply-coupon', [ClientCouponController::class, 'apply'])->name('pages.coupon.apply');
        Route::delete('/remove-coupon', [ClientCouponController::class, 'remove'])->name('pages.coupon.remove');
        //
        Route::get('/checkout', [ClientShippingAddressController::class, 'index'])->name('pages.checkout.index');
        Route::post('/checkout/address', [ClientShippingAddressController::class, 'store'])->name('pages.checkout.store');
        //
        Route::post('/addresses/store', [ClientShippingAddressController::class, 'store'])
        ->name('pages.addresses.store');
        //
        Route::get('/stripe/{order}', [StripePaymentController::class, 'create'])->name('pages.payment.create');
        Route::post('/stripe/{order}', [StripePaymentController::class, 'store'])->name('pages.payment.store');

        //
        Route::get('/checkout', [ClientShippingController::class, 'index'])->name('pages.checkout.order');
    });
