<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

// Guest (Public User)
Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders', OrderController::class);
    Route::resource('cart', CartController::class);
    Route::post('/cart/store/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{itemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{itemId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::resource('checkout', CheckoutController::class);
});

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('/products/{slug}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{slug}', [AdminProductController::class, 'update'])->name('admin.products.update');
});

require __DIR__.'/auth.php';
