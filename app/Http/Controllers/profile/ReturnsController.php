<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Returns;
use App\Models\AdminNotification; 


class ReturnsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'reason' => 'nullable|string|max:500',
        ]);

        Returns::create([
            'order_item_id' => $request->order_item_id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'status' => 'pendiente',
        ]);

        // Crear notificación para admin
        AdminNotification::create([
            'title' => 'Nueva devolución',
            'message' => 'Un usuario ha solicitado una devolución. Revisa la sección de devoluciones.',
            'admin_id' => 1, // O null si es global
            'read_at' => null,
            'type' => 'return', 
        ]);

        return back()->with('success', 'Solicitud de devolución enviada.');
    }
}
