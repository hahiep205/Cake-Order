<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

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
|------------------------------- Admin Routes ---------------------------------------
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
    
});
