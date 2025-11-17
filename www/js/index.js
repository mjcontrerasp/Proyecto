document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const pass = document.getElementById("password").value;

    let datos = new FormData();
    datos.append("email", email);
    datos.append("password", pass);

    const resp = await fetch("../../index.php?controlador=loginControlador&metodo=comprobar", {
        method: "POST",
        body: datos
    });

    const json = await resp.json();

    if (!json.ok) {
        alert(json.msg);
        return;
    }

    // Redirección según rol
    if (json.rol === "voluntario") {
        window.location.href = "../../vista/html/voluntario.html";
    } 
    else if (json.rol === "comercio") {
        window.location.href = "../../vista/html/comercio.html";
    } 
    else {
        alert("Rol desconocido: " + json.rol);
    }
});
