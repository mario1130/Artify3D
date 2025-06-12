<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    //Mostrar formulario de login
    public function show(){
        return view('auth.login');

    }


public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();

        // Bloqueo: si está bloqueado, cerrar sesión y mostrar error
        if ($user->bloqueado) {
            Auth::logout();
            return redirect()->route('login.show')->with('error', 'Tu cuenta está bloqueada.');
        }

        // Redirigir según el rol
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('index');
        }
    } else {
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
