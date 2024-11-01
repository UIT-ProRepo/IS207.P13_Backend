<?php

use App\Http\Controllers\AuthController;
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
