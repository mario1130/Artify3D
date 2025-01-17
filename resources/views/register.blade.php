<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/style_register.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('img/artify2.png') }}" type="image/x-icon">

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
            <form>
                <label for="name">Nombre</label>
                <input type="text" id="name" placeholder="Nombre" required>
                <label for="email">E-mail</label>
                <input type="email" id="email" placeholder="E-mail" required>
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Contraseña" required>
                <label for="confirm-password">Repetir Contraseña</label>
                <input type="password" id="confirm-password" placeholder="Repetir Contraseña" required>
                <div class="checkbox-group">
                    <input type="checkbox" id="privacy-policy" required>
                    <label for="privacy-policy">He leído y acepto la <a href="#">política de privacidad</a></label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="offers">
                    <label for="offers">Recibir descuentos exclusivos, novedades y tendencias por e-mail.</label>
                </div>
                <button type="submit">Crear Cuenta</button>
                <div class="secondary-action">
                    <a href="/session">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>