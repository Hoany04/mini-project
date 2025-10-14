<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/home', function () {
//     return view('admin.home');
// })->middleware('auth');

// Route::get('/user', function() {
//     return 'Day la trang nguoi dung';
// })->middleware(['auth', 'auth.user']);

// Route::middleware('auth')->group(function () {
//     Route::get('/admin/home', function() {
//         return view('admin.home');
//     });

//     Route::middleware('auth.user')->group(function () {
//         Route::get('/client/home', function() {
//             return view('client.home');
//         });
//     });
// });

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

Route::middleware(['auth'])->prefix('admin')
->as('admin.')
->group(function () {
    Route::get('/home', fn() => view('admin.home'))
    ->name('home');

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
});

Route::middleware(['auth'])->prefix('client')->group(function () {
    Route::get('/home', fn() => view('client.home'))->name('client.home');
});