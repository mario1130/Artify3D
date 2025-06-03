<?php


namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
    return view('profile.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Perfil actualizado correctamente.');
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
