<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * ---
 * Các route public (không cần đăng nhập)
 * ---
 */
Route::middleware([])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/signup', [AuthController::class, 'signup']);
        Route::post('/signin', [AuthController::class, 'signin']);
    });

    /* Thêm các route khác ở đây */
});

/**
 * ---
 * Các route protected (cần đăng nhập)
 * ---
 */

/**
 * Tất cả các role đều có thể truy cập
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::patch('/me', [AuthController::class, 'updateProfile']);
    /* Thêm các route khác ở đây */
});

/**
 * Role admin có thể truy cập
 */
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/welcome', function (Request $request) {
        return response()->json([
            'message' => 'Admin route',
        ]);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'getAllUsers']);
        Route::post('/', [UserController::class, 'createUser']);
        Route::get('/{id}', [UserController::class, 'getUserById'])->where('id', '[0-9]+');
        Route::patch('/{id}', [UserController::class, 'updateUser'])->where('id', '[0-9]+');
        Route::delete('/{id}', [UserController::class, 'deleteUser'])->where('id', '[0-9]+');
    });
    /* Thêm các route khác ở đây */
});

/**
 * Role owner có thể truy cập
 */
Route::middleware(['auth:sanctum', 'role:owner'])->group(function () {
    Route::get('/owner/welcome', function (Request $request) {
        return response()->json([
            'message' => 'Owner route',
        ]);
    });

    /* Thêm các route khác ở đây */
});

/**
 * Role customer có thể truy cập
 */
Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::get('/customer/welcome', function (Request $request) {
        return response()->json([
            'message' => 'Customer route',
        ]);
    });

    /* Thêm các route khác ở đây */
});

Route::apiResource('products', ProductController::class);
Route::get('/products', [ProductController::class, 'index']); 
Route::post('/products', [ProductController::class, 'store']); 
Route::get('/products/{id}', [ProductController::class, 'show']); 
Route::put('/products/{id}', [ProductController::class, 'update']); 
Route::delete('/products/{id}', [ProductController::class, 'destroy']); 
Route::get('/products/price/{direction}', [ProductController::class, 'getProductsByPrice']);
Route::get('/products/search/{name}', [ProductController::class, 'searchProductsByName']);
Route::get('/products/created_at/{direction}', [ProductController::class, 'getProductsByCreatedAt']);


Route::apiResource('categories', CategoryController::class);
Route::get('/categories', [CategoryController::class, 'index']); 
Route::post('/categories', [CategoryController::class, 'store']); 
Route::get('/categories/{id}', [CategoryController::class, 'show']); 
Route::put('/categories/{id}', [CategoryController::class, 'update']); 
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::apiResource('discounts', DiscountController::class);
Route::get('/discounts', [DiscountController::class, 'index']); 
Route::post('/discounts', [DiscountController::class, 'store']); 
Route::get('/discounts/{id}', [DiscountController::class, 'show']); 
Route::put('/discounts/{id}', [DiscountController::class, 'update']); 
Route::delete('/discounts/{id}', [DiscountController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    // Lấy danh sách tất cả các shops
    Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');

    // Tạo mới một shop
    Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');

    // Lấy thông tin chi tiết của một shop
    Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');

    // Cập nhật một shop
    Route::put('/shops/{shop}', [ShopController::class, 'update'])->name('shops.update');

    // Xóa một shop
    Route::delete('/shops/{shop}', [ShopController::class, 'destroy'])->name('shops.destroy');
});

Route::prefix('addresses')->group(function () {
    Route::get('/', [AddressController::class, 'index']); // Lấy tất cả địa chỉ
    Route::get('{id}', [AddressController::class, 'show']); // Lấy địa chỉ theo ID
    Route::post('/', [AddressController::class, 'store']); // Thêm mới địa chỉ
    Route::put('{id}', [AddressController::class, 'update']); // Cập nhật địa chỉ
    Route::delete('{id}', [AddressController::class, 'destroy']); // Xóa địa chỉ
});


Route::middleware('auth:sanctum')->group(function () {
    // Lấy danh sách các review (admin xem tất cả, người dùng bình thường chỉ xem review đã duyệt)
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

    // Tạo một review mới
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Lấy thông tin chi tiết của một review (chỉ xem nếu review đã được duyệt hoặc người dùng là admin)
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');

    // Cập nhật review (chỉ người dùng tạo review hoặc admin mới có thể sửa)
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    // Xóa review (chỉ người dùng tạo review hoặc admin mới có thể xóa)
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Duyệt review (admin)
    Route::put('/reviews/{review}/is_approved', [ReviewController::class, 'approve'])->name('reviews.is_approved');
});


