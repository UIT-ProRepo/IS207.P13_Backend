<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

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
