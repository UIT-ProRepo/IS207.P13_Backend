<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ShippingProviderController;
use App\Http\Controllers\ShopController;
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

Route::resource('shipping_providers', ShippingProviderController::class);
Route::get('/shipping_providers', [ShippingProviderController::class, 'index']);
Route::post('/shipping_providers', [ShippingProviderController::class, 'store']);
Route::get('/shipping_providers/{id}', [ShippingProviderController::class, 'show']);
Route::put('/shipping_providers/{id}', [ShippingProviderController::class, 'update']);
Route::delete('/shipping_providers/{id}', [ShippingProviderController::class, 'destroy']);

Route::resource('orders', OrderController::class);
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
Route::get('orders/user/{user_id}', [OrderController::class, 'getOrdersByUserID']);
Route::post('orders/{id}/fail', [OrderController::class, 'failOrder']);
Route::get('orders/status/{status}', [OrderController::class, 'filterOrdersByStatus']);
Route::get('/orders/{orderId}/calculate-total-price', [OrderController::class, 'calculateTotalPrice']);

Route::resource('order_details', OrderDetailController::class);
Route::get('/order_details', [OrderDetailController::class, 'index']);
Route::post('/order_details', [OrderDetailController::class, 'store']);
Route::get('/order_details/{id}', [OrderDetailController::class, 'show']);
Route::put('/order_details/{id}', [OrderDetailController::class, 'update']);
Route::delete('/order_details/{id}', [OrderDetailController::class, 'destroy']);

Route::resource('shop', ShopController::class);
