<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\AdminLog; // Añadido

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhereHas('user', function ($qu) use ($search) {
                        $qu->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        }

        $orders = $query->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.orders.admin_orders', compact('orders'));
    }

    public function edit(Order $order)
    {
        $users = User::all();
        return view('dashboard.orders.edit_orders', compact('order', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
        ]);

        $order->update($request->only(['user_id', 'status', 'total']));

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Actualizar pedido',
            'description' => 'ID: ' . $order->id . ' | Estado: ' . $order->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Pedido actualizado correctamente.');
    }

    public function create()
    {
        $users = User::all();
        return view('dashboard.orders.create_orders', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
        ]);

        $order = Order::create($request->only(['user_id', 'status', 'total']));

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Crear pedido',
            'description' => 'ID: ' . $order->id . ' | Estado: ' . $order->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Pedido creado correctamente.');
    }

    public function acceptReturn(Order $order)
    {
        $order->status = 'devuelto';
        $order->save();

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Aceptar devolución',
            'description' => 'ID: ' . $order->id,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Devolución aceptada.');
    }

    public function rejectReturn(Order $order)
    {
        $order->status = 'rechazado';
        $order->save();

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Rechazar devolución',
            'description' => 'ID: ' . $order->id,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Devolución rechazada.');
    }
}
