@extends('layouts.plantilla')

@section('context')
    
<link rel="stylesheet" href="{{ asset('css/style_addproducts.css') }}?v={{ time() }}">
<form action="{{route('add_products')}}" method="POST">
    @csrf
    <div class="container">
        <!-- Sección de subida de imágenes -->
        <div class="upload-section">
            <div class="upload-box">
                <span>📤</span>
            </div>
            <div class="upload-buttons">
                <button>📤</button>
                <button>📤</button>
                <button>📤</button>
                <button>📤</button>
            </div>
        </div>

        <!-- Sección del formulario -->
        <div class="form-section">
            <div class="form-group">
                <label for="title">Añadir Título</label>
                <input type="text" id="title" name="title" placeholder="Escribe">
            </div>
            <div class="form-group">
                <label for="description">Añadir Descripción</label>
                <textarea id="description" name="description" placeholder="Escribe"></textarea>
            </div>
            <div class="form-group">
                <label for="precio">Añadir Precio</label>
                <input type="text" id="precio" name="precio" placeholder="20.00€">
            </div>
            <div class="form-group">
                <label for="category_id">Seleccionar Categoría</label>
                <select id="category_id" name="category_id">
                    <option value="renders">Renders</option>
                    <option value="tutoriales">Tutoriales</option>
                    <option value="blender">Blender</option>
                    <option value="maya">Maya</option>
                    <option value="sketchup">SketchUp</option>
                </select>
            </div>
        </div>

        <!-- Sección de botones -->
        <div class="button-section">
            <button class="cancel-button"><a href="{{ route('my_products.index') }}">Cancelar</a></button>
            <button class="save-button" type="submit">Guardar</button>
        </div>
    </div>
</form>
@endsection