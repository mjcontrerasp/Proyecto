// Mostrar / ocultar contraseña
document.querySelector(".toggle-password").addEventListener("click", () => {
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
});

// Validación básica del formulario
document.getElementById("formRegistro").addEventListener("submit", (e) => {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const email = document.getElementById("email");
    const pass = document.getElementById("password");

    let valido = true;
    
document.getElementById("btnContinuar").addEventListener("click", () => {
    const rol = document.getElementById("rol").value;
    const error = document.getElementById("errorRol");

    error.textContent = ""; // limpia

    if (rol === "") {
        error.textContent = "Debes seleccionar una opción.";
        return;
    }

    // Redirección según el rol elegido
    if (rol === "comercio") {
        window.location.href = "registro-comercio.html";
    } else if (rol === "voluntario") {
        window.location.href = "registro-voluntario.html";
    }
});

    // Limpia errores
    document.querySelectorAll(".error").forEach(e => e.textContent = "");

    if (nombre.value.trim() === "") {
        nombre.nextElementSibling.textContent = "Introduce tu nombre.";
        valido = false;
    }

    if (!email.value.includes("@")) {
        email.nextElementSibling.textContent = "Email no válido.";
        valido = false;
    }

    if (pass.value.length < 6) {
        pass.nextElementSibling.textContent = "La contraseña es demasiado corta.";
        valido = false;
    }

    if (valido) {
        this.submit();
    }
});
