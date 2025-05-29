<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;

// Admin routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::get('/admin/settings', [AdminController::class, 'index'])->name('admin.settings');
});

