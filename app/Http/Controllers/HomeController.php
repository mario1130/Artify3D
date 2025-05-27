<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 

class HomeController extends Controller
{
    //Para invocar la funcion de la vista
    
    public function index(){
        // Obtén las categorías desde la base de datos
        $categories = Category::all();

        // Pasa las categorías a la vista
        return view('index', compact('categories'));

    }

    


}
