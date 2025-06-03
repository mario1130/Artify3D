<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Returns;


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

        return back()->with('success', 'Solicitud de devolución enviada.');
    }
}
