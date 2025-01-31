<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/style_register.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('img/artify2.png') }}" type="image/x-icon">
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
            <form action="{{route('register')}}" method="POST">

            
                @csrf
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Nombre" required>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <label for="confirm-password">Repetir Contraseña</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Repetir Contraseña" required> 
                <div id="password-error" class="error-message">Las contraseñas no coinciden.</div>



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
                    <a href="/login">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm-password');
        const passwordError = document.getElementById('password-error');
        const registerButton = document.getElementById('register-button');
        const privacyPolicyCheckbox = document.getElementById('privacy-policy');

        // Función para validar si las contraseñas coinciden
        function validatePasswords() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Mostrar el mensaje de error solo si el campo de confirmación no está vacío
            if (confirmPassword !== '' && password !== confirmPassword) {
                passwordError.classList.add('visible'); // Mostrar mensaje de error
                return false; // Las contraseñas no coinciden
            } else {
                passwordError.classList.remove('visible'); // Ocultar mensaje de error
                return true; // Las contraseñas coinciden o el campo está vacío
            }
        }

        // Función para actualizar el estado del botón de registro
        function updateRegisterButton() {
            const passwordsMatch = validatePasswords();
            const privacyPolicyAccepted = privacyPolicyCheckbox.checked;

            // Habilitar el botón solo si las contraseñas coinciden y la política está aceptada
            registerButton.disabled = !(passwordsMatch && privacyPolicyAccepted);
        }

        // Función para validar el formulario antes de enviarlo
        function validateForm() {
            const passwordsMatch = validatePasswords();
            const privacyPolicyAccepted = privacyPolicyCheckbox.checked;

            if (!passwordsMatch) {
                alert('Las contraseñas no coinciden. Por favor, corrígelas.');
                return false; // Detener el envío del formulario
            }

            if (!privacyPolicyAccepted) {
                alert('Debes aceptar la política de privacidad.');
                return false; // Detener el envío del formulario
            }

            return true; // Permitir el envío del formulario
        }

        // Eventos para validar en tiempo real
        confirmPasswordInput.addEventListener('input', updateRegisterButton);
        passwordInput.addEventListener('input', updateRegisterButton);
        privacyPolicyCheckbox.addEventListener('change', updateRegisterButton);
    </script>
</body>
</html>