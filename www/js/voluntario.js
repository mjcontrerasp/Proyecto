const ejemploDonaciones = [
    { tipo: "Panadería", cantidad: "5kg", comercio: "Pan Badajoz", telefono: "600123123", fecha: "2025-01-25" },
    { tipo: "Verduras", cantidad: "3kg", comercio: "Frutería Paco", telefono: "600222333", fecha: "2025-01-26" }
];

function renderizar(lista) {
    const cont = document.getElementById("donaciones");
    cont.innerHTML = "";

    lista.forEach(d => {
        const card = document.createElement("div");
        card.className = "donacion";

        card.innerHTML = `
            <strong>${d.tipo}</strong> (${d.cantidad})<br>
            Comercio: ${d.comercio}<br>
            Disponible: ${d.fecha}<br><br>

            <a href="tel:${d.telefono}" class="btn">Llamar</a><br><br>
            <a href="https://wa.me/${d.telefono}" class="btn">WhatsApp</a>
        `;

        cont.appendChild(card);
    });
}

document.getElementById("btnFiltrar").addEventListener("click", () => {
    const tipo = document.getElementById("filtroTipo").value;
    const fecha = document.getElementById("filtroFecha").value;

    let filtradas = ejemploDonaciones;

    if (tipo) filtradas = filtradas.filter(d => d.tipo === tipo);
    if (fecha) filtradas = filtradas.filter(d => d.fecha === fecha);

    renderizar(filtradas);
});

renderizar(ejemploDonaciones);
