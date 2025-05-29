<?php

namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PedidosCanceladosController extends Controller
{
    public function index(){
    return view('profile.pedidos_cancelados');
    }
}
