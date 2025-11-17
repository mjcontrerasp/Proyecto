document.getElementById("btnPublicar").addEventListener("click", () => {
    const tipo = document.getElementById("tipo").value;
    const cantidad = document.getElementById("cantidad").value;
    const estado = document.getElementById("estado").value;
    const fecha = document.getElementById("fecha").value;

    const msg = document.getElementById("msg");

    if (!tipo || !cantidad || !estado || !fecha) {
        msg.textContent = "Debes completar los campos obligatorios.";
        msg.style.color = "red";
        return;
    }

    msg.textContent = "Excedente publicado correctamente.";
    msg.style.color = "green";

    const lista = document.getElementById("listaDonaciones");
    const card = document.createElement("div");
    card.className = "donacion";

    card.innerHTML = `
        <strong>${tipo}</strong><br>
        Cantidad: ${cantidad}<br>
        Estado: ${estado}<br>
        Disponible: ${fecha}<br>
        <button class="btn btnPequeña">Marcar como Recogido</button>
    `;

    lista.appendChild(card);
});
