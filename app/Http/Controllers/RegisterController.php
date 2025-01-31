<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //Registrarse de Session
    public function show(){
        return view('register');

    }

    public function register(Request $request){

        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'privacy-policy' => 'accepted',

        ]);

        User::create([

            'name' => $request-> name,
            'email' => $request-> email,
            'password' => Hash::make($request->password),


        ]);


        return redirect()->route('login.show')->with('success','Registro exitoso');
    }

}
