<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;

class AdminLogController extends Controller
{
public function index()
{
    // Cuenta los logs
    $totalLogs = AdminLog::count();

    // Si hay más de 20, borra los más antiguos y deja solo los 20 más recientes
    if ($totalLogs > 20) {
        $idsToKeep = AdminLog::orderBy('created_at', 'desc')->take(20)->pluck('id');
        AdminLog::whereNotIn('id', $idsToKeep)->delete();
    }

 
    $logs = AdminLog::orderBy('created_at', 'desc')->paginate(20);

    return view('dashboard.configuration.admin_log', compact('logs'));
}
}