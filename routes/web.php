<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('cart', [AuthController::class, 'cart'])->name('cart'); 
// Define route get tới cart, gọi func cart trong AuthController để hiển thị giỏ hàng.

Route::get('register', [AuthController::class, 'register'])->name('auth.register');
// Define route get tới register, gọi func register trong AuthController để hiển thị form đăng ký.

Route::post('register', [AuthController::class, 'registered'])->name('auth.registered');
// Define route post tới register, gọi func registered trong AuthController để xử lý đăng ký.

Route::get('login', [AuthController::class, 'login'])->name('auth.login'); 
// Define route get tới login, gọi func login trong AuthController để hiển thị form đăng nhập.

Route::post('login', [AuthController::class, 'logined'])->name('auth.logined'); 
// Define route post tới login, gọi func logined trong AuthController để xử lý đăng nhập.

Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth'); 
// Define route get tới logout, gọi func logout trong AuthController để xử lý đăng xuất, chỉ cho vào khi đã login.

Route::get('admin', [AuthController::class, 'admin'])->name('admin')->middleware('auth');
// Define route get tới admin, gọi func admin trong AuthController để hiển thị form cho admin.

/*
|=============== Admin Routes ===============
*/
Route::middleware(['auth'])->prefix('admin')->group(function() {
    
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    // Route hiển thị trang admin với danh sách products
    
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    // Route thêm product mới
    
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    // Route update product
    
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    // Route delete product

    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    // Route thêm user mới

    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    // Route update user

    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    // Route delete user

});

/*
|=============== Profile Routes ===============
*/

Route::get('profile', function () {
    return view('profile');})->name('profile')->middleware('auth'); 
// Define route get tới profile, trả về view profile, yêu cầu login.

Route::get('profile_edit', function () {
    return view('modals.profile-management.profile_edit');})->name('profile_edit')->middleware('auth'); 
// Define route get tới profile_edit, trả về view profile_edit, đặt tên route, phải login mới vào đc.

// Chỉ login rồi mới vào được.
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    // Define route get tới profile, gọi func profile trong AuthController để hiển thị profile.

    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    // Define route put tới /profile/update, gọi func updateProfile trong AuthController để update profile.
});