import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    // Cargar asignaciones del día
    fetch('/asignaciones-hoy')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tabla-asignacion-seleccionada tbody');
            tbody.innerHTML = '';

            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.nombre}</td>
                    <td>${row.cred_total}</td>
                    <td>${row.cred_comp}</td>
                    <td>${row.cred_pend}</td>
                    <td>
                        <button type="button" class="boton-icono icono-mostrar" data-camarista="${row.nombre}">
                            <img src="images/modules/bcp/iconos/flecha-circ-derecha.svg" alt="visualizar">
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Error al obtener datos:', error);
        });
});

// Manejar clic en el botón "Ver"
document.addEventListener('click', function (e) {
    if (e.target.closest('.icono-mostrar')) {
        const boton = e.target.closest('.icono-mostrar');
        const camarista = boton.dataset.camarista;

        // Cambiar color del botón activo
        document.querySelectorAll('.icono-mostrar').forEach(b => b.classList.remove('activo'));
        boton.classList.add('activo');

        // Obtener detalles de la camarista
        fetch(`/asignaciones-detalle/${encodeURIComponent(camarista)}`)
            .then(response => response.json())
            .then(data => {
                // Obtener tipos de status
                fetch('/tipos-status')
                    .then(res => res.json())
                    .then(statusData => {
                        const tiposStatus = statusData.map(ts => ts.Codigo);
                        const tbody = document.querySelector('#tabla-asignacion-todo tbody');
                        tbody.innerHTML = '';

                        data.forEach(row => {
                            const titular = row.Titular ?? '';
                            const mn = titular === '' ? '' : (row.MN ?? '');
                            const statusActual = row.Status ?? '';

                            const selectHtml = `<select class="form-select form-select-sm status-select" 
        data-hab="${row.N_Hab}" 
        data-fecha="${row.Fecha}" 
        data-original="${statusActual}">
    ${tiposStatus.map(code => `<option value="${code}" ${code === statusActual ? 'selected' : ''}>${code}</option>`).join('')}
</select>`;


                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>${row.Sal_Pre ?? ''}</td>
                                <td>${row.N_Hab ?? ''}</td>
                                <td>${row.Tp_Hab ?? ''}</td>
                                <td>${row.Piso ?? ''}</td>
                                <td>${row.Tpo ?? ''}</td>
                                <td>${row.AD ?? ''}</td>
                                <td>${mn}</td>
                                <td>${row.Creds ?? ''}</td>
                                <td>${titular}</td>
                                <td>${selectHtml}</td>
                            `;
                            tbody.appendChild(tr);
                        });
                    });
            })
            .catch(err => console.error('Error al obtener detalle:', err));
    }
});

// Manejar clic en el botón "Guardar Cambios"
document.getElementById('btnCambiarStatus').addEventListener('click', function () {
    document.querySelectorAll('.status-select').forEach(select => {
        const n_hab = select.dataset.hab;
        const fecha = select.dataset.fecha;
        const nuevo_status = select.value;

        fetch('/asignacion/update-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ n_hab, fecha, nuevo_status })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('modal-exito').style.display = 'block';
                } else {
                    console.error(`Error al actualizar ${n_hab}:`, data.message);
                }
            })
            .catch(error => {
                console.error(`Error en el fetch para ${n_hab}:`, error);
            });
    });
});

