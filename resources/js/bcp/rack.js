import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    //RACK**************************************************************************************
    const mostrarTodasBtn = document.getElementById('mostrarTodasBtn');
    const buscarHabitacionBtn = document.getElementById('buscarHabitacionBtn');

    // Función para mostrar todas las filas
    function mostrarTodas() {
        const filas = document.getElementById('tablaHabitaciones').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        for (let fila of filas) {
            fila.style.display = '';
        }
    }

    // Función para buscar una habitación específica
    function buscarHabitacion() {
        const input = document.getElementById('numHabitacion').value;
        const tabla = document.getElementById('tablaHabitaciones');
        const filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        const numero = parseInt(input);

        /*1102-1130, 1202-1231, 1302-1331, 1402-1431, 1502-1531, 1602-1631, 1702-1731, 1800-1826, 1900-1928, 2102-2120,
        2202-2220, 2302-2320, 2402-2420, 2502-2520, 2602-2620, 2702-2720, 2800-2821, 2900-2919, 3202-3225, 3302-3325,
        3402-3425, 3502-3525, 3600-3625, 3700-3725, 3800-3823, 3900-3922, 4102-4136, 4202-4236, 4302-4336, 4402-4436,
        4502-4532, 4600-4623, 4700-4720, 4800-4806, 4900-4902.
        */
        const habitaciones = Array.from({ length: 4902 - 1102 + 1 }, (_, i) => 1102 + i);

        if (!input || !habitaciones.includes(numero)) {
            alert('Número de habitación no válido');
            return;
        }

        for (let fila of filas) {
            const celdaHabitacion = fila.cells[2]; // La tercera columna (índice 2)
            if (celdaHabitacion && parseInt(celdaHabitacion.textContent) === numero) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        }
    }

    // Asociar los eventos
    if (mostrarTodasBtn && buscarHabitacionBtn) {
        mostrarTodasBtn.addEventListener('click', mostrarTodas);
        buscarHabitacionBtn.addEventListener('click', buscarHabitacion);
    }
});
