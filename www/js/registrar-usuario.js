document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formRegistro");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const datos = new FormData(form);

        try {
            const resp = await fetch("../../index.php?controlador=registroControlador&metodo=registrar", {
                method: "POST",
                body: datos
            });

            const text = await resp.text();
            let json;
            try {
                json = JSON.parse(text);
            } catch (err) {
                console.error("Error parseando JSON:", err, text);
                alert("Ocurrió un error en el servidor");
                return;
            }

            if (!json.ok) {
                alert(json.msg);
                return;
            }

            if (json.tipo === "voluntario") {
                alert("Registrado con éxito");
                window.location.href = "index.html";
            }

            if (json.tipo === "comercio") {
                alert("Usuario registrado, completa los datos del comercio");
                window.location.href = `registro-comercio.html?id_usuario=${json.id_usuario}`;
            }

        } catch (err) {
            console.error("Error al enviar el formulario:", err);
            alert("Ocurrió un error en la comunicación con el servidor");
        }
    });
});
