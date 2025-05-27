<?php

use Illuminate\Support\Facades\Route;
//Añadir las routas de los controladores que vamos a utilizar
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;

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


//buscador
Route::get('/search', [SearchController::class, 'search'])->name('search');

//Perfil
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile.index');

//Shoppingcart
Route::get('/shoppingcart', [ShoppingcartController::class, 'shoppingcart'])->middleware('auth')->name('shoppingcart');
Route::post('/shoppingcart/add', [ShoppingcartController::class, 'add'])->name('shoppingcart.add');


//Error
Route::fallback(function () {
    return view('error.404', ['user' => auth()->user()]); // Carga la vista resources/views/404.blade.php
});


// Ruta Administradr

 // Route::get('/seccion', [SeccionController::class, 'seccion']);

 // Route::get('/seccion/{seccion}', [SeccionController::class, 'show']);



//llamar directamente al php
/*
Route::get('/seccion', function () {
    return view('seccion');
});*/



//Controladores con categoria opcional e inicializada null
/*
Route::get('/seccion/{seccion}/{categoria?}', function ($seccion, $categoria=null) {
    if($categoria)
    return "Bienvenidos a la categoria:  $categoria de la seccion $seccion";
    else
    return "Bienvenido a la seccion $seccion";

});*/

