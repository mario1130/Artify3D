@extends('layouts.plantilla')

@section('body-class', 'centered-body')

@section('context')
    <link rel="stylesheet" href="{{ asset('css/style_addproducts.css') }}?v={{ time() }}">
    <form id="editProductForm" action="{{ route('products.update', $product->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="upload-section">
                <div class="upload-box main-photo">
                    <label for="main_image">
                        <img id="mainImagePreview"
                            src="{{ $product->mainPhoto ? asset($product->mainPhoto->photo_url) : asset('img/Default_product.png') }}"
                            alt="{{ $product->name }}">
                    </label>
                    <input type="file" id="main_image" name="main_image" accept="image/*" style="display: none;"
                        onchange="previewMainImage(event)">
                </div>

                <!-- Fotos secundarias -->
                <div class="upload-buttons">
                    @php
                        $maxSecondaryImages = 4;
                        $secondaryImages = $product->secondaryPhotos->pluck('photo_url')->toArray();
                    @endphp
                    @for ($i = 0; $i < $maxSecondaryImages; $i++)
                        <div class="secondary-photo">
                            <label for="secondary_image_{{ $i }}">
                                <img id="secondaryImagePreview_{{ $i }}"
                                    src="{{ isset($secondaryImages[$i]) && $secondaryImages[$i] ? asset($secondaryImages[$i]) : asset('img/Default_product.png') }}"
                                    alt="Foto secundaria {{ $i }}">
                            </label>
                            <input type="file" id="secondary_image_{{ $i }}" name="secondary_images[]"
                                accept="image/*" style="display: none;"
                                onchange="previewSecondaryImage(event, {{ $i }})">
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Sección del formulario -->
            <div class="form-section">
                <div class="form-group">
                    <label for="name">Editar Título</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" placeholder="Escribe">
                    <small class="error-message" style="color: red; display: none;">Este campo es obligatorio.</small>
                </div>
                <div class="form-group">
                    <label for="description">Editar Descripción</label>
                    <textarea id="description" name="description" placeholder="Escribe">{{ $product->description }}</textarea>
                    <small class="error-message" style="color: red; display: none;">Este campo es obligatorio.</small>
                </div>
                <div class="form-group">
                    <label for="precio">Editar Precio</label>
                    <input type="text" id="precio" name="precio" value="{{ $product->precio }}"
                        placeholder="20.00€">
                    <small class="error-message" style="color: red; display: none;">Este campo es obligatorio.</small>
                </div>
                <div class="form-group">
                    <label for="category_id">Seleccionar Categoría</label>
                    <select id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="download_url">URL de descarga (opcional)</label>
                    <input type="url" id="download_url" name="download_url" value="{{ $product->download_url }}"
                        placeholder="https://tusitio.com/archivo.zip">
                </div>
            </div>

            <!-- Sección de botones -->
            <div class="button-section">
                <button class="cancel-button"><a href="{{ route('my_products.index') }}">Cancelar</a></button>
                <button class="save-button" type="submit">Guardar Cambios</button>
            </div>
        </div>
    </form>
    <script>
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Validar el campo de título
            const name = document.getElementById('name');
            const nameError = name.nextElementSibling;
            if (!name.value.trim()) {
                nameError.style.display = 'block';
                isValid = false;
            } else {
                nameError.style.display = 'none';
            }

            // Validar el campo de descripción
            const description = document.getElementById('description');
            const descriptionError = description.nextElementSibling;
            if (!description.value.trim()) {
                descriptionError.style.display = 'block';
                isValid = false;
            } else {
                descriptionError.style.display = 'none';
            }

            // Validar el campo de precio
            const precio = document.getElementById('precio');
            const precioError = precio.nextElementSibling;
            if (!precio.value.trim() || isNaN(precio.value) || parseFloat(precio.value) <= 0) {
                precioError.style.display = 'block';
                isValid = false;
            } else {
                precioError.style.display = 'none';
            }

            // Validar la categoría
            const category = document.getElementById('category_id');
            const categoryError = category.nextElementSibling;
            if (!category.value) {
                categoryError.style.display = 'block';
                isValid = false;
            } else {
                categoryError.style.display = 'none';
            }

            // Si hay errores, evitar el envío del formulario
            if (!isValid) {
                event.preventDefault();
            }
        });
        const defaultImage = "{{ asset('img/Default_product.png') }}";

        // Vista previa de la foto principal
        function previewMainImage(event) {
            const mainImagePreview = document.getElementById('mainImagePreview');
            mainImagePreview.src = URL.createObjectURL(event.target.files[0]);
        }

        // Vista previa de las fotos secundarias
        function previewSecondaryImage(event, index) {
            const secondaryImagePreview = document.getElementById(`secondaryImagePreview_${index}`);
            secondaryImagePreview.src = URL.createObjectURL(event.target.files[0]);
        }

        // Validación del formulario
        document.getElementById('editProductForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Validar el campo de título
            const name = document.getElementById('name');
            const nameError = name.nextElementSibling;
            if (!name.value.trim()) {
                nameError.style.display = 'block';
                isValid = false;
            } else {
                nameError.style.display = 'none';
            }

            // Validar el campo de descripción
            const description = document.getElementById('description');
            const descriptionError = description.nextElementSibling;
            if (!description.value.trim()) {
                descriptionError.style.display = 'block';
                isValid = false;
            } else {
                descriptionError.style.display = 'none';
            }

            // Validar el campo de precio
            const precio = document.getElementById('precio');
            const precioError = precio.nextElementSibling;
            if (!precio.value.trim() || isNaN(precio.value) || parseFloat(precio.value) <= 0) {
                precioError.style.display = 'block';
                isValid = false;
            } else {
                precioError.style.display = 'none';
            }

            // Validar la categoría
            const category = document.getElementById('category_id');
            const categoryError = category.nextElementSibling;
            if (!category.value) {
                categoryError.style.display = 'block';
                isValid = false;
            } else {
                categoryError.style.display = 'none';
            }

            // Si hay errores, evitar el envío del formulario
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endsection
