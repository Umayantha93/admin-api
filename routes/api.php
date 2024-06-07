<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::put('update/info', [AuthController::class, 'UpdateInfo']);
    Route::put('update/password', [AuthController::class, 'UpdatePassword']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::get('permissions', [PermissionController::class, 'index']);

    Route::apiResource('products', ProductController::class);
    Route::post('upload', [ImageController::class, 'upload']);

    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders/{id}', [OrderController::class, 'show']);
});

