<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SwapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public book and category routes
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::get('/categories-with-books', [CategoryController::class, 'indexWithBooks']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Authentication
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // User management
    Route::apiResource('users', UserController::class);
    
    // Book management (create, update, delete)
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{book}', [BookController::class, 'update']);
    Route::patch('/books/{book}', [BookController::class, 'update']);
    Route::delete('/books/{book}', [BookController::class, 'destroy']);
    
    // Category management (create, update, delete)
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::patch('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    
    // Swap management
    Route::get('/swaps', [SwapController::class, 'index']);
    Route::post('/swaps', [SwapController::class, 'store']);
    Route::get('/swaps/{swap}', [SwapController::class, 'show']);
    Route::put('/swaps/{swap}', [SwapController::class, 'update']);
    Route::patch('/swaps/{swap}', [SwapController::class, 'update']);
    Route::delete('/swaps/{swap}', [SwapController::class, 'destroy']);
    Route::post('/swaps/update-status', [SwapController::class, 'updateStatus']);
});
