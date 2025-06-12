@extends('layouts.plantilla_dashboard')

@section('context')

    <div class="top-bar">
        <h1 style="font-weight:bold;">Productos</h1>
        <a href="#" class="help-button">Help</a>
    </div>

    <h2 class="title">Editar Producto</h2>

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

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                style="display: flex; flex-direction: column; height: 100%;">
                @csrf
                @method('PUT')
                <div class="form-fields-center">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                            required placeholder="Nombre del producto">
                        @error('name')
                            <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input type="text" id="description" name="description"
                            value="{{ old('description', $product->description) }}" placeholder="Descripción">
                        @error('description')
                            <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" id="precio" name="precio" value="{{ old('precio', $product->precio) }}"
                            step="0.01" min="0" placeholder="Precio">
                        @error('precio')
                            <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="download_url">URL de descarga</label>
                        <input type="url" name="download_url" id="download_url" class="form-control"
                            value="{{ old('download_url', $product->download_url ?? '') }}"
                            placeholder="https://tusitio.com/archivo.zip">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">Selecciona una categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="action-button save">Actualizar Producto</button>
                    <a href="{{ route('admin.products.index') }}" class="action-button cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
