// Toggle mostrar/ocultar contraseña
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', () => {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
});

// Validación simple y feedback
const loginForm = document.getElementById('loginForm');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');

loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    let valid = true;

    emailError.textContent = '';
    passwordError.textContent = '';

    if (!loginForm.email.value) {
        emailError.textContent = 'El correo es obligatorio';
        valid = false;
    }

    if (!loginForm.password.value) {
        passwordError.textContent = 'La contraseña es obligatoria';
        valid = false;
    }

    if (valid) {
        // Aquí se integraría la llamada al backend
        console.log('Formulario válido. Enviar datos al backend...');
    }
});
