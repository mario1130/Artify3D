@extends('layouts.plantilla_dashboard')

@section('context')
    <div class="top-bar">
        <h1 style="font-weight:bold;">Notificaciones Globales</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.notifications.create') }}" class="help-button">Nueva Notificación</a>
            <a href="{{ route('admin.soporte.index') }}" class="help-button">Help</a>
        </div>
    </div>

    <div class="user-table-container">
        <div class="user-table-title">
            Notificaciones ({{ $notifications->count() }})
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Mensaje</th>
                    <th>Creada por</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notification)
                    <tr>
                        <td>{{ $notification->id }}</td>
                        <td>{{ $notification->title }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ $notification->admin->name ?? '-' }}</td>
                        <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn" title="Eliminar"
                                    onclick="return confirm('¿Seguro que deseas eliminar esta notificación?')">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:#888;">
                            No hay notificaciones globales creadas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-container" style="margin-top: 18px;">
            {{ $notifications->links() }}
        </div>
    </div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
