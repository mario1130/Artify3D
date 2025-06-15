@extends('layouts.plantilla_dashboard')

@section('context')
    <div class="top-bar">
        <h1 style="font-weight:bold;">Devoluciones</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.soporte.index') }}" class="help-button">Help</a>
        </div>
    </div>

    <div class="user-table-container">
        <div class="user-table-title">
            Devoluciones ({{ $returns->count() }})
        </div>
        <div class="search-bar">
            <form action="" method="GET" style="display:flex;gap:8px;">
                <input type="text" name="search" placeholder="Buscar por ID, usuario, email o estado..."
                    value="{{ request('search') }}">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returns as $return)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $return->id }}"></td>
                        <td>{{ $return->id }}</td>
                        <td>{{ $return->orderItem->order->id ?? '-' }}</td>
                        <td>{{ $return->orderItem->order->user->name ?? '-' }}</td>
                        <td>
                            <a href="mailto:{{ $return->orderItem->order->user->email ?? '' }}">
                                {{ $return->orderItem->order->user->email ?? '-' }}
                            </a>
                        </td>
                        <td>{{ $return->reason }}</td>
                        <td>
                            @if ($return->status === 'pendiente')
                                <span style="color: orange; font-weight: bold;">Pendiente</span>
                            @elseif ($return->status === 'aceptada')
                                <span style="color: #1D7129; font-weight: bold;">Aceptada</span>
                            @elseif ($return->status === 'rechazada')
                                <span style="color: red; font-weight: bold;">Rechazada</span>
                            @else
                                {{ ucfirst($return->status) }}
                            @endif
                        </td>
                        <td>{{ $return->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="user-table-actions">
                                @if ($return->status === 'pendiente')
                                    <button type="button" class="icon-btn" onclick="openReturnPopup({{ $return->id }})"
                                        title="Gestionar devolución">
                                        <span class="material-icons">autorenew</span>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $returns->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- Google Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Popup para aceptar/rechazar devolución -->
    <div id="return-popup"
        style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:9999; align-items:center; justify-content:center;">
        <div
            style="background:#fff; padding:32px 40px; border-radius:12px; min-width:320px; text-align:center; position:relative;">
            <button onclick="closeReturnPopup()"
                style="position:absolute; top:8px; right:16px; background:transparent; border:none; font-size:2rem; color:#e11d48; cursor:pointer;">&times;</button>
            <h3>¿Aceptar devolución?</h3>
            <form id="accept-return-form" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="action-button save" style="margin: 8px 12px 0 0;">Aceptar</button>
            </form>
            <form id="reject-return-form" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="action-button cancel" style="margin: 8px 0 0 12px;">Rechazar</button>
            </form>
        </div>
    </div>

    <script>
        function openReturnPopup(returnId) {
            document.getElementById('return-popup').style.display = 'flex';
            document.getElementById('accept-return-form').action = '/admin/returns/' + returnId + '/accept';
            document.getElementById('reject-return-form').action = '/admin/returns/' + returnId + '/reject';
        }

        function closeReturnPopup() {
            document.getElementById('return-popup').style.display = 'none';
        }
    </script>
@endsection
