@extends('layouts.plantilla_dashboard')

@section('context')

<div class="top-bar">
    <h1 style="font-weight:bold;">Usuarios</h1>
    <a href="#" class="help-button">Help</a>
</div>

<h2 class="title">Editar Usuario</h2>

<div class="container">
    <div class="form-card">
        {{-- Alertas de validación globales --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="color: #fff; background: #e11d48; padding: 10px 20px; border-radius: 6px; margin-bottom: 18px;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="display: flex; flex-direction: column; height: 100%;">
            @csrf
            @method('PUT')
            <div class="form-fields-center">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="Nombre completo">
                    @error('name')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Correo electrónico">
                    @error('email')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Contraseña (dejar en blanco para no cambiar)</label>
                    <input type="password" id="password" name="password" placeholder="Nueva contraseña">
                    <input type="password" name="password_confirmation" placeholder="Repetir contraseña">
                    @error('password')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Rol</label>
                    <select id="role" name="role" required>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Cliente</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('role')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="action-button save">Actualizar Usuario</button>
                <a href="{{ route('admin.users.index') }}" class="action-button cancel">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection