document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formComercio");
    const id_usuario = new URLSearchParams(window.location.search).get("id_usuario");
    document.getElementById("id_usuario").value = id_usuario;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const datos = new FormData(form);

        try {
            const resp = await fetch("../../index.php?controlador=comercioControlador&metodo=registrar", {
                method: "POST",
                body: datos
            });

            const json = await resp.json();

            if (!json.ok) {
                alert(json.msg);
                return;
            }

            alert("Comercio registrado correctamente");
            window.location.href = "index.html";

        } catch (err) {
            console.error("Error al registrar comercio:", err);
            alert("Ocurrió un error en la comunicación con el servidor");
        }
    });
});
