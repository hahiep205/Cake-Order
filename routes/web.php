<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;


Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('register', [AuthController::class, 'register'])->name('auth.register');
// Define route get tới register, gọi func register trong AuthController để hiển thị form đăng ký.

Route::post('register', [AuthController::class, 'registered'])->name('auth.registered');
// xử lý đăng ký.

Route::get('login', [AuthController::class, 'login'])->name('auth.login');
// hiển thị form đăng nhập.

Route::post('login', [AuthController::class, 'logined'])->name('auth.logined');
// xử lý đăng nhập.

Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
// xử lý đăng xuất, chỉ cho vào khi đã login.

Route::get('admin', [AuthController::class, 'admin'])->name('admin')->middleware('auth');
// hiển thị trang cho admin.

/*
|=============== Admin Routes ===============
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');
    // hiển thị trang admin với danh sách products

    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    // thêm product mới

    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    // update product

    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    // delete product

    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    // thêm user mới

    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    // update user

    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    // delete user

    Route::post('menu/add/{id}', [AdminController::class, 'addProductToMenu'])->name('admin.menu.add');
    // add product vafo menu

    Route::post('menu/remove/{id}', [AdminController::class, 'removeProductFromMenu'])->name('admin.menu.remove');
    // remove product khoir menu

});

/*
|=============== Profile Routes ===============
*/

Route::get('profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');
// trả về view profile, yêu cầu login.

Route::get('profile_edit', function () {
    return view('modals.profile-management.profile_edit');
})->name('profile_edit')->middleware('auth');
// trả về view profile_edit, đặt tên route, phải login mới vào đc.

// Chỉ login rồi mới vào được.
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    // để hiển thị profile.

    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    // update profile.
});

/*
 *** Cart Routes
 */
Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    // thêm product vào cart.

    Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    // update số lượng của product trong cart.

    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    // xóa product có id được chọn trong cart.

    Route::patch('/cart/note/{id}', [CartController::class, 'updateNote'])->name('cart.note');
    // save note của product có id tương ứng.

});