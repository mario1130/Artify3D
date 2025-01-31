<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index(){
        return  view('emails.index');
    }


    public function store(Request $request){

        $request->validate([

            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required',

        ]);



        $correo = new ContactoMailable($request->all());
        Mail::to('mariopascualmedinamario@gmail.com')->send($correo);
        return('Mensaje enviado');

    }



}
