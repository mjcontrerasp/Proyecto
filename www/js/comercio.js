document.getElementById("formComercio").addEventListener("submit", (e) => {
    e.preventDefault();
    
    let valido = true;

    document.querySelectorAll(".error").forEach(e => e.textContent = "");

    const nombre = document.getElementById("nombreComercio");
    const cantidad = document.getElementById("cantidad");
    const ubicacion = document.getElementById("ubicacion");

    if (nombre.value.trim() === "") {
        nombre.nextElementSibling.textContent = "Campo obligatorio.";
        valido = false;
    }

    if (cantidad.value <= 0) {
        cantidad.nextElementSibling.textContent = "Debe ser un número positivo.";
        valido = false;
    }

    if (ubicacion.value.trim() === "") {
        ubicacion.nextElementSibling.textContent = "Indica la ubicación.";
        valido = false;
    }

    if (valido) {
        this.submit();
    }
});
