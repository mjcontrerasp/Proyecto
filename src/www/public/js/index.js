/**
 * Script para gestionar el login de usuarios.
 * Escucha el evento submit del formulario y envía los datos al controlador.
 */
document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault(); // Evita que la página se recargue al enviar el formulario

    const datos = new FormData(e.target); // Recoge los campos del formulario (email y password)

    // Enviamos los datos al servidor usando fetch (AJAX)
    const resp = await fetch("../../index.php?controlador=loginControlador&metodo=comprobar", {
        method: "POST",
        body: datos
    });

    // Leemos la respuesta del servidor como texto plano
    const text = await resp.text();

    // Comprobamos si la respuesta indica error
    if (text.startsWith("ERROR")) {
        alert("Correo o contraseña incorrectos");
        return;
    }

    // La respuesta tiene formato OK:rol
    const partes = text.split(":");
    const rol = partes[1];

    // Redirigimos según el rol del usuario
    if (rol === "voluntario") {
        window.location.href = "../../vista/html/voluntario.html";
    } else if (rol === "comercio") {
        window.location.href = "../../vista/html/comercio.html";
    } else {
        alert("Rol desconocido: " + rol);
    }
});
