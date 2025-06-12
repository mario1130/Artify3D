<?php

use Illuminate\Support\Facades\Route;

//Añadir las routas de los controladores que vamos a utilizar
use App\Http\Controllers\profile\ProfileController;
use App\Http\Controllers\profile\CommentController;
use App\Http\Controllers\profile\WishlistController;
use App\Http\Controllers\profile\NotificationController;
use App\Http\Controllers\profile\PedidosController;
use App\Http\Controllers\profile\PedidosCanceladosController;
use App\Http\Controllers\profile\PurchasehistoryController;
use App\Http\Controllers\profile\ReturnsController;



//Perfil
Route::middleware(['auth', 'blocked'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/comments', [CommentController::class, 'comments'])->name('comments.index');
    Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos_cancelados', [PedidosCanceladosController::class, 'index'])->name('pedidoscancelados.index');
    Route::get('/Historial_de_compras', [PurchasehistoryController::class, 'index'])->name('purchasehistory.index');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image/update', [ProfileController::class, 'updateProfileImage'])->name('profile.image.update');

    Route::get('/wishlist-groups', [WishlistController::class, 'groups'])->name('wishlist.groups');
    Route::post('/wishlist-group', [WishlistController::class, 'storeGroup'])->name('wishlist_group.store');
    Route::delete('/wishlist-group/{id}', [WishlistController::class, 'destroyGroup'])->name('wishlist_group.destroy');
    Route::get('/wishlist/{groupId}', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/notificaciones', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notificaciones/{id}/leer', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notificaciones/{id}/eliminar', [NotificationController::class, 'deleteNotification'])->name('notifications.delete');

    Route::post('/returns', [ReturnsController::class, 'store'])->name('returns.store');

    Route::post('comments/{comment}/report', [CommentController::class, 'report'])->name('comments.report');
});