<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Returns as Devolucion;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = Devolucion::with(['pedido.user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('id', $search)
                ->orWhere('estado', 'like', "%$search%")
                ->orWhereHas('pedido', function ($q) use ($search) {
                    $q->where('id', $search)
                        ->orWhereHas('user', function ($qu) use ($search) {
                            $qu->where('name', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%");
                        });
                });
        }

        $returns = $query->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.returns.admin_returns', compact('returns'));
    }

    public function accept(Devolucion $return)
    {

        $return->status = 'aceptada';
        $return->save();

        return redirect()->route('admin.returns.index')->with('success', 'Devolución aceptada.');
    }

    public function reject(Devolucion $return)
    {
        $return->status = 'rechazada';
        $return->save();

        return redirect()->route('admin.returns.index')->with('success', 'Devolución rechazada.');
    }
}
