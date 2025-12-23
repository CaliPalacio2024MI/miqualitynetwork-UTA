import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('buscar-seccion');

    select.addEventListener('change', function () {
        const seccion = this.value;

        if (!seccion) return;

        fetch(`/buscar-habitaciones/${seccion}`)
            .then(res => res.json())
            .then(data => {
                const tbody = document.querySelector('#tabla-asignacion-seccion tbody');
                tbody.innerHTML = '';

                data.forEach(h => {
                    tbody.innerHTML += `
                    <tr>
                        <td>${h.Sal_Pre ?? ''}</td>
                        <td>${h.N_Hab ?? ''}</td>
                        <td>${h.Tp_Hab ?? ''}</td>
                        <td>${h.Piso ?? ''}</td>
                        <td>${h.Status ?? ''}</td>
                        <td>${h.Tpo ?? ''}</td>
                        <td>${h.Valor_A ?? ''}</td>
                        <td>${h.MontoMN ?? ''}</td>
                        <td>${h.Credito ?? ''}</td>
                        <td>${h.Nombre ?? ''}</td>
                        <td><input type="checkbox" class="chk" value="${h.N_Hab ?? ''}"></td>
                    </tr>
                    `;
                });

            })
            .catch(error => {
                console.error('Error al buscar habitaciones:', error);
            });
    });

    //Exportar
    document.getElementById('btnExportar').addEventListener('click', () => {
        const camarista = document.getElementById('buscar-camarista').value;
        if (!camarista) {
            alert("Selecciona una camarista primero.");
            return;
        }

        const url = `/exportar-asignadas/${encodeURIComponent(camarista)}`;
        const ventana = window.open('', '_blank');
        fetch(url)
            .then(res => res.text())
            .then(html => {
                ventana.document.write(`<html><head><title>Exportación</title></head><body>${html}</body></html>`);
                ventana.document.close();
                ventana.print();
            });
    });

});

