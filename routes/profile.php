<?php

use Illuminate\Support\Facades\Route;

//Añadir las routas de los controladores que vamos a utilizar
use App\Http\Controllers\profile\ProfileController;
use App\Http\Controllers\profile\ComentariosController;
use App\Http\Controllers\profile\WishlistController;
use App\Http\Controllers\profile\NotificationController;
use App\Http\Controllers\profile\PedidosController;
use App\Http\Controllers\profile\PedidosCanceladosController;
use App\Http\Controllers\profile\PurchasehistoryController;



//Perfil
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile.index');
Route::get('/comments', [ComentariosController::class, 'index'])->middleware('auth')->name('comments.index');
Route::get('/listas', [WishlistController::class, 'index'])->middleware('auth')->name('wishlists.index');
Route::get('/notificaciones', [NotificationController::class, 'index'])->middleware('auth')->name('notifications.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->middleware('auth')->name('pedidos.index');
Route::get('/pedidos_cancelados', [PedidosCanceladosController::class, 'index'])->middleware('auth')->name('pedidoscancelados.index');
Route::get('/Historial_de_compras', [PurchasehistoryController::class, 'index'])->middleware('auth')->name('purchasehistory.index');
