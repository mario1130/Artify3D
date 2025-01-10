<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Para invoacar la funcion de la vista de wellcome
    public function __invoke(){

        return "<h1>Bienbenidos a mi tienda</h1>";

    }

}
