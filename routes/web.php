<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProfileController;
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
    Route::resource('users', UserController::class);
    Route::resource('user_profiles', UserProfileController::class);
});

Route::get('danh-sach-san-pham', [ProductController::class, 'index']);

//

Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [AuthController::class, 'showFormForgot']);
Route::post('forgot-password', [AuthController::class, 'forgot-password'])->name('forgot-password');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/home', fn() => view('admin.home'))->name('admin.home');
});
Route::middleware(['auth'])->prefix('client')->group(function () {
    Route::get('/home', fn() => view('client.home'))->name('client.home');
});