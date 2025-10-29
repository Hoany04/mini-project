<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\AccessLogController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    Route::resource('user_profiles', UserProfileController::class);
    // Route::resource('products', ProductController::class);
});


Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [AuthController::class, 'showFormForgot'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showFormReset'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ======================== ADMIN SITE ========================
Route::middleware(['auth'])->prefix('admin')
->as('admin.')
->group(function () {
    Route::get('/home', fn() => view('admin.home'))
    ->name('home');

    Route::get('access-logs', [AccessLogController::class, 'index'])->name('access-logs.index');

    Route::prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{id}', [UserController::class, 'update'])->name('update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categorys')
    ->as('categorys.')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')
    ->as('products.')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products/{product}/images')
    ->as('products.images.')
    ->group(function () {
        Route::post('/', [ProductImageController::class, 'store'])->name('store');
        Route::delete('{id}', [ProductImageController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products/{productId}/variants')
    ->as('product_variants.')
    ->group(function () {
        Route::get('/', [ProductVariantController::class, 'index'])->name('index');
        Route::get('/create', [ProductVariantController::class, 'create'])->name('create');
        Route::post('/', [ProductVariantController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductVariantController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductVariantController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductVariantController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('product_reviews')
    ->as('product_reviews.')
    ->group(function () {
        Route::get('/', [ProductReviewController::class, 'index'])->name('index');
        Route::post('{id}/toggle', [ProductReviewController::class, 'toggleVisibility'])->name('toggle');
        Route::delete('{id}', [ProductReviewController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('carts')
    ->as('carts.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('{id}/show', [CartController::class, 'show'])->name('show');
        Route::delete('{id}', [CartController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')
    ->as('orders.')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('{id}/show', [OrderController::class, 'show'])->name('show');
        Route::put('{id}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('{id}', [OrderController::class, 'destroy'])->name('destroy');

        Route::put('orders/{order}/shipping', [OrderController::class, 'updateShipping'])->name('updateShipping');
    });

    Route::prefix('coupons')
    ->as('coupons.')
    ->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('/create', [CouponController::class, 'create'])->name('create');
        Route::post('/', [CouponController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CouponController::class, 'edit'])->name('edit');
        Route::put('{id}', [CouponController::class, 'update'])->name('update');
        Route::delete('{id}', [CouponController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('shipping_methods')
    ->as('shipping_methods.')
    ->group(function () {
        Route::get('/', [ShippingMethodController::class, 'index'])->name('index');
        Route::get('/create', [ShippingMethodController::class, 'create'])->name('create');
        Route::post('/', [ShippingMethodController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ShippingMethodController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ShippingMethodController::class, 'update'])->name('update');
        Route::delete('/{id}', [ShippingMethodController::class, 'destroy'])->name('destroy');

        Route::post('/{id}/toggle', [ShippingMethodController::class, 'toggleStatus'])->name('toggle');
    });
});


// ======================== CLIENT SITE ========================
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


Route::middleware(['auth'])
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
        Route::get('/category/{slug}', [ClientCategoryController::class, 'show'])->name('pages.category.show');
        //
        Route::get('/products', [ClientProductController::class, 'index'])->name('pages.products.index');
        Route::get('/products/{id}', [ClientProductController::class, 'show'])->name('pages.products.detail');
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
        // routes/client.php
        Route::post('/addresses/store', [ClientShippingAddressController::class, 'store'])
        ->name('pages.addresses.store');
        //
        Route::get('/stripe/{order}', [StripePaymentController::class, 'create'])->name('pages.payment.create');
        Route::post('/stripe/{order}', [StripePaymentController::class, 'store'])->name('pages.payment.store');

        //
        Route::get('/checkout', [ClientShippingController::class, 'index'])->name('pages.checkout.order');
    });
    