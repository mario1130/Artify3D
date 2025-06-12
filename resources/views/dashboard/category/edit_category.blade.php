@extends('layouts.plantilla_dashboard')

@section('context')
<div class="top-bar">
    <h1 style="font-weight:bold;">Editar Categoría</h1>
    <a href="{{ route('admin.categories.index') }}" class="help-button">Volver</a>
</div>

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

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" style="display: flex; flex-direction: column; height: 100%;">
            @csrf
            @method('PUT')
            <div class="form-fields-center">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required placeholder="Nombre de la categoría">
                    @error('name')
                        <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="action-button save">Actualizar Categoría</button>
                <a href="{{ route('admin.categories.index') }}" class="action-button cancel">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection