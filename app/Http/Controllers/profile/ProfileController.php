<?php


namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
    return view('profile.profile');
    }

public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        // solo valida la contraseña si se intenta cambiar
        'old_password' => 'nullable|string',
        'new_password' => 'nullable|string|min:8|confirmed',
    ]);

    // Actualiza el nombre siempre
    $user->name = $request->name;

    // Solo cambia la contraseña si se ha puesto una nueva
    if ($request->filled('new_password')) {
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'La contraseña actual no es correcta.']);
        }
        $user->password = bcrypt($request->new_password);
    }

    $user->save();

    return back()->with('success', 'Datos actualizados correctamente.');
}


public function updateProfileImage(Request $request)
{
    try {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $path = $request->file('profile_image')->store('avatar', 'public');
        $user->avatar = $path;
        $user->save();

        // Depurar la respuesta
        \Log::info('Avatar actualizado: ' . $path);

        return response()->json(['success' => true, 'image_path' => asset('storage/' . $path)]);
    } catch (\Exception $e) {
        \Log::error('Error al actualizar el avatar: ' . $e->getMessage());
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}


}