const asignarBtn = document.getElementById('asignar-asignacion');
asignarBtn.addEventListener('click', function () {
    const filasSeleccionadas = document.querySelectorAll('#tabla-asignacion-seccion tbody tr');
    const tbodyDestino = document.querySelector('#tabla-asignacion-seleccionada tbody');

    filasSeleccionadas.forEach(fila => {
        const checkbox = fila.querySelector('.chk');
        if (checkbox && checkbox.checked) {
            const celdas = fila.querySelectorAll('td');
            const nHab = celdas[1].textContent.trim();
            const tHab = celdas[2].textContent;
            const status = celdas[4].textContent;
            const cred = parseFloat(celdas[8].textContent) || 0;

            const yaExiste = Array.from(tbodyDestino.querySelectorAll('tr')).some(tr => {
                return tr.children[0]?.textContent.trim() === nHab;
            });

            if (!yaExiste) {
                // Crear fila visible
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${nHab}</td>
                    <td>${tHab}</td>
                    <td>${status}</td>
                    <td>${cred}</td>
                    <td class="celda-estado" style="text-align: center; vertical-align: middle;">
                        <button type="button" class="boton-icono icono-asigna" data-id="${nHab}">
                            <img src="images/modules/bcp/iconos/ojito.png" alt="visualizar">
                        </button>
                        <button type="button" class="boton-icono borra-edita icono-asigna" data-id="${nHab}">
                            <img src="images/modules/bcp/iconos/delete.svg" alt="Eliminar">
                        </button>
                    </td>
                `;

                // Agregar inputs ocultos solo con datos de la fila
                const campos = ['Sal_Pre', 'N_Hab', 'Tp_Hab', 'Piso', 'Status', 'Tpo', 'AD', 'MN', 'Creds', 'Titular'];
                campos.forEach((key, i) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `${key}[]`;
                    input.value = celdas[i]?.textContent.trim() || '';
                    input.classList.add('input-habitacion-oculta');
                    tr.appendChild(input);
                });

                tbodyDestino.appendChild(tr);

                tr.querySelector('.icono-asigna').addEventListener('click', function () {
                    abrirModalConFila(tr);
                });

            }
        }
    });

    actualizarTotalCreditos();
});


// Eliminar filas
document.querySelector('#tabla-asignacion-seleccionada').addEventListener('click', function (e) {
    if (e.target.closest('.borra-edita')) {
        const fila = e.target.closest('tr');
        fila.remove();
        actualizarTotalCreditos();
    }
});

// Sumar créditos
function actualizarTotalCreditos() {
    const filas = document.querySelectorAll('#tabla-asignacion-seleccionada tbody tr');
    let total = 0;

    filas.forEach(fila => {
        const valor = parseFloat(fila.children[3]?.textContent) || 0;
        total += valor;
    });

    document.querySelector('input[name="Cred_Total"]').value = total;
}

document.getElementById('asignadasForm').addEventListener('submit', function (e) {
    const totalCred = parseFloat(document.querySelector('input[name="Cred_Total"]').value) || 0;
    const maxCred = parseFloat(document.getElementById('mostrar-cred').value) || 0;

    if (totalCred > maxCred) {
        e.preventDefault(); // Cancela el envío del formulario
        alert('El total de Créditos asignados supera el Límite de Créditos');
    }
});

// CAMARISTA
document.getElementById('buscar-camarista').addEventListener('change', function () {
    const camarista = this.value;

    if (!camarista) return;

    fetch(`/buscar-asignadas-hoy/${encodeURIComponent(camarista)}`)
        .then(res => res.json())
        .then(data => {
            const tbodyDestino = document.querySelector('#tabla-asignacion-seleccionada tbody');
            tbodyDestino.innerHTML = ''; // Limpia la tabla primero

            data.forEach(h => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${h.N_Hab ?? ''}</td>
                    <td>${h.Tp_Hab ?? ''}</td>
                    <td>${h.Status ?? ''}</td>
                    <td>${h.Creds ?? ''}</td>
                    <td class="celda-estado" style="text-align: center; vertical-align: middle;">
                        <button type="button" class="boton-icono icono-asigna" data-id="${h.N_Hab}">
                            <img src="images/modules/bcp/iconos/ojito.png" alt="visualizar">
                        </button>
                        <button type="button" class="boton-icono borra-edita icono-asigna" data-id="${h.N_Hab}">
                            <img src="images/modules/bcp/iconos/delete.svg" alt="Eliminar">
                        </button>
                    </td>
                `;

                // Agrega inputs ocultos para enviar al backend
                const campos = ['Sal_Pre', 'N_Hab', 'Tp_Hab', 'Piso', 'Status', 'Tpo', 'AD', 'MN', 'Creds', 'Titular'];
                campos.forEach(key => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `${key}[]`;
                    input.value = h[key] ?? '';
                    input.classList.add('input-habitacion-oculta');
                    tr.appendChild(input);
                });

                tbodyDestino.appendChild(tr);

                tr.querySelector('.icono-asigna').addEventListener('click', function () {
                    abrirModalConFila(tr);
                });

            });

            actualizarTotalCreditos(); // Vuelve a calcular total de créditos
        })
        .catch(error => {
            console.error('Error al cargar asignadas hoy:', error);
        });
});


// MODALES OJITO
window.cerrarModal = function () {
    document.getElementById('modal-detalles').style.display = 'none';
};

function abrirModalConFila(tr) {
    const celdas = tr.querySelectorAll('td');
    const inputsOcultos = tr.querySelectorAll('.input-habitacion-oculta');

    let contenido = '<ul>';

    // Celdas visibles
    const etiquetasVisibles = ['N. Hab.', 'T. Hab.', 'Status', 'Créditos'];
    const valoresVisibles = [];

    celdas.forEach((td, i) => {
        if (i < etiquetasVisibles.length) {
            const texto = td.textContent.trim();
            valoresVisibles.push(texto);
            contenido += `<li><strong>${etiquetasVisibles[i]}:</strong> ${texto}</li>`;
        }
    });

    // Inputs ocultos: solo mostrar si su valor NO está ya en visibles y no vacío
    inputsOcultos.forEach(input => {
        const valor = input.value.trim();
        const nombre = input.name.replace('[]', '');
        if (valor !== '' && !valoresVisibles.includes(valor)) {
            contenido += `<li><strong>${nombre}:</strong> ${valor}</li>`;
        }
    });

    contenido += '</ul>';

    document.getElementById('contenido-modal').innerHTML = contenido;
    document.getElementById('modal-detalles').style.display = 'block';
}




