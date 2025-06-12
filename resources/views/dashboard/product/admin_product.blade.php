@extends('layouts.plantilla_dashboard')

@section('context')
    <div class="top-bar">
        <h1 style="font-weight:bold;">Productos</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.products.create') }}" class="help-button">Nuevo Producto</a>
            <a href="{{ route('admin.soporte.index') }}" class="help-button">Help</a>
        </div>
    </div>

    <div class="user-table-container">
        <div class="user-table-title">
            Productos ({{ $products->count() }})
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
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>URL Descarga</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $product->id }}"></td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>€ {{ number_format($product->precio, 2, ',', '.') }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td style="max-width:200px;word-break:break-all;">
                            {{ $product->download_url ?? '-' }}
                        <td>
                            <div class="user-table-actions">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="icon-btn" title="Editar">
                                    <span class="material-icons">edit</span>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn" title="Eliminar"
                                        onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
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
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
    </div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
