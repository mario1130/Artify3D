<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    //Mostrar formulario de login
    public function show(){
        return view('login');

    }


    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Intentar hacer login con las credenciales proporcionadas
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Redirige a la página principal si el login es exitoso
        return redirect()->route('index');
    } else {
        // Redirige de vuelta al login con un mensaje de error
        return redirect()->route('login.show')->with('error', 'Correo electrónico o contraseña incorrectos');
    }
}






    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

}
