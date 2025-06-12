<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/', [HomeController::class, 'index'])
    ->middleware(['blocked'])
    ->name('index');


//Rutas de la aplicacion
require __DIR__ . '/auth.php';
require __DIR__ . '/products.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/contact.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/shop.php';


//buscador
Route::get('/search', [SearchController::class, 'search'])->name('search');


//terminos

Route::view('/info-contacto', 'info_contc')->name('info_contc');
Route::view('/policy', 'policy')->name('policy');
Route::view('/terms', 'terms')->name('terms');


//Error
Route::fallback(function () {
    return view('errors.404', ['user' => auth()->user()]); 
});

Route::get('/error/403', function () {
    return response()->view('error.403', [], 403);
})->name('error.403');

Route::get('/error/419', function () {
    return response()->view('error.419', [], 419);
})->name('error.419');

Route::get('/error/500', function () {
    return response()->view('error.500', [], 500);
})->name('error.500');


