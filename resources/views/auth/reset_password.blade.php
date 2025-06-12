{{-- filepath: resources/views/auth/reset_password.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('img/artify2.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon_artify.png') }}" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <div class="features">
                <div class="feature">
                    <div class="icon">📦</div>
                    <div class="feature-content">
                        <h3><strong>Acceso a recursos exclusivos</strong></h3>
                        <p>Explora una colección de texturas, modelos y materiales exclusivos para mejorar tus
                            proyectos.</p>
                    </div>
                </div>
                <div class="feature">
                    <div class="icon">🔧</div>
                    <div class="feature-content">
                        <h3><strong>Soporte técnico experto</strong></h3>
                        <p>Recibe ayuda personalizada para optimizar tus renders y resolver cualquier problema técnico.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="logo">
            <a href="/"><img src="{{ asset('img/Logo.png') }}" alt="Logo"></a>
        </div>
        <div class="divider"></div>

        <div class="right-section">
            <h1>Recuperar contraseña</h1>
            <form action="{{ route('password.email') }}" method="POST">
                <p class="form-description">Introduce el e-mail asociado a tu cuenta de Artify3D y te enviaremos un
                    enlace para restaurar tu contraseña.</p>
                @csrf
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <button type="submit">Recuperar Contraseña</button>
                <div class="second-line-with-text">
                    <span>¿Recuerdas tu contraseña?</span>
                </div>
                <button class="button-register" type="button"
                    onclick="window.location.href='{{ route('login') }}'">Iniciar Sesión</button>
            </form>

        </div>
    </div>
</body>

</html>
