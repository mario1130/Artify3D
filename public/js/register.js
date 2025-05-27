const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('password_confirmation');
const passwordError = document.getElementById('password-error');
const registerButton = document.getElementById('register-button');
const privacyPolicyCheckbox = document.getElementById('privacy-policy');
const passwordLengthError = document.getElementById('password-length-error'); // Nuevo mensaje de error

// Función para validar si las contraseñas coinciden
function validatePasswords() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (confirmPassword !== '' && password !== confirmPassword) {
        passwordError.classList.add('visible'); // Mostrar mensaje de error
        return false;
    } else {
        passwordError.classList.remove('visible'); // Ocultar mensaje de error
        return true;
    }
}

// Función para validar la longitud de la contraseña
function validatePasswordLength() {
    const password = passwordInput.value;

    if (password.length < 8) {
        passwordLengthError.classList.add('visible'); // Mostrar mensaje de error
        return false;
    } else {
        passwordLengthError.classList.remove('visible'); // Ocultar mensaje de error
        return true;
    }
}

// Función para actualizar el estado del botón de registro
function updateRegisterButton() {
    const passwordsMatch = validatePasswords();
    const passwordValidLength = validatePasswordLength();
    const privacyPolicyAccepted = privacyPolicyCheckbox.checked;

    // Habilitar el botón solo si las contraseñas coinciden, la longitud es válida y la política está aceptada
    registerButton.disabled = !(passwordsMatch && passwordValidLength && privacyPolicyAccepted);
}

// Función para validar el formulario antes de enviarlo
function validateForm() {
    const passwordsMatch = validatePasswords();
    const passwordValidLength = validatePasswordLength();
    const privacyPolicyAccepted = privacyPolicyCheckbox.checked;

    if (!passwordValidLength) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false;
    }

    if (!passwordsMatch) {
        alert('Las contraseñas no coinciden. Por favor, corrígelas.');
        return false;
    }

    if (!privacyPolicyAccepted) {
        alert('Debes aceptar la política de privacidad.');
        return false;
    }

    return true;
}

// Eventos para validar en tiempo real
confirmPasswordInput.addEventListener('input', updateRegisterButton);
passwordInput.addEventListener('input', updateRegisterButton);
privacyPolicyCheckbox.addEventListener('change', updateRegisterButton);