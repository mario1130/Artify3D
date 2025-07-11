<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

// Contact routes
Route::get('contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::post('contacto', [ContactoController::class, 'store'])->name('contacto.store');