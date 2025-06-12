@extends('layouts.plantilla_dashboard')

@section('context')
    <div class="top-bar">
        <h1 style="font-weight:bold;">Usuarios</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.users.create') }}" class="help-button">Nuevo Usuario</a>
            <a href="{{ route('admin.soporte.index') }}" class="help-button">Help</a>
        </div>
    </div>

    <div class="user-table-container">
        <div class="user-table-title">
            Usuarios ({{ $users->count() }})
        </div>
        <div class="search-bar">
            <form action="" method="GET" style="display:flex;gap:8px;">
                <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha de Registro</th>
                    <th>Roles</th>
                    <th>Bloqueado</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $user->id }}"></td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if ($user->blocked)
                                <span style="color: red; font-weight: bold;">Sí</span>
                            @else
                                <span style="color: green;">No</span>
                            @endif
                        </td>
                        <td>
                            <div class="user-table-actions">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="icon-btn" title="Editar">
                                    <span class="material-icons">edit</span>
                                </a>
                                <form action="{{ route('admin.users.toggle-block', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="icon-btn" title="{{ $user->blocked ? 'Desbloquear' : 'Bloquear' }}">
                                        <span class="material-icons">
                                            {{ $user->blocked ? 'lock_open' : 'block' }}
                                        </span>
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn" title="Eliminar"
                                        onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $users->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- Google Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection