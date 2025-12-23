import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    // CENTRO CONSUMO MENU **************************************************************************************
    document.querySelectorAll('.categoria-item').forEach(item => {
        const button = item.querySelector('.categoria-btn');
        const submenu = item.querySelector('.subcategorias');

        button.addEventListener('mouseenter', () => {
            document.querySelectorAll('.subcategorias').forEach(s => s.style.display = 'none');
            document.querySelectorAll('.categoria-btn').forEach(b => b.classList.remove('active'));
            submenu.style.display = 'flex';
            button.classList.add('active');
        });

        item.addEventListener('mouseleave', () => {
            submenu.style.display = 'none';
            button.classList.remove('active');
        });
    });

    // Marche ****************************************************************************************************
    const habitacionInput = document.getElementById('habitacion');
    const switchVisual = document.getElementById('switch_visual');
    const lateCheckOutHidden = document.getElementById('Late_CheckOut');

    if (!habitacionInput) return;

    habitacionInput.addEventListener('change', function () {
        const numero = this.value.trim();
        if (numero === '') return;

        console.log(`Buscando info en: /info-habitacion/${numero}`);

        fetch(`/info-habitacion/${numero}`)
            .then(response => {
                if (!response.ok) throw new Error('Habitación no encontrada o sin huésped actual.');
                return response.json();
            })
            .then(data => {
                document.getElementById('huesped').value = data.Nombre || '';
                document.getElementById('tipo').value = data.Tpo || '';
                document.getElementById('plan').value = data.Plan || '';
                document.getElementById('brazalete').value = data.Brasalete || '';
                document.getElementById('fecha_llegada').value = data.FechaLlegada || '';
                document.getElementById('fecha_salida').value = data.FechaSal || '';
                document.getElementById('pax').value = data.Pax || '';
                document.getElementById('grupo').value = data.Grupo || '';
                document.getElementById('credito').value = data.CreditoDisponible || '';

                // Actualiza el valor del input oculto y luego sincroniza el switch visual
                lateCheckOutHidden.value = data.LateCheckOut?.toLowerCase() === 'si' ? 'si' : 'no';
                actualizarSwitchVisual();
            })
            .catch(error => {
                alert(error.message);
                ['huesped', 'tipo', 'plan', 'brazalete', 'fecha_llegada', 'fecha_salida', 'pax', 'grupo', 'credito'].forEach(id => {
                    document.getElementById(id).value = '';
                });
                lateCheckOutHidden.value = 'no';
                actualizarSwitchVisual();
            });
    });

    function actualizarSwitchVisual() {
        const valor = lateCheckOutHidden.value.toLowerCase();
        switchVisual.checked = (valor === 'si');
    }

    actualizarSwitchVisual();

    const botonBuscar = document.getElementById('btn-buscar-mesa');
    const inputBuscar = document.getElementById('buscar-mesa');

    botonBuscar.addEventListener('click', function () {
        const input = inputBuscar.value.trim();
        const filas = document.querySelectorAll('tbody tr');

        if (input === '') {
            filas.forEach(fila => fila.style.display = '');
            return;
        }

        const numero = parseInt(input);
        filas.forEach(fila => {
            const numeroMesa = parseInt(fila.cells[0].textContent);
            fila.style.display = (numeroMesa === numero) ? '' : 'none';
        });
    });
});

// OCULTAR TABLAS EN MARCHE
function ocultarTabla() {
    document.getElementById("bloque-formulario").style.display = "none";
    document.getElementById("tabla-pedidos-contenedor").style.display = "block";
}
window.ocultarTabla = ocultarTabla;

window.mostrarTablaConsumos = function(mesaId) {
    mesaId = parseInt(mesaId); // Lo convierte a número si hace falta
    document.getElementById('bloque-formulario').style.display = 'none';
    document.getElementById('tabla-por-mesa').style.display = 'block';

    // Hacer la solicitud AJAX para obtener los consumos de esa mesa
    fetch(`/consumos/${mesaId}`)
        .then(response => response.json())
        .then(consumos => {
            const tbody = document.querySelector('#tabla-por-mesa tbody');
            tbody.innerHTML = ''; // Limpiar la tabla antes de agregar los nuevos datos

            if (consumos.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="5" style="text-align: center;">No hay consumos registrados para esta mesa</td>`;
                tbody.appendChild(tr);
            } else {
                console.log('Datos de consumos recibidos:', consumos);

                consumos.forEach(consumo => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${consumo.categoria}</td>
                        <td>${consumo.cantidad}</td>
                        <td>${consumo.descripcion}</td>
                        <td>${consumo.importe}</td>
                        <td>${consumo.mesa}</td>
                    `;
                    tbody.appendChild(tr);
                });
            }
        })
        .catch(error => {
            console.error('Error al obtener consumos:', error);
            alert('Hubo un error al obtener los consumos.');
        });

    console.log('Mostrar consumos para la mesa', mesaId);
}
