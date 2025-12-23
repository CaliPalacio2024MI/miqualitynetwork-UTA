const habitaciones = [
    ...Array.from({ length: 29 }, (_, i) => 1102 + i),
    ...Array.from({ length: 30 }, (_, i) => 1202 + i),
    ...Array.from({ length: 30 }, (_, i) => 1302 + i),
    ...Array.from({ length: 30 }, (_, i) => 1402 + i),
    ...Array.from({ length: 30 }, (_, i) => 1502 + i),
    ...Array.from({ length: 30 }, (_, i) => 1602 + i),
    ...Array.from({ length: 30 }, (_, i) => 1702 + i),
    ...Array.from({ length: 27 }, (_, i) => 1800 + i),
    ...Array.from({ length: 29 }, (_, i) => 1900 + i),
    ...Array.from({ length: 19 }, (_, i) => 2102 + i),
    ...Array.from({ length: 19 }, (_, i) => 2202 + i),
    ...Array.from({ length: 19 }, (_, i) => 2302 + i),
    ...Array.from({ length: 19 }, (_, i) => 2402 + i),
    ...Array.from({ length: 19 }, (_, i) => 2502 + i),
    ...Array.from({ length: 19 }, (_, i) => 2602 + i),
    ...Array.from({ length: 19 }, (_, i) => 2702 + i),
    ...Array.from({ length: 22 }, (_, i) => 2800 + i),
    ...Array.from({ length: 20 }, (_, i) => 2900 + i),
    ...Array.from({ length: 24 }, (_, i) => 3202 + i),
    ...Array.from({ length: 24 }, (_, i) => 3302 + i),
    ...Array.from({ length: 24 }, (_, i) => 3402 + i),
    ...Array.from({ length: 24 }, (_, i) => 3502 + i),
    ...Array.from({ length: 26 }, (_, i) => 3600 + i),
    ...Array.from({ length: 26 }, (_, i) => 3700 + i),
    ...Array.from({ length: 24 }, (_, i) => 3800 + i),
    ...Array.from({ length: 23 }, (_, i) => 3900 + i),
    ...Array.from({ length: 35 }, (_, i) => 4102 + i),
    ...Array.from({ length: 35 }, (_, i) => 4202 + i),
    ...Array.from({ length: 35 }, (_, i) => 4302 + i),
    ...Array.from({ length: 35 }, (_, i) => 4402 + i),
    ...Array.from({ length: 31 }, (_, i) => 4502 + i),
    ...Array.from({ length: 24 }, (_, i) => 4600 + i),
    ...Array.from({ length: 21 }, (_, i) => 4700 + i),
    ...Array.from({ length: 7 }, (_, i) => 4800 + i),
    ...Array.from({ length: 3 }, (_, i) => 4900 + i)
];

const tabla = document.getElementById("tablaHabitaciones").querySelector("tbody");
const encabezadoPrincipal = document.getElementById("encabezadoPrincipal");
const fechas = generarFechas();

function generarFechas() {
    let fechas = [];
    let hoy = new Date();
    for (let i = 0; i < 30; i++) {
        let nuevaFecha = new Date(hoy);
        nuevaFecha.setDate(hoy.getDate() + i);
        let formatoFecha = nuevaFecha.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: '2-digit' });
        fechas.push(formatoFecha);
    }
    return fechas;
}

function crearTabla() {
    encabezadoPrincipal.innerHTML = "<th>Estatus</th><th>Tipo</th><th>Habitación</th>";
    fechas.forEach(fecha => {
        let th = document.createElement("th");
        th.textContent = fecha;
        encabezadoPrincipal.appendChild(th);
    });

    tabla.innerHTML = "";
    habitaciones.forEach(num => {
        let fila = document.createElement("tr");
        fila.innerHTML = `<td>No disponible</td><td></td><td>${num}</td>`;
        fechas.forEach(() => fila.innerHTML += `<td></td>`);
        tabla.appendChild(fila);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    crearTabla();

    document.getElementById("btnBuscar").addEventListener("click", () => {
        const input = document.getElementById("busquedaHabitacion").value.trim();
        const filas = tabla.querySelectorAll("tr");

        filas.forEach(fila => {
            const celdaHabitacion = fila.cells[2]?.textContent || "";
            if (input === "" || celdaHabitacion.includes(input)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });
});
