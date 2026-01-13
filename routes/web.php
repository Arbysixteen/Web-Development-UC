<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout (authenticated only)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Product routes (public browsing)
Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/show/{id}', 'show')->name('show');
    
    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
    });
});

// Cart routes (authenticated customers)
Route::middleware('auth')->prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/add', 'add')->name('add');
    Route::put('/update/{item}', 'update')->name('update');
    Route::delete('/remove/{item}', 'remove')->name('remove');
});

// Order routes (authenticated customers)
Route::middleware('auth')->prefix('orders')->name('orders.')->controller(OrderController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::post('/checkout', 'processCheckout')->name('process-checkout');
    Route::get('/{id}', 'show')->name('show');
});

// Admin routes
Route::middleware('admin')->prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/orders', 'orders')->name('orders');
    Route::get('/orders/{id}', 'showOrder')->name('orders.show');
    Route::put('/orders/{id}/status', 'updateOrderStatus')->name('orders.update-status');
    Route::put('/orders/{id}/payment', 'updatePaymentStatus')->name('orders.update-payment');
});
