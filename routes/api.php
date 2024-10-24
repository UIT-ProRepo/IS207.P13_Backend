<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/**
 * 
 * Public routes
 * 
 */

/**
 * Auth routes
 */
Route::middleware([])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/signup', [AuthController::class, 'signup']);
        Route::post('/signin', [AuthController::class, 'signin']);
    });
});


/**
 * 
 * Protected routes
 * 
 */

/**
 * All roles 
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});

/**
 * Admin
 */
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/welcome', function (Request $request) {
        return response()->json([
            'message' => 'Admin route',
        ]);
    });
});

/**
 * Admin | Owner
 */
Route::middleware(['auth:sanctum', 'role:admin,owner'])->group(function () {
    Route::get('/owner/welcome', function (Request $request) {
        return response()->json([
            'message' => 'Owner route',
        ]);
    });
});

/**
 * Admin | Owner | Customer
 */
Route::middleware(['auth:sanctum', 'role:admin,owner,customer'])->group(function () {
    Route::get('/customer/welcome', function (Request $request) {
        return response()->json([
            'message' => 'Customer route',
        ]);
    });
});


Route::apiResource('products', ProductController::class);
Route::get('/products', [ProductController::class, 'index']); // Lấy tất cả sản phẩm
Route::post('/products', [ProductController::class, 'store']); // Tạo sản phẩm mới
Route::get('/products/{id}', [ProductController::class, 'show']); // Lấy sản phẩm theo ID
Route::put('/products/{id}', [ProductController::class, 'update']); // Cập nhật sản phẩm theo ID
Route::delete('/products/{id}', [ProductController::class, 'destroy']); // Xóa sản phẩm theo ID