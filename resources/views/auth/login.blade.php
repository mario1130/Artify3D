<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('img/artify2.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon_artify.png') }}" type="image/x-icon">
</head>

<body>
    <style>
        .blocked-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #e11d48;
            color: #fff;
            padding: 32px 48px;
            border-radius: 12px;
            font-size: 1.3rem;
            z-index: 9999;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            text-align: center;
            min-width: 300px;
        }

        .close-btn {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 2rem;
            position: absolute;
            top: 8px;
            right: 16px;
            cursor: pointer;
        }
    </style>


    @if ($errors->any())
        <div class="blocked-popup">
            <p>{{ $errors->first('email') }}</p>
            <button onclick="this.parentElement.style.display='none'" class="close-btn">&times;</button>
        </div>
    @endif
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
            <h1>Iniciar sesión</h1>

            <!-- Mostrar mensaje de error si existe -->
            @if (session('error'))
                <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="first-line-with-text">
                    <span></span>
                </div>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <a href="{{ route('password.request') }}">¿Has olvidado la contraseña?</a>
                <button type="submit">Iniciar Sesión</button>

                <div class="second-line-with-text">
                    <span>¿Eres nuevo?</span>
                </div>

                <button class="button-register" type="button"
                    onclick="window.location.href='{{ route('register') }}'">Crear Cuenta</button>
            </form>
        </div>
    </div>
</body>

</html>
