<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\User;
use App\Models\Visit;
use App\Models\Returns; // Modelo para devoluciones
use App\Models\CommentReport; // Modelo para denuncias de comentarios
use App\Models\AdminNotification; // Modelo para notificaciones de administrador

class AdminController extends Controller
{
    public function dashboard()
    {
        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Acceso dashboard',
            'description' => 'El admin accedió al dashboard',
        ]);

        $adminNotifications = AdminNotification::orderBy('created_at', 'desc')->take(20)->get();


        // Usuarios creados por mes (últimos 12 meses)
        $usersPerMonth = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Visitas por mes (últimos 12 meses)
        $visitsPerMonth = Visit::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Devoluciones por mes (últimos 12 meses)
        $returnsPerMonth = Returns::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Denuncias de comentarios por mes (últimos 12 meses)
        $reportsPerMonth = CommentReport::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Rellenar meses vacíos con 0
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $months->push($month);
        }

        $usersData = $months->map(fn($m) => $usersPerMonth[$m] ?? 0);
        $visitsData = $months->map(fn($m) => $visitsPerMonth[$m] ?? 0);
        $returnsData = $months->map(fn($m) => $returnsPerMonth[$m] ?? 0);
        $reportsData = $months->map(fn($m) => $reportsPerMonth[$m] ?? 0);

        return view('dashboard.dashboard', [
            'months' => $months,
            'usersData' => $usersData,
            'visitsData' => $visitsData,
            'returnsData' => $returnsData,
            'reportsData' => $reportsData,
            'adminNotifications' => $adminNotifications, 
        ]);
    }
}