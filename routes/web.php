<?php

use Illuminate\Support\Facades\Route;
//Añadir las routas de los controladores que vamos a utilizar
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\My_productsController;
use App\Http\Controllers\Add_productsController;
use App\Http\Controllers\ContactoController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

//EJEMPLOS

//LLamada de controladores
Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/login', [LoginController::class, 'show'])->name('login.show');

Route::post('/login', [LoginController::class, 'login'])->name('login');



Route::get('/register', [RegisterController::class, 'show'])->name('register.show');

Route::post('/register', [RegisterController::class, 'register'])->name('register');



Route::get('/shoppingcart', [ShoppingcartController::class, 'shoppingcart'])->name('shoppingcart');



Route::get('/my_products/add', [My_productsController::class, 'add_show'])->name('add_products.add_show');

Route::post('/my_products/add', [My_productsController::class, 'add'])->name('add_products');

Route::get('/my_products/{product}', [My_productsController::class, 'product_show'])->name('products.product_show');

Route::get('/my_products', [My_productsController::class, 'index'])->name('my_products.index');



//Mail
Route::get('contacto',[ContactoController::class,'index'])->name('contacto.index');

Route::post('contacto',[ContactoController::class,'store'])->name('contacto.store');







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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
