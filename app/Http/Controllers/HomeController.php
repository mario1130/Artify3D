<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Para invocar la funcion de la vista
    
    public function index(){
        return view('index');

    }

    


}
