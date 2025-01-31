<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    //
    public function show(){
        return view('login');

    }



    public function login(Request $request){

        $request->validate([

            'email' => 'required|email',
            'password' => 'required|string|min:8',

        ]);

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){

            return redirect()->route('index');

        }else{

            return redirect()->route('login.show')->with('error','Informacion incorrecta');

        }


    }



}
