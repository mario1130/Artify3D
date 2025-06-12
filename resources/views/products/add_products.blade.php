@extends('layouts.plantilla')

@section('body-class', 'centered-body')

@section('context')
    <link rel="stylesheet" href="{{ asset('css/style_addproducts.css') }}?v={{ time() }}">
    <form id="addProductForm" action="{{ route('add_products') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <!-- Sección de subida de imágenes -->
            <div class="upload-section">
                <!-- Foto principal -->
                <div class="upload-box main-photo">
                    <label for="main_image">
                        <img id="mainImagePreview" src="{{ asset('img/Default_product.png') }}" alt="Foto principal">
                    </label>
                    <input type="file" id="main_image" name="main_image" accept="image/*" style="display: none;"
                        onchange="previewMainImage(event)">
                </div>

                <!-- Fotos secundarias -->
                <div class="upload-buttons">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="secondary-photo">
                            <label for="secondary_image_{{ $i }}">
                                <img id="secondaryImagePreview_{{ $i }}"
                                    src="{{ asset('img/Default_product.png') }}" alt="Foto secundaria {{ $i }}">
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
                    <label for="name">Añadir Título</label>
                    <input type="text" id="name" name="name" placeholder="Escribe">
                    <small class="error-message" style="color: red; display: none;">Este campo es obligatorio.</small>

                </div>
                <div class="form-group">
                    <label for="description">Añadir Descripción</label>
                    <textarea id="description" name="description" placeholder="Escribe"></textarea>
                    <small class="error-message" style="color: red; display: none;">Este campo es obligatorio.</small>
                </div>
                <div class="form-group">
                    <label for="precio">Añadir Precio</label>
                    <input type="text" id="precio" name="precio" placeholder="20.00€">
                    <small class="error-message" style="color: red; display: none;">Este campo es obligatorio.</small>
                </div>
                <div class="form-group">
                    <label for="category_id">Seleccionar Categoría</label>
                    <select id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="download_url">URL de descarga (opcional)</label>
                    <input type="url" id="download_url" name="download_url"
                        placeholder="https://tusitio.com/archivo.zip">
                </div>
            </div>

            <!-- Sección de botones -->
            <div class="button-section">
                <button class="cancel-button"><a href="{{ route('my_products.index') }}">Cancelar</a></button>
                <button class="save-button" type="submit">Guardar</button>
            </div>
        </div>
    </form>
    <script>
        const defaultImage = "{{ asset('img/Default_product.png') }}";

        // Vista previa de la foto principal
        function previewMainImage(event) {
            const mainImagePreview = document.getElementById('mainImagePreview');
            const deleteMainImageButton = document.getElementById('deleteMainImageButton');
            mainImagePreview.src = URL.createObjectURL(event.target.files[0]);
            deleteMainImageButton.style.display = 'block'; // Mostrar el botón de eliminar
        }

        // Eliminar la foto principal
        function removeMainImage() {
            const mainImagePreview = document.getElementById('mainImagePreview');
            const mainImageInput = document.getElementById('main_image');
            const deleteMainImageButton = document.getElementById('deleteMainImageButton');
            mainImagePreview.src = defaultImage; // Restaurar la imagen por defecto
            mainImageInput.value = ""; // Limpiar el campo de archivo
            deleteMainImageButton.style.display = 'none'; // Ocultar el botón de eliminar
        }

        // Vista previa de las fotos secundarias
        function previewSecondaryImage(event, index) {
            const secondaryImagePreview = document.getElementById(`secondaryImagePreview_${index}`);
            const deleteSecondaryImageButton = document.getElementById(`deleteSecondaryImageButton_${index}`);
            secondaryImagePreview.src = URL.createObjectURL(event.target.files[0]);
            deleteSecondaryImageButton.style.display = 'block'; // Mostrar el botón de eliminar
        }

        // Eliminar una foto secundaria
        function removeSecondaryImage(index) {
            const secondaryImagePreview = document.getElementById(`secondaryImagePreview_${index}`);
            const secondaryImageInput = document.getElementById(`secondary_image_${index}`);
            const deleteSecondaryImageButton = document.getElementById(`deleteSecondaryImageButton_${index}`);
            secondaryImagePreview.src = defaultImage; // Restaurar la imagen por defecto
            secondaryImageInput.value = ""; // Limpiar el campo de archivo
            deleteSecondaryImageButton.style.display = 'none'; // Ocultar el botón de eliminar
        }

        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            // Obtener los valores de los campos
            const name = document.getElementById('name').value.trim();
            const description = document.getElementById('description').value.trim();
            const precio = document.getElementById('precio').value.trim();
            const category = document.getElementById('category_id').value;

            // Verificar si los campos están vacíos
            if (!name || !description || !precio || !category) {
                event.preventDefault(); // Evitar que el formulario se envíe
                alert('Por favor, rellena todos los campos antes de guardar el producto.');
                return;
            }

            // Validar que el precio sea un número válido
            if (isNaN(precio) || parseFloat(precio) <= 0) {
                event.preventDefault(); // Evitar que el formulario se envíe
                alert('Por favor, introduce un precio válido.');
                return;
            }
        });
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
    </script>
@endsection
