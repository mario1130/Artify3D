<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\AdminLog; 

class SoporteController extends Controller
{
    public function index()
    {
        return view('dashboard.configuration.soporte');
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string|max:5000',
        ]);

        $correoDestino = 'pascualmedinamario@gmail.com';

        Mail::raw(
            "Mensaje de soporte de: " . auth()->user()->email . "\n\n" . $request->mensaje,
            function ($message) use ($correoDestino) {
                $message->to($correoDestino)
                        ->subject('Nuevo mensaje de soporte');
            }
        );

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Enviar mensaje soporte',
            'description' => 'Mensaje: ' . $request->mensaje,
        ]);

        return back()->with('success', '¡Tu mensaje ha sido enviado al soporte!');
    }
}