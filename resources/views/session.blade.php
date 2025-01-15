<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/style_session.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('img/artify2.png') }}" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="features">
                <div class="feature">
                    <div class="icon">📦</div>
                    <div class="feature-content">
                        <h3><strong>Acceso a recursos exclusivos</strong></h3>
                        <p>Explora una colección de texturas, modelos y materiales exclusivos para mejorar tus proyectos.</p>
                    </div>
                </div>
                <div class="feature">
                    <div class="icon">🔧</div>
                    <div class="feature-content">
                        <h3><strong>Soporte técnico experto</strong></h3>
                        <p>Recibe ayuda personalizada para optimizar tus renders y resolver cualquier problema técnico.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="right-section">
            <h1>Iniciar sesión</h1>
            <form>
                <div class="first-line-with-text">
                    <span></span>
                </div>
                <input type="email" placeholder="E-mail" required>
                <input type="password" placeholder="Contraseña" required>
                <a href="#">¿Has olvidado la contraseña?</a>
                <button type="submit">Iniciar Sesión</button>

                <div class="second-line-with-text">
                    <span>¿Eres nuevo?</span>
                </div>

                <p>¿Eres nuevo? <a href="/register">Crear Cuenta</a></p>
                <button class="button-register" type="button"  onclick="window.location.href='/register'" >Crear Cuenta</button>

            </form>
        </div>
    </div>
</body>
</html>