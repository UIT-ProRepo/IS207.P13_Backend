<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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