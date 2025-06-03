<?php

use Illuminate\Support\Facades\Route;
//Añadir las routas de los controladores que vamos a utilizar
use App\Http\Controllers\HomeController;
use App\Http\Controllers\profile\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\profile\ComentariosControler;

use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main route
Route::get('/', [HomeController::class, 'index'])->name('index');


//Rutas de la aplicacion
require __DIR__ . '/auth.php';
require __DIR__ . '/products.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/contact.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/shop.php';


//buscador
Route::get('/search', [SearchController::class, 'search'])->name('search');


//Error
Route::fallback(function () {
    return view('error.404', ['user' => auth()->user()]); // Carga la vista resources/views/404.blade.php
});



