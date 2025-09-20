<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Guest (Public User)
Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('/products/{slug}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{slug}', [ProductController::class, 'update'])->name('admin.products.update');
});

require __DIR__.'/auth.php';
