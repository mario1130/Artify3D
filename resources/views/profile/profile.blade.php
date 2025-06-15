@extends('layouts.plantilla_user_menu')

@section('title', 'Perfil')

@section('context')
    <!-- Cropper.js CSS y JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <style>
        .space {
            margin-left: 15rem;
            margin-right: 30rem;
        }

        h1 {
            margin-top: 30px;
            font-size: 2rem;
            padding-bottom: 5px;
        }

        h2 {
            margin-top: 30px;
            font-size: 1.4em;
            padding-bottom: 5px;
        }

        .perfil {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 20px;
            gap: 20px;
        }

        .perfil-info {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .avatar {
            width: 70px;
            height: 70px;
            background-color: #1e1e1e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            margin-right: 15px;
            position: relative;
            color: #fff;
            overflow: hidden;
            cursor: pointer;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar::after {
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8em;
        }

        .info-text {
            display: flex;
            flex-direction: column;
        }

        .info-text span:first-child {
            font-weight: bold;
        }

        .pedidos {
            text-align: center;
            margin-left: 10px;
            margin-right: 0;
        }

        .pedidos span {
            font-size: 1.5em;
            font-weight: bold;
            display: block;
        }

        .pedidos p {
            margin: 5px 0;
        }

        .btn-ver {
            background-color: #1D7129;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 3px;
            text-decoration: none;
            display: inline-block;
        }

        .nivel {
            display: flex;
            align-items: center;
            justify-content: left;
            margin: 10px 0;
        }

        .nivel span {
            font-size: 0.9em;
            margin: 0 10px;
        }

        .barra-nivel {
            background-color: #333;
            height: 24px;
            /* aumenta la altura si quieres */
            width: 200px;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
        }

        .barra-nivel-progreso {
            background-color: #00c853;
            height: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .barra-nivel-progreso span {
            position: absolute;
            width: 100%;
            left: 0;
            top: 0;
            line-height: 24px;
            /* igual que la altura de la barra */
            color: #fff;
            font-weight: bold;
            font-size: 0.95em;
            text-shadow: 1px 1px 2px #222;
            pointer-events: none;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            margin-top: 15px;
            font-size: 0.95em;
        }

        input,
        select {
            background-color: transparent;
            border: 1px solid #888;
            color: white;
            padding: 8px;
            width: 100%;
            max-width: 250px;
            box-sizing: border-box;
        }

        .password-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 15px;
            margin-right: 0;
            margin-right: 50rem;
        }

        .password-section div {
            flex: 1;
            min-width: 220px;
        }

        .password-input {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            /* right: 10px; */
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 0.9em;
            color: #ccc;
        }

        hr {
            border-color: #333;
            margin: 30px 0;
        }

        /* Cropper popup styles */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #181818;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 1rem;
            z-index: 1000;
            text-align: center;
            color: #fff;
        }

        .popup-content h2 {
            color: white;
            margin-bottom: 1rem;
        }

        .popup-content button {
            padding: 0.5rem 1rem;
            margin: 0.5rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }

        .preview-container {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            overflow: hidden;
            margin: auto;
            border: 2px solid white;
            box-shadow: 0 0 5px white;
        }

        #crop-image {
            max-width: 100%;
            display: block;
        }

        .cropper-crop-box,
        .cropper-view-box {
            border-radius: 50% !important;
            width: 300px !important;
            height: 300px !important;
            position: absolute;
            top: 0%;
            left: 0%;
        }

        .cropper-view-box {
            outline: none !important;
        }

        .cropper-face {
            background-color: transparent !important;
        }

        @media (max-width: 1200px) {
            .space {
                margin-left: 2rem;
                margin-right: 2rem;
            }
        }

        @media (max-width: 900px) {
            .space {
                margin-left: 0.5rem;
                margin-right: 0.5rem;
                padding: 0 5px;
            }

            .barra-nivel {
                width: 120px;
            }
        }

        @media (max-width: 700px) {
            .perfil {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .pedidos {
                margin-left: 0;
                margin-right: 0;
                width: 100%;
                margin-top: 10px;
            }

            .barra-nivel {
                width: 90px;
            }

            .password-section {
                flex-direction: column;
                gap: 10px;
            }

            .preview-container,
            .cropper-crop-box,
            .cropper-view-box {
                width: 200px !important;
                height: 200px !important;
                min-width: 200px !important;
                min-height: 200px !important;
                max-width: 200px !important;
                max-height: 200px !important;
            }
        }

        @media (max-width: 500px) {
            .space {
                margin-left: 0.5rem;
                margin-right: 0;
                padding: 0 2px;
            }

            h1,
            h2 {
                font-size: 1.2em;
            }

            .avatar {
                width: 50px;
                height: 50px;
                font-size: 1em;
            }

            .barra-nivel {
                width: 60px;
            }
        }
    </style>
    @php
        // Calcula el total de pedidos no devueltos (como ya tienes)
        $orderItems = \App\Models\Order_items::whereHas('order', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();
        $orderItemsNoDevueltos = $orderItems->filter(function ($item) {
            return !\App\Models\Returns::where('order_item_id', $item->id)->exists();
        });
        $totalPedidos = $orderItemsNoDevueltos->count();

        // Lógica de nivel y porcentaje
        $nivel = 1;
        $porcentaje = 0;
        $pedidosRestantes = $totalPedidos;
        $pedidosPorNivel = [5, 10, 20, 40, 80]; // Puedes ajustar estos valores

        foreach ($pedidosPorNivel as $i => $pedidosParaEsteNivel) {
            if ($pedidosRestantes >= $pedidosParaEsteNivel) {
                $nivel++;
                $pedidosRestantes -= $pedidosParaEsteNivel;
            } else {
                $porcentaje = ($pedidosRestantes / $pedidosParaEsteNivel) * 100;
                break;
            }
        }
        if ($nivel > count($pedidosPorNivel)) {
            $nivel = count($pedidosPorNivel) + 1;
            $porcentaje = 100;
        }
    @endphp
    @php
        $levelNames = [
            1 => 'Novato',
            11 => 'Aprendiz',
            21 => 'Aficionado',
            31 => 'Avanzado',
            41 => 'Experto',
            51 => 'Pro',
            61 => 'Élite',
            71 => 'Leyenda',
            81 => 'Mítico',
            91 => 'Master',
            101 => 'Master', // Para niveles superiores a 100
        ];

        // Calcula el nombre actual y el siguiente a desbloquear
        $currentLevelName = '';
        $nextLevelName = '';
        foreach ($levelNames as $minLevel => $name) {
            if ($nivel >= $minLevel) {
                $currentLevelName = $name;
            }
            if ($nivel < $minLevel && $nextLevelName == '') {
                $nextLevelName = $name;
            }
        }
        if ($nextLevelName == '') {
            $nextLevelName = $levelNames[101];
        }
    @endphp
    <div class="space">

        <h1>Mis Datos</h1>

        <div class="perfil">
            <div class="perfil-info">
                <div class="avatar" onclick="document.getElementById('image-input').click()">
                    @if (auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="user" class="user-avatar">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="info-text">
                    <span>{{ auth()->user()->name }}</span>
                    <span style="color:#1D7129; font-weight:bold;">Nivel {{ $nivel }}</span>
                    <span>{{ auth()->user()->email }}</span>
                </div>
            </div>
            <div class="pedidos">


                <span>{{ $totalPedidos }}</span>
                <p>Pedidos</p>
                <a href="{{ route('pedidos.index') }}" class="btn-ver">Ver Pedidos</a>
            </div>
        </div>

        <div class="nivel">
            <span>{{ $currentLevelName }}</span>
            <div class="barra-nivel">
                <div class="barra-nivel-progreso" style="width:{{ $porcentaje }}%">
                    <span
                        style="color:white; font-size:0.9em; position:absolute; left:50%; top:50%; transform:translate(-50%,-50%); width:100%; text-align:center;">
                        {{ round($porcentaje) }}%
                    </span>
                </div>
            </div>
            <span>{{ $nextLevelName }}</span>
        </div>

        <hr>

        <h2>Datos de Mi Cuenta</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <label for="nick">Nick</label>
            <input type="text" id="nick" name="name" value="{{ auth()->user()->name }}">

            <h2>Contraseña</h2>
            <div class="password-section">
                <div>
                    <label for="antigua">Antigua Contraseña</label>
                    <div class="password-input">
                        <input type="password" id="antigua" name="old_password">
                        <span class="toggle-password" data-target="antigua">👁️</span>
                    </div>
                </div>
                <div>
                    <label for="nueva">Nueva Contraseña</label>
                    <div class="password-input">
                        <input type="password" id="nueva" name="new_password">
                        <span class="toggle-password" data-target="nueva">👁️</span>
                    </div>
                </div>
                <div>
                    <label for="repetir">Repetir Contraseña</label>
                    <div class="password-input">
                        <input type="password" id="repetir" name="new_password_confirmation">
                        <span class="toggle-password" data-target="repetir">👁️</span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-ver" style="margin-top:20px;">Guardar Cambios</button>
        </form>

        <!-- input oculto para subir imagen -->
        <input type="file" id="image-input" name="profile_image" accept="image/*" style="display:none;">

        <!-- popup de crop -->
        <div id="crop-popup" class="popup" style="display: none;">
            <div class="popup-content">
                <h2>Editar Imagen de Perfil</h2>
                <div class="preview-container">
                    <img id="crop-image" alt="preview">
                </div>
                <button id="crop-button">Recortar y Guardar</button>
                <button type="button" onclick="closeCropPopup()">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', () => {
                const inputId = icon.getAttribute('data-target');
                const input = document.getElementById(inputId);
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = '🙈';
                } else {
                    input.type = 'password';
                    icon.textContent = '👁️';
                }
            });
        });

        // Funcionalidad cropper
        let cropper;
        document.getElementById('image-input').addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const cropImage = document.getElementById('crop-image');
                cropImage.onload = function() {
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        movable: true,
                        zoomable: true,
                        rotatable: false,
                        scalable: false,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        background: false,
                        guides: false,
                        center: false,
                        highlight: false,
                        modal: false,
                    });
                };
                cropImage.src = e.target.result;
                document.getElementById('crop-popup').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        function closeCropPopup() {
            document.getElementById('crop-popup').style.display = 'none';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }
        document.getElementById('crop-button').addEventListener('click', function() {
            if (!cropper) return;
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            const circularCanvas = document.createElement('canvas');
            circularCanvas.width = 300;
            circularCanvas.height = 300;
            const ctx = circularCanvas.getContext('2d');
            ctx.beginPath();
            ctx.arc(150, 150, 150, 0, Math.PI * 2);
            ctx.closePath();
            ctx.clip();
            ctx.drawImage(canvas, 0, 0, 300, 300);
            circularCanvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('profile_image', blob);
                fetch('{{ route('profile.image.update') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Actualizar la imagen en tiempo real en el perfil
                            const userAvatar = document.querySelector('.user-avatar');
                            userAvatar.src = data.image_path + '?t=' + new Date().getTime();
                            closeCropPopup();
                            window.location.reload();
                        } else {
                            alert('Error al actualizar la imagen');
                        }
                    })
                    .catch(error => {
                        alert('Error al subir la imagen');
                    });
            });
        });
    </script>
@endsection
