<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
});


Route::apiResource('users', UserController::class);
Route::apiResource('categories', UserController::class);
Route::apiResource('books', UserController::class);
