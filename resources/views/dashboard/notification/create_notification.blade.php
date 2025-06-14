@extends('layouts.plantilla_dashboard')

@section('context')
    <div class="top-bar">
        <h1 style="font-weight:bold;">Notificaciones</h1>
        <a href="{{ route('admin.notifications.index') }}" class="help-button">Volver</a>
    </div>

    <h2 class="title">Añadir Notificación Global</h2>

    <div class="container">
        <div class="form-card">
            @if ($errors->any())
                <div class="alert alert-danger"
                    style="color: #fff; background: #e11d48; padding: 10px 20px; border-radius: 6px; margin-bottom: 18px;">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.notifications.store') }}" method="POST"
                style="display: flex; flex-direction: column; height: 100%;">
                @csrf
                <div class="form-fields-center">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            placeholder="Título de la notificación">
                        @error('title')
                            <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" required placeholder="Mensaje">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="action-button save">Guardar Notificación</button>
                    <a href="{{ route('admin.notifications.index') }}" class="action-button cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
