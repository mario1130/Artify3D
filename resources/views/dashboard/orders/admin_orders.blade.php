@extends('layouts.plantilla_dashboard')

@section('context')
    <div class="top-bar">
        <h1 style="font-weight:bold;">Pedidos</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.orders.create') }}" class="help-button">Nuevo Pedido</a>
            <a href="{{ route('admin.soporte.index') }}" class="help-button">Help</a>
        </div>
    </div>

    <div class="user-table-container">
        <div class="user-table-title">
            Pedidos ({{ $orders->count() }})
        </div>
        <div class="search-bar">
            <form action="" method="GET" style="display:flex;gap:8px;">
                <input type="text" name="search" placeholder="Buscar por ID, nombre o email..." value="{{ request('search') }}">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $order->id }}"></td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td><a href="mailto:{{ $order->user->email ?? '' }}">{{ $order->user->email ?? '-' }}</a></td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>{{ $order->total }} €</td>
                        <td>
                            <div class="user-table-actions">
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="icon-btn" title="Editar">
                                    <span class="material-icons">edit</span>
                                </a>
                                {{-- Puedes agregar más acciones aquí --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $orders->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- Google Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection