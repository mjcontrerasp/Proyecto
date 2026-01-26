document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formRegistro");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const datos = new FormData(form);

        try {
            const resp = await fetch("/registro", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: datos
            });

            const json = await resp.json();

            if (!json.ok) {
                alert(json.msg || "Error al registrar usuario");
                return;
            }

            if (json.tipo === "voluntario") {
                alert("Registrado con éxito");
                window.location.href = "/login";
            }

            if (json.tipo === "comercio") {
                alert("Usuario creado, completa datos del comercio");
                window.location.href = `/registro-comercio?id_usuario=${json.id}`;
            }

        } catch (err) {
            console.error(err);
            alert("Error de conexión con el servidor");
        }
    });
});
