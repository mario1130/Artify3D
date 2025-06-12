<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ReturnController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CommentReportController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\SoporteController;
use App\Http\Controllers\admin\AdminLogController;
use App\Http\Controllers\admin\ProfileController;

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


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggle-block');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggle-block');
    Route::resource('orders', OrderController::class);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::patch('returns/{return}/accept', [ReturnController::class, 'accept'])->name('returns.accept');
    Route::patch('returns/{return}/reject', [ReturnController::class, 'reject'])->name('returns.reject');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('comments', [CommentReportController::class, 'index'])->name('comments.index');
    Route::get('comment-reports', [CommentReportController::class, 'index'])->name('comment_reports.index');
    Route::delete('comments/{comment}', [CommentReportController::class, 'destroy'])->name('comments.destroy');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('notifications', NotificationController::class)->only(['index', 'create', 'store', 'destroy']);
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('soporte', [SoporteController::class, 'index'])->name('soporte.index');
    Route::post('soporte/enviar', [SoporteController::class, 'enviar'])->name('soporte.enviar');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('log-admin', [AdminLogController::class, 'index'])->name('log_admin.index');
});

Route::get('/admin/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('admin.notifications.read');
Route::get('/admin/notifications/delete/{id}', [NotificationController::class, 'deleteFromPopup'])->name('admin.notifications.delete');
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllRead');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.profile.')->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('index');
    Route::post('profile', [ProfileController::class, 'update'])->name('update');
    Route::post('profile/image', [ProfileController::class, 'updateImage'])->name('image.update');
});