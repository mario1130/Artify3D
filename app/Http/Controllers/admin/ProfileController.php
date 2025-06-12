<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);
        $user->update($data);

        return redirect()->route('admin.profile.index')->with('success', 'Datos actualizados correctamente.');
    }
public function updateImage(Request $request)
{
    $request->validate([
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $filename = 'admin_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('avatars', $filename, 'public');
        $user->avatar = $path;
        $user->save();
        return response()->json(['success' => true, 'image_path' => asset('storage/' . $path)]);
    }

    return response()->json(['success' => false, 'error' => 'No se subió ninguna imagen']);
}
}
