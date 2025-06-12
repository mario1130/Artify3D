@extends('layouts.plantilla_dashboard')

@section('context')
<div class="top-bar">
    <h1 style="font-weight:bold;">Comentarios Denunciados</h1>
    <a href="{{ route('admin.soporte.index') }}" class="help-button">Help</a>
</div>

<div class="user-table-container">
    <div class="user-table-title">
        Comentarios Denunciados ({{ $reports->total() }})
    </div>
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Comentario</th>
                <th>Producto</th>
                <th>Usuario</th>
                <th>Motivo</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->comment->content ?? '-' }}</td>
                    <td>{{ $report->comment->product->name ?? '-' }}</td>
                    <td>{{ $report->comment->user->name ?? '-' }}</td>
                    <td>{{ $report->reason ?? '-' }}</td>
                    <td>{{ $report->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('admin.comments.destroy', $report->comment_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="icon-btn" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este comentario?')">
                                <span class="material-icons">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No hay comentarios denunciados.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $reports->links() }}
    </div>
</div>
<!-- Google Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection