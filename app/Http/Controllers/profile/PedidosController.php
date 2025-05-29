<?php

namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PedidosController extends Controller
{
    public function index(){
    return view('profile.pedidos');
    }
}
