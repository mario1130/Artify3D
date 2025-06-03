<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\products\My_productsController;
use App\Http\Controllers\products\ProductController;
use App\Http\Controllers\profile\CommentController;

// Product routes
Route::get('/my_products/add', [My_productsController::class, 'add_show'])->name('add_products.add_show');
Route::post('/my_products/add', [My_productsController::class, 'add'])->name('add_products');
Route::get('/my_products/{product}', [My_productsController::class, 'product_show'])->name('products.product_show');
Route::get('/my_products', [My_productsController::class, 'index'])->name('my_products.index');
Route::delete('/products/{id}', [My_productsController::class, 'destroy'])->name('products.destroy');
Route::get('/my_products/{id}/edit', [My_productsController::class, 'edit_show'])->name('products.edit_show');
Route::put('/products/{id}', [My_productsController::class, 'update'])->name('products.update');
Route::get('/products/{id}', [My_productsController::class, 'All_product_show'])->name('All_products.show');

// Category routes
Route::get('/categoria/{slug}', [ProductController::class, 'showByCategory'])->name('products.byCategory');

// Comentarios
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');