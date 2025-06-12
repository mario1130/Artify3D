@extends('layouts.plantilla_dashboard')

@section('context')

<div class="top-bar">
    <h1 style="font-weight:bold;">Pedidos</h1>
    <a href="{{ route('admin.orders.index') }}" class="help-button">Volver</a>
</div>

<h2 class="title">Añadir Pedido</h2>

<div class="container">
    <div class="form-card">
        @if ($errors->any())
            <div class="alert alert-danger" style="color: #fff; background: #e11d48; padding: 10px 20px; border-radius: 6px; margin-bottom: 18px;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.orders.store') }}" method="POST" style="display: flex; flex-direction: column; height: 100%;">
            @csrf
            <div class="form-fields-center">
                <div class="form-group">
                    <label for="user_id">Usuario</label>
                    <select id="user_id" name="user_id" required>
                        <option value="">Selecciona un usuario</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <input type="text" id="status" name="status" value="{{ old('status') }}" required placeholder="Estado del pedido">
                    @error('status')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="total">Total (€)</label>
                    <input type="number" id="total" name="total" value="{{ old('total') }}" required step="0.01" min="0" placeholder="Total">
                    @error('total')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="action-button save">Guardar Pedido</button>
                <a href="{{ route('admin.orders.index') }}" class="action-button cancel">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection