<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\shop\ShoppingcartController;
use App\Http\Controllers\shop\PagoController;
use App\Http\Controllers\shop\ResumenController;


//Shoppingcart
Route::get('/shoppingcart', [ShoppingcartController::class, 'shoppingcart'])->middleware('auth')->name('shoppingcart');
Route::post('/shoppingcart/add', [ShoppingcartController::class, 'add'])->name('shoppingcart.add');

Route::post('/cart/empty', [ShoppingCartController::class, 'empty'])->name('cart.empty');
Route::delete('/cart/remove/{id}', [ShoppingCartController::class, 'remove'])->name('cart.remove');

Route::get('/pago', [PagoController::class, 'pago'])->middleware('auth')->name('pago');
Route::post('/pago/confirmar', [PagoController::class, 'confirmar'])->middleware('auth')->name('pago.confirmar');


Route::get('/resumen', [ResumenController::class, 'index'])->name('resumen');
Route::post('/finalizar', [ResumenController::class, 'finalizar'])->name('finalizar.compra');