document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const datos = new FormData(e.target);

    const resp = await fetch("../../index.php?controlador=loginControlador&metodo=comprobar", {
        method: "POST",
        body: datos
    });

    const text = await resp.text();

    if (text.startsWith("ERROR")) {
        alert("Correo o contraseña incorrectos");
        return;
    }

    const partes = text.split(":");
    const rol = partes[1];

    if (rol === "voluntario") {
        window.location.href = "../../vista/html/voluntario.html";
    } else if (rol === "comercio") {
        window.location.href = "../../vista/html/comercio.html";
    } else {
        alert("Rol desconocido: " + rol);
    }
});
