<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //Inicio de Session
    public function session(){
        return view('session');

    }
}
