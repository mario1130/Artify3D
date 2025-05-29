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
        return view('login');

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
    
            // Redirigir según el rol
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Página de administración
            } else {
                return redirect()->route('index'); // Página normal
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
