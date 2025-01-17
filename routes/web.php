<?php

use Illuminate\Support\Facades\Route;
//Añadir las routas de los controladores que vamos a utilizar
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShoppingcartController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

//EJEMPLOS

//LLamada de controladores
Route::get('/', [HomeController::class, 'index']);

Route::get('/session', [SessionController::class, 'session']);

Route::get('/register', [RegisterController::class, 'register']);

Route::get('/shoppingcart', [ShoppingcartController::class, 'shoppingcart']);




Route::get('/seccion', [SeccionController::class, 'seccion']);

Route::get('/seccion/{seccion}', [SeccionController::class, 'show']);



//llamar directamente al php
/*
Route::get('/seccion', function () {
    return view('seccion');
});*/



//Controladores con categoria opcional e inicializada null

Route::get('/seccion/{seccion}/{categoria?}', function ($seccion, $categoria=null) {
    if($categoria)
    return "Bienvenidos a la categoria:  $categoria de la seccion $seccion";
    else
    return "Bienvenido a la seccion $seccion";

});
