<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('register', [AuthController::class, 'register'])->name('auth.register');
// Define route get tới register, gọi func register trong AuthController để hiển thị form đăng ký.

Route::post('register', [AuthController::class, 'registered'])->name('auth.registered');

Route::get('login', [AuthController::class, 'login'])->name('auth.login'); 

Route::post('login', [AuthController::class, 'logined'])->name('auth.logined'); 

Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth'); 
// xử lý đăng xuất, chỉ cho vào khi đã login.

Route::get('admin', [AuthController::class, 'admin'])->name('admin')->middleware('auth');

/*
|==================================================== Admin =================================================
*/

Route::middleware(['auth'])->prefix('admin')->group(function() {
    
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');

    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');

    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::post('menu/add/{id}', [AdminController::class, 'addProductToMenu'])->name('admin.menu.add');

    Route::post('menu/remove/{id}', [AdminController::class, 'removeProductFromMenu'])->name('admin.menu.remove');

});

/*
|==================================================== Profile =================================================
*/

Route::get('profile', function () {
    return view('profile');})->name('profile')->middleware('auth'); 

Route::get('profile_edit', function () {
    return view('modals.profile-management.profile_edit');})->name('profile_edit')->middleware('auth'); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

/*
|==================================================== Cart =================================================
*/

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

    Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');

    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');

    Route::patch('/cart/note/{id}', [CartController::class, 'updateNote'])->name('cart.note');
    // save note

});

/*
|==================================================== Checkout =================================================
*/

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');
    Route::get('/profile/check-info', [AuthController::class, 'checkProfileInfo'])->name('profile.check-info');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
});