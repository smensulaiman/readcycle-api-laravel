<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WebAuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\BookController as DashboardBookController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\SwapController as DashboardSwapController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/documentation', function () {
    return view('documentation');
})->name('documentation');

Route::get('/api-docs', function () {
    return response()->file(public_path('api-docs.json'));
})->name('api-docs');

Route::get('/swagger', function () {
    return view('swagger');
})->name('swagger');

// Authentication routes
Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login']);
Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [WebAuthController::class, 'register']);
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// Dashboard routes (protected)
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Books management
    Route::resource('books', DashboardBookController::class);
    
    // User profile management
    Route::get('/profile', [DashboardUserController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardUserController::class, 'updateProfile'])->name('profile.update');
    
    // Categories management
    Route::resource('categories', DashboardCategoryController::class);
    
    // Swaps management
    Route::resource('swaps', DashboardSwapController::class);
    Route::post('/swaps/{swap}/update-status', [DashboardSwapController::class, 'updateStatus'])->name('swaps.update-status');
});
