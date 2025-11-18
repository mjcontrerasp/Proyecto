document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("formRegistro").addEventListener("submit", async (e) => {
        e.preventDefault();

        const datos = new FormData(e.target);

        const resp = await fetch("../../index.php?controlador=registroControlador&metodo=registrar", {
            method: "POST",
            body: datos
        });

        const text = await resp.text();

        if (text.startsWith("ERROR")) {
            alert(text);
            return;
        }

        const partes = text.split(":"); 
        const tipo = partes[1];
        const id   = partes[2];

        if (tipo === "voluntario") {
            alert("Registrado con éxito");
            window.location.href = "index.html";
        } else if (tipo === "comercio") {
            alert("Usuario creado, completa datos del comercio");
            window.location.href = `registro-comercio.html?id_usuario=${id}`;
        }
    });
});
