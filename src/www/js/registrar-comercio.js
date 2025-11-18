/**
 * Script para registrar un comercio.
 * Toma los datos del formulario, los envía al servidor y redirige al usuario.
 */
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formComercio");

    // Recupera el id del usuario de la URL y lo pone en el input oculto
    const id_usuario = new URLSearchParams(window.location.search).get("id_usuario");
    document.getElementById("id_usuario").value = id_usuario;

    /**
     * Maneja el envío del formulario de comercio.
     * @param {Event} e Evento submit
     */
    form.addEventListener("submit", async (e) => {
        e.preventDefault(); // Evita que el formulario recargue la página

        const datos = new FormData(form); // Recoge todos los campos del formulario

        try {
            // Enviamos los datos al controlador PHP usando fetch
            const resp = await fetch("../../index.php?controlador=comercioControlador&metodo=registrar", {
                method: "POST",
                body: datos
            });

            // La respuesta del servidor viene en JSON
            const json = await resp.json();

            if (!json.ok) {
                alert(json.msg); // Si hay error, lo mostramos
                return;
            }

            // Éxito → redirige al login
            alert("Comercio registrado correctamente");
            window.location.href = "index.html";

        } catch (err) {
            console.error("Error al registrar comercio:", err);
            alert("Ocurrió un error al conectar con el servidor");
        }
    });
});