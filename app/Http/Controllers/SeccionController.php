<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeccionController extends Controller
{
    //Creacion de las categorias 

    //llamando a la ruta de la vista
    /*
    public function index(){
        return view('seccion.index');

    }*/

    public function create(){
        return "Estas en formulario para añadir subsecciones";
    }


    /*
    //lo pasamos con un array y le asignamos un valor 
    public function show($categoria){
        return view('seccion.show', ['seccion' => $seccion]);

    }*/


    //lo pasamos con un array y le asignamos un valor con compact hace lo mismo que con lo del array
    public function show($seccion){
        return view('seccion.show', compact('seccion'));

    }

}
