document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formComercio");
    if (!form) return;

    const id_usuario = new URLSearchParams(window.location.search).get("id_usuario");
    if (id_usuario) {
        document.getElementById("id_usuario").value = id_usuario;
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const datos = new FormData(form);

        try {
            const resp = await fetch("/api/comercios", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: datos
            });

            const json = await resp.json();

            if (!json.ok) {
                alert(json.msg || "Error al registrar comercio");
                return;
            }

            alert("Comercio registrado correctamente");
            window.location.href = "/login";

        } catch (err) {
            console.error(err);
            alert("Error de conexión con el servidor");
        }
    });
});
