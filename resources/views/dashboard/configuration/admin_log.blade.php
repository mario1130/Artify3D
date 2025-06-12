@extends('layouts.plantilla_dashboard')

@section('context')
    <style>
        .log-card {
            width: 100%;
            max-width: 100%;
            margin: 40px auto 0 auto;
            background: #fff;
            padding: 24px;
            margin-bottom: 24px;
        }
        .log-list {
            width: 100%;
            min-height: 650px;
            max-height: 600px;
            overflow-y: auto;
            font-size: 1.05rem;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            padding: 18px;
        }
        .log-entry {
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 0;
        }
        .log-entry:last-child {
            border-bottom: none;
        }
        .log-action {
            font-weight: bold;
            color: #6366f1;
        }
        .log-admin {
            color: #e11d48;
            font-weight: bold;
        }
        .log-date {
            color: #888;
            font-size: 0.95em;
        }
        .form-actions-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            width: 100%;
            margin-left: -1.5rem;
            margin-right: auto;
        }
        .form-actions {
            display: flex;
            gap: 12px;
        }
    </style>
    <div class="top-bar">
        <h1 style="font-weight:bold;">Log de acciones de administradores</h1>
    </div>

    <h2 class="title">Historial de acciones</h2>

    <div class="container">
        <div class="form-card log-card">
            <div class="log-list">
                @forelse($logs as $log)
                    <div class="log-entry">
                        <span class="log-admin">{{ $log->admin->name ?? 'Admin' }}</span>
                        <span class="log-action">{{ $log->action }}</span>
                        <span>- {{ $log->description }}</span>
                        <div class="log-date">{{ $log->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                @empty
                    <div style="color:#888;">No hay acciones registradas.</div>
                @endforelse
            </div>
            <div style="margin-top:18px;">
                {{ $logs->links() }}
            </div>
        </div>
        <div class="form-actions-container">
            <div class="form-actions">
                <a href="{{ route('admin.dashboard') }}" class="action-button cancel">Cerrar</a>
            </div>
        </div>
    </div>
@endsection