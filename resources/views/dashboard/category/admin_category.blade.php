@extends('layouts.plantilla_dashboard')

@section('context')
    <div class="top-bar">
        <h1 style="font-weight:bold;">Categorías</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.categories.create') }}" class="help-button">Nueva Categoría</a>
            <a href="{{ route('admin.soporte.index') }}" class="help-button">Help</a>
        </div>
    </div>

    <div class="user-table-container">
        <div class="user-table-title">
            Categorías ({{ $categories->count() }})
        </div>
        <div class="search-bar">
            <form action="" method="GET" style="display:flex;gap:8px;">
                <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $category->id }}"></td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <div class="user-table-actions">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="icon-btn" title="Editar">
                                    <span class="material-icons">edit</span>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn" title="Eliminar"
                                        onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container" style="margin-top: 18px;">
            {{ $categories->appends(['search' => request('search')])->links() }}
        </div>
    </div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection