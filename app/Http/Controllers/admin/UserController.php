<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminLog; // Añadido


class UserController extends Controller
{
public function index(Request $request)
{
    $query = User::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('id', $search);
        });
    }

    $users = $query->orderBy('id', 'asc')->paginate(10);

    return view('dashboard.user.admin_user', compact('users'));
}

    public function create()
    {
        return view('dashboard.user.create_user');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Crear usuario',
            'description' => 'Email: ' . $data['email'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('dashboard.user.edit_user', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->only(['name', 'email', 'role']);

        // Solo actualizar la contraseña si se ha enviado
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Actualizar usuario',
            'description' => 'ID: ' . $user->id . ' | Email: ' . $user->email,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function show(User $user)
    {
        return view('admin.user.show_user', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Eliminar usuario',
            'description' => 'ID: ' . $user->id . ' | Email: ' . $user->email,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
    public function toggleBlock(User $user)
    {
        $user->blocked = !$user->blocked;
        $user->save();

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => $user->blocked ? 'Bloquear usuario' : 'Desbloquear usuario',
            'description' => 'ID: ' . $user->id . ' | Email: ' . $user->email,
        ]);

        return redirect()->route('admin.users.index')->with('success', $user->blocked ? 'Usuario bloqueado.' : 'Usuario desbloqueado.');
    }
}
