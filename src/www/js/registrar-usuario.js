document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("formRegistro").addEventListener("submit", async (e) => {
        e.preventDefault();

        const datos = new FormData(e.target);

        const resp = await fetch("../../index.php?controlador=registroControlador&metodo=registrar", {
            method: "POST",
            body: datos
        });

        const text = await resp.text();

        // Si el servidor devolvió error
        if (text.startsWith("ERROR")) {
            alert("Hubo un error al registrar el usuario");
            return;
        }

        // La respuesta ahora es: OK:id
        const partes = text.split(":");
        const id_usuario = partes[1];

        // Leemos qué eligió el usuario en el select del formulario
        const tipo = datos.get("tipo_usuario"); 
        // OJO: asegúrate de que en tu <select> el name="tipo_usuario"

        if (tipo === "voluntario") {
            alert("Registrado con éxito");
            window.location.href = "index.html";
        } else if (tipo === "comercio") {
            alert("Usuario creado, completa datos del comercio");
            window.location.href = `registro-comercio.html?id_usuario=${id_usuario}`;
        }
    });
});
