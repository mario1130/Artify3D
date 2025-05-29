<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory  as FakerFactory;
use Illuminate\Support\Facades\View; 
use App\Models\Category; 

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
        $this->app->singleton(\Faker\Generator::class, function (){
            return FakerFactory::create('es_ES');
        });
        // Compartir $categories con todas las vistas que usen layouts/cabecera.blade.php
        View::composer('layouts.cabecera', function ($view) {
        $view->with('categories', Category::all());
        });
        View::composer('layouts.cabecera_user_menu', function ($view) {
        $view->with('categories', Category::all());
        });
    }
}
