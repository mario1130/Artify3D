<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
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
            <h1>Restablecer contraseña</h1>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                <p class="form-description">Introduce tu nueva contraseña para tu cuenta de Artify3D.</p>
                @csrf
                <input type="hidden" name="token" value="{{ $token ?? '' }}">
                <input type="hidden" name="email" value="{{ request('email') }}">

                <label for="password">Nueva contraseña</label>
                <input type="password" id="password" name="password" placeholder="Nueva contraseña" required>

                <label for="password_confirmation">Repetir contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Repetir contraseña" required>

                <button type="submit">Cambiar Contraseña</button>
                <div class="second-line-with-text">
                    <span>¿Ya tienes cuenta?</span>
                </div>
                <button class="button-register" type="button"
                    onclick="window.location.href='{{ route('login') }}'">Iniciar Sesión</button>
            </form>

        </div>
    </div>
</body>

</html>
