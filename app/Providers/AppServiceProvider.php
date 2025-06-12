<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Models\WishlistGroup;
use Illuminate\Support\ServiceProvider;
use Faker\Factory  as FakerFactory;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\AdminNotification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(\Faker\Generator::class, function () {
            return FakerFactory::create('es_ES');
        });
        View::composer('layouts.cabecera_dashboard', function ($view) {
            $view->with('adminNotifications', AdminNotification::orderBy('created_at', 'desc')->take(20)->get());
        });
        // Compartir $categories con todas las vistas que usen layouts/cabecera.blade.php
        View::composer('layouts.cabecera', function ($view) {
            $view->with('categories', Category::all());
            // Compartir $wishlistGroups solo si el usuario está autenticado
            if (Auth::check()) {
                $view->with('wishlistGroups', WishlistGroup::where('user_id', Auth::id())->get());
            } else {
                $view->with('wishlistGroups', collect()); // Enviar una colección vacía si no está autenticado
            }
        });
        View::composer('layouts.cabecera_user_menu', function ($view) {
            $view->with('categories', Category::all());
            // Compartir $wishlistGroups solo si el usuario está autenticado
            if (Auth::check()) {
                $view->with('wishlistGroups', WishlistGroup::where('user_id', Auth::id())->get());
            } else {
                $view->with('wishlistGroups', collect()); // Enviar una colección vacía si no está autenticado
            }
        });
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('wishlistGroups', WishlistGroup::where('user_id', Auth::id())->get());
            } else {
                $view->with('wishlistGroups', collect());
            }
        });
    }
}
