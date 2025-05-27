<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/style_register.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('img/artify2.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon_artify.png') }}" type="image/x-icon">
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
            display: none; /* Ocultar inicialmente */
        }
        .error-message.visible {
            display: block; /* Mostrar cuando sea necesario */
        }
        button:disabled {
            background-color: #ccc; /* Estilo para botón deshabilitado */
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="features">
                <div class="feature">
                    <div class="icon">📦</div>
                    <p><strong>Acceso a recursos exclusivos</strong><br>
                        Explora una colección de texturas, modelos y materiales exclusivos para mejorar tus proyectos.
                    </p>
                </div>
                <div class="feature">
                    <div class="icon">🔧</div>
                    <p><strong>Soporte técnico experto</strong><br>
                        Recibe ayuda personalizada para optimizar tus renders y resolver cualquier problema técnico.
                    </p>
                </div>
            </div>
        </div>
        <div class="logo">
            <a href="/"><img src="img/Logo.png" alt="Logo"></a>
        </div>
        <div class="divider"></div>
        <div class="right-section">
            
            <h1>Crear cuenta</h1>
            <form action="{{route('register')}}" method="POST" onsubmit="return validateForm()">

            
                @csrf
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Nombre" required>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <label for="password_confirmation">Repetir Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repetir Contraseña" required> 
                <div id="password-error" class="error-message">Las contraseñas no coinciden.</div>
                <p id="password-length-error" class="error-message">La contraseña debe tener al menos 8 caracteres.</p>



                <div class="checkbox-group">
                    <input type="checkbox" id="privacy-policy" name="privacy-policy" required>
                    <label for="privacy-policy">He leído y acepto la <a href="#">política de privacidad</a></label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="offers">
                    <label for="offers">Recibir descuentos exclusivos, novedades y tendencias por e-mail.</label>
                </div>
               
                
                <button type="submit" id="register-button">Crear Cuenta</button>

                <button class="button-register" type="button" onclick="window.location.href='{{ route('login') }}'">Iniciar Sesion</button>
                
            </form>
        </div>
    </div>

    <script src="{{ asset('js/register.js') }}"></script>

</body>
</html>