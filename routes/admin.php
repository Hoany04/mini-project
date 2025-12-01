<?php
use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\Admin\PaymentTransactionController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\DashboardController;
use App\Events\NewOrderCreated;
use App\Models\Order;
use App\Models\User;

Route::get('/test-notify', function () {
    $user = User::first();

    $order = Order::first();

    $user->notify(new App\Notifications\OrderStatusUpdatedNotification($order));

    return "Sent!";
});

Route::get('/test-realtime', function () {
    $order = Order::first();
    event(new NewOrderCreated($order));

    return "Event sent";
});


Route::prefix('admin')->group(function () {
    Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    Route::resource('user_profiles', UserProfileController::class);
    // Route::resource('products', ProductController::class);
});

// ======================== ADMIN SITE ========================
Route::middleware(['auth', 'CheckActive'])->prefix('admin')
->as('admin.')
->group(function () {
    // Route::get('/home', fn() => view('admin.home'))
    // ->name('home');
    Route::get('home', [DashboardController::class, 'index'])->name('home');

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
        Route::get('trashed', [ProductController::class, 'trashed'])->name('trashed');
        Route::post('{id}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::delete('{id}/force', [ProductController::class, 'forceDelete'])->name('forceDelete');
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

    Route::prefix('payment-transactions')
    ->as('payment-transactions.')
    ->group(function () {
        Route::get('/', [PaymentTransactionController::class, 'index'])->name('index');
        Route::get('/{id}', [PaymentTransactionController::class, 'show'])->name('show');
    });

    Route::prefix('payment-methods')
    ->as('payment-methods.')
    ->group(function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
        Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
        Route::post('/store', [PaymentMethodController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PaymentMethodController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PaymentMethodController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PaymentMethodController::class, 'destroy'])->name('delete');
    });
});
?>
