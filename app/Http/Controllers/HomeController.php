<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Para invoacar la funcion de la vista
    
    public function index(){
        return view('seccion.index');

    }

    


}
