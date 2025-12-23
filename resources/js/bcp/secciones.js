let disponibles = [];
let seleccionadasFormulario = [];
let seleccionadasModal = [];

function renderTablas() {
    const tablaDisponibles = document.getElementById('tabla-habitaciones');
    const tablaSeleccionadas = document.getElementById('tabla-seleccionadas');

    tablaDisponibles.innerHTML = '';
    tablaSeleccionadas.innerHTML = '';

    disponibles.forEach(hab => {
        tablaDisponibles.innerHTML += `
            <tr>
                <td style="width: 60%;">${hab}</td>
                <td><input type="checkbox" class="chk" value="${hab}"></td>
            </tr>`;
    });

    seleccionadasFormulario.forEach(hab => {
        tablaSeleccionadas.innerHTML += `
            <tr>
                <td style="width: 60%;">${hab}</td>
                <td>
                    <button type="button" onclick="quitarHabitacionFormulario('${hab}')" class="boton-icono borra-edita btn-eliminar">
                        <img src="images/modules/bcp/iconos/delete.svg" alt="Eliminar">
                    </button>
                </td>
            </tr>`;
    });

    document.getElementById('habitacionesSeleccionadas').value = JSON.stringify(seleccionadasFormulario);
}

let habitacionesMarcadasParaEliminar = [];

function toggleMarcaEliminar(hab) {
    const index = habitacionesMarcadasParaEliminar.indexOf(hab);
    if (index === -1) {
        habitacionesMarcadasParaEliminar.push(hab);
    } else {
        habitacionesMarcadasParaEliminar.splice(index, 1);
    }
    renderTablaModal();
}
window.toggleMarcaEliminar = toggleMarcaEliminar;

function renderTablaModal() {
    const tablaModal = document.getElementById('tabla-hab-modal');
    tablaModal.innerHTML = '';

    seleccionadasModal.forEach(hab => {
        const marcada = habitacionesMarcadasParaEliminar.includes(hab);
        const clase = marcada ? 'marcada-para-eliminar' : '';

        const fila = document.createElement('tr');
        fila.className = clase;

        fila.innerHTML = `
            <td style="width: 60%;">${hab}</td>
            <td>
                <button type="button" class="boton-icono borra-edita btn-eliminar ${clase}">
                    <img src="images/modules/bcp/iconos/delete.svg" alt="Eliminar">
                </button>
            </td>`;

        const boton = fila.querySelector('button');
        boton.addEventListener('click', () => toggleMarcaEliminar(hab));

        tablaModal.appendChild(fila);
    });

    document.getElementById('habitacionesEliminadas').value = JSON.stringify(habitacionesMarcadasParaEliminar);
}

function quitarHabitacionFormulario(hab) {
    seleccionadasFormulario = seleccionadasFormulario.filter(h => h !== hab);
    renderTablas();
}
window.quitarHabitacionFormulario = quitarHabitacionFormulario;

function quitarHabitacionModal(hab) {
    seleccionadasModal = seleccionadasModal.filter(h => h !== hab);

    const eliminadas = JSON.parse(document.getElementById('habitacionesEliminadas').value || '[]');
    if (!eliminadas.includes(hab)) eliminadas.push(hab);
    document.getElementById('habitacionesEliminadas').value = JSON.stringify(eliminadas);

    renderTablaModal();
}
window.quitarHabitacionModal = quitarHabitacionModal;

function cargarHabitaciones() {
    const edificio = document.querySelector('input[name="Edificio"]').value;
    const piso = document.querySelector('input[name="Piso"]').value;

    fetch('/filtrar-habitaciones', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
        },
        body: JSON.stringify({ Edificio: edificio, Piso: piso })
    })
        .then(res => res.json())
        .then(data => {
            disponibles = data.map(d => d.N_Hab);
            renderTablas();
        });
}

function seleccionarHabitaciones() {
    const checks = document.querySelectorAll('.chk:checked');
    checks.forEach(chk => {
        const hab = chk.value;

        if (!seleccionadasFormulario.includes(hab)) {
            seleccionadasFormulario.push(hab);
        }

        chk.checked = false;
    });

    renderTablas();
}

let seccionAEliminar = null;

document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('input[name="Piso"]').addEventListener('change', cargarHabitaciones);
    document.querySelector('input[name="Edificio"]').addEventListener('change', cargarHabitaciones);
    document.getElementById('btnSeleccionar').addEventListener('click', seleccionarHabitaciones);
    renderTablas();

    // Buscador de secciones
    document.getElementById('btn-buscar-seccion').addEventListener('click', function () {
        const filtro = document.getElementById('buscar-seccion').value.trim().toLowerCase();
        const filas = document.querySelectorAll('#tabla-secciones-body tr');

        let coincidencias = 0;

        filas.forEach(fila => {
            const nombreSeccion = fila.cells[0].textContent.trim().toLowerCase();

            if (!filtro || nombreSeccion.includes(filtro)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });

        // Si no hay coincidencias
        const tbody = document.getElementById('tabla-secciones-body');
        const filaNoHay = document.getElementById('fila-no-hay');

        if (coincidencias === 0) {
            if (!filaNoHay) {
                const nuevaFila = document.createElement('tr');
                nuevaFila.id = 'fila-no-hay';
                nuevaFila.innerHTML = `
                    <td colspan="2" style="text-align: center;">No existen coincidencias</td>
                `;
                tbody.appendChild(nuevaFila);
            }
        } else {
            if (filaNoHay) {
                filaNoHay.remove();
            }
        }
    });

    // Abrir modal al hacer clic en botón eliminar de la tabla
    document.querySelectorAll('.btn-eliminar').forEach(btn => {
        btn.addEventListener('click', function () {
            seccionAEliminar = this.getAttribute('data-id');
            document.querySelector('#modalEliminar p').textContent = `¿Seguro que quieres eliminar la sección "${seccionAEliminar}"?`;
            document.getElementById('modalEliminar').style.display = 'block';
        });
    });

    // Cerrar modal
    document.getElementById('btn-cerrar-eliminar').addEventListener('click', function () {
        document.getElementById('modalEliminar').style.display = 'none';
        seccionAEliminar = null;
    });

    // Confirmar eliminación
    document.getElementById('btn-eliminar').addEventListener('click', function () {
        if (!seccionAEliminar) return;

        fetch(`/eliminar-seccion/${seccionAEliminar}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
            }
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    document.getElementById('modalEliminar').style.display = 'none';
                    seccionAEliminar = null;
                    location.reload();
                }
            });
    });

    let nombreOriginalSeccion = '';
    document.querySelectorAll('.btn-editar').forEach(btn => {
        btn.addEventListener('click', function () {
            const seccion = this.dataset.id;
            const inputSecciones = document.getElementById('inputNombreSeccion');
            inputSecciones.value = seccion;

            const formEditar = document.getElementById('formEditar');

            document.getElementById('modalEditar').style.display = 'block';
            inputSecciones.value = seccion;
            nombreOriginalSeccion = seccion;
            formEditar.action = `/secciones/${seccion}`;

            seleccionadasModal = [];

            fetch(`/secciones/${seccion}/habitaciones`)
                .then(res => res.json())
                .then(data => {
                    seleccionadasModal = data;
                    renderTablaModal();
                });
        });

    });

    document.getElementById('cerrarModalEditar').addEventListener('click', function () {
        document.getElementById('modalEditar').style.display = 'none';
        habitacionesMarcadasParaEliminar = [];
        renderTablaModal(); // Refresca la tabla sin marcas
    });


    document.getElementById('formEditar').addEventListener('submit', function (event) {
    });

});