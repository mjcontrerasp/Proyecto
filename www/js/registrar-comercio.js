document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id_usuario = urlParams.get("id_usuario");
    document.getElementById("id_usuario").value = id_usuario;

    const form = document.getElementById("formComercio");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const datos = new FormData(form);

        try {
            const resp = await fetch("../../index.php?controlador=comercioControlador&metodo=registrar", {
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

            alert("Comercio registrado correctamente");
            window.location.href = "index.html";

        } catch (err) {
            console.error("Error al enviar el formulario:", err);
            alert("Ocurrió un error en la comunicación con el servidor");
        }
    });
});
