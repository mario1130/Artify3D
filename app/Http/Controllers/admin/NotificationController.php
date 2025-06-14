<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\GlobalNotification;
use App\Models\User;
use App\Models\AdminLog; 


class NotificationController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::where('admin_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.notification.admin_notification', compact('notifications'));
    }

    public function create()
    {
        return view('dashboard.notification.create_notification');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        $data['admin_id'] = Auth::id();

        AdminNotification::create($data);

        $users = User::where('role', 'user')->get(); // User::all() si no tienes roles
        foreach ($users as $user) {
            $user->notify(new GlobalNotification($data['title'], $data['message']));
        }

        AdminLog::create([
            'admin_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Crear notificación',
            'description' => 'Título: ' . $data['title'] . ' | Mensaje: ' . $data['message'],
        ]);

        return redirect()->route('admin.notifications.index')->with('success', 'Notificación creada y enviada a todos los usuarios.');
    }

    public function destroy(AdminNotification $notification)
    {
        $notification->delete();

        AdminLog::create([
            'admin_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Eliminar notificación',
            'description' => 'ID: ' . $notification->id . ' | Título: ' . $notification->title,
        ]);

        return redirect()->route('admin.notifications.index')->with('success', 'Notificación eliminada.');
    }
    public function markAsRead($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->read_at = now();
        $notification->save();

        AdminLog::create([
            'admin_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Marcar notificación como leída',
            'description' => 'ID: ' . $notification->id . ' | Título: ' . $notification->title,
        ]);

        return back();
    }

    public function deleteFromPopup($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->delete();

        AdminLog::create([
            'admin_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Eliminar notificación (popup)',
            'description' => 'ID: ' . $notification->id . ' | Título: ' . $notification->title,
        ]);

        return back();
    }
    public function markAllAsRead()
    {
        \App\Models\AdminNotification::whereNull('read_at')->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }
}
