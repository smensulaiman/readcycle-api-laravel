<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SwapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
});

Route::apiResource('users', UserController::class);

Route::get('categories-with-books', [CategoryController::class, 'indexWithBooks']);
Route::apiResource('categories', CategoryController::class);

Route::apiResource('books', BookController::class);

Route::post('/swaps/update-status', [SwapController::class, 'updateStatus']);
Route::apiResource('swaps', SwapController::class)->only(['index', 'store']);
