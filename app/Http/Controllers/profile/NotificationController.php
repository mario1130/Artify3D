<?php

namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(){
    return view('profile.notification');
    }
        public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect($notification->data['url']);
    }

    public function deleteNotification($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->delete();
            return redirect()->route('notifications.index')->with('success', 'Notificación eliminada correctamente.');
        }

        return redirect()->route('notifications.index')->with('error', 'No se pudo eliminar la notificación.');
    }
}
