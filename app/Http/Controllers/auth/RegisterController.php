<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
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
            'role' => 'user', 

        ]);


        return redirect()->route('login.show')->with('success','Registro exitoso');
    }

}
