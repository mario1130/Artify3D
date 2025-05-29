<?php


namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function index()
    {
        return view('profile.comentarios'); 
    }
}