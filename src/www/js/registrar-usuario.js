/**
 * Script para gestionar el registro de usuarios.
 * Escucha el evento submit del formulario y envía los datos al controlador.
 */
document.addEventListener("DOMContentLoaded", () => {

    /**
     * Maneja el envío del formulario de registro.
     * @param {Event} e Evento de submit
     */
    document.getElementById("formRegistro").addEventListener("submit", async (e) => {
        e.preventDefault(); // Evita el envío normal del formulario

        const datos = new FormData(e.target); // Recoge todos los campos del formulario

    // Enviamos los datos al servidor usando fetch (AJAX)
    // Esto permite que el servidor reciba los datos sin recargar la página
    const resp = await fetch("../../index.php?controlador=registroControlador&metodo=registrar", {
    method: "POST",
    body: datos
});

    // Leemos la respuesta del servidor como texto
    const text = await resp.text();

    // Comprobamos si el servidor nos devolvió un error
    if (text.startsWith("ERROR")) {
        alert("Correo o contraseña incorrectos"); // Mostramos alerta si login falla
        return; // Salimos de la función
    }
        // Separar la respuesta en partes: OK:rol:id
        const partes = text.split(":"); 
        const tipo = partes[1];
        const id   = partes[2];

        // Redirección según tipo de usuario
        if (tipo === "voluntario") {
            alert("Registrado con éxito");
            window.location.href = "index.html";
        } else if (tipo === "comercio") {
            alert("Usuario creado, completa datos del comercio");
            window.location.href = `registro-comercio.html?id_usuario=${id}`;
        }
    });
});