@extends('layouts.plantilla_dashboard')

@section('context')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <div class="top-bar">
        <h1 style="font-weight:bold;">Mi Perfil</h1>
    </div>

    <div class="container" style="max-width: 600px;">
        <div class="form-card" style="margin-top: 2rem;">
            @if (session('success'))
                <div class="alert alert-success"
                    style="color: #fff; background: #4caf50; padding: 10px 20px; border-radius: 6px; margin-bottom: 18px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="text-align:center; margin-bottom:24px;">
                <div class="avatar"
                    style="margin:auto; width:110px; height:110px; border-radius:50%; overflow:hidden; border:2px solid #6366f1; cursor:pointer; background:#f3f4f6;"
                    onclick="document.getElementById('image-input').click()">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="user" class="user-avatar"
                            style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <span
                            style="font-size:3em;line-height:110px; color:#6366f1;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                </div>
                <input type="file" id="image-input" name="profile_image" accept="image/*" style="display:none;">
                <div id="image-upload-msg" style="margin-top:10px;color:#6366f1;"></div>
                <div style="font-size:0.95em; color:#888; margin-top:6px;">Haz clic en la imagen para cambiar tu foto de
                    perfil</div>
            </div>

            <!-- Popup de crop -->
            <div id="crop-popup" class="modal" style="display:none;">
                <div class="modal-content" style="background:#222;">
                    <h2 style="color:#fff;">Editar Imagen de Perfil</h2>
                    <div class="preview-container" style="margin-bottom:18px;">
                        <img id="crop-image" style="max-width:300px;max-height:300px;border-radius:50%;">
                    </div>
                    <button id="crop-button" class="btn btn-primary" style="margin-right:10px;">Recortar y Guardar</button>
                    <button type="button" onclick="closeCropPopup()" class="btn btn-secondary">Cancelar</button>
                </div>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" style="margin-top: 1.5rem;">
                @csrf
                <table class="table-profile" style="width:100%;">
                    <tr>
                        <th style="width: 120px;">Nombre</th>
                        <td>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="form-control" style="width:100%;">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="form-control" style="width:100%;">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                </table>
                <div style="margin-top:24px; text-align:right;">
                    <button type="submit" class="btn btn-primary" style="padding: 8px 24px;">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 3000;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal[style*="display: flex"] {
            display: flex !important;
        }

        .modal-content {
            background: #222;
            padding: 30px 24px;
            border-radius: 10px;
            text-align: center;
            color: #fff;
            box-shadow: 0 4px 24px #000a;
        }

        .preview-container {
            margin-bottom: 18px;
        }
    </style>

    <script>
        let cropper;
        const imageInput = document.getElementById('image-input');
        const cropPopup = document.getElementById('crop-popup');
        const cropImage = document.getElementById('crop-image');
        const cropButton = document.getElementById('crop-button');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                cropImage.src = e.target.result;
                cropPopup.style.display = 'flex';
                setTimeout(() => {
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        background: false,
                        autoCropArea: 1,
                        movable: false,
                        zoomable: true,
                        rotatable: false,
                        scalable: false,
                        responsive: true,
                        cropBoxResizable: true,
                        minContainerWidth: 300,
                        minContainerHeight: 300,
                    });
                }, 100);
            };
            reader.readAsDataURL(file);
        });

        cropButton.addEventListener('click', function() {
            if (!cropper) return;
            cropper.getCroppedCanvas({
                width: 300,
                height: 300,
                imageSmoothingQuality: 'high'
            }).toBlob(function(blob) {
                const formData = new FormData();
                formData.append('profile_image', blob, 'avatar.png');
                fetch('{{ route('admin.profile.image.update') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector('.user-avatar').src = data.image_path + '?t=' +
                                new Date().getTime();
                            document.getElementById('image-upload-msg').innerText =
                                'Imagen actualizada correctamente';
                            closeCropPopup();
                        } else {
                            document.getElementById('image-upload-msg').innerText = 'Error: ' + data
                                .error;
                        }
                    })
                    .catch(() => {
                        document.getElementById('image-upload-msg').innerText =
                            'Error al subir la imagen';
                    });
            }, 'image/png');
        });

        function closeCropPopup() {
            cropPopup.style.display = 'none';
            if (cropper) cropper.destroy();
            cropper = null;
            imageInput.value = '';
        }
    </script>
@endsection
