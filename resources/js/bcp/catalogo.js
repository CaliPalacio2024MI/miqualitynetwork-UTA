import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const inputBusqueda = document.getElementById('buscar-habitacion');
    const botonBuscar = document.getElementById('btn-buscar-habitacion');
    const tablaBody = document.querySelector('#tabla-mesas tbody');

    // BUSCAR HABITACIÓN

    botonBuscar.addEventListener('click', function () {
        const filtro = inputBusqueda.value.trim().toLowerCase();
        const filas = tablaBody.querySelectorAll('tr');
        let coincidencias = 0;

        const mensajeAnterior = document.getElementById('fila-sin-resultados');
        if (mensajeAnterior) mensajeAnterior.remove();

        if (filtro === '') {
            filas.forEach(fila => fila.style.display = '');
            return;
        }

        filas.forEach(fila => {
            const celdas = fila.querySelectorAll('td');
            const filaCoincide = Array.from(celdas).some(td => td.textContent.toLowerCase().includes(filtro));

            if (filaCoincide) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });

        if (coincidencias === 0) {
            const fila = document.createElement('tr');
            fila.id = 'fila-sin-resultados';
            const td = document.createElement('td');
            td.colSpan = 7;
            td.className = 'text-center text-black-500';
            td.textContent = 'No se encontraron resultados.';
            fila.appendChild(td);
            tablaBody.appendChild(fila);
        }
    });

    // ELIMINAR

    const botonesEliminar = document.querySelectorAll('.btn-eliminar');
    const modalEliminar = document.getElementById('modalEliminar');
    const btnCerrarEliminar = document.getElementById('btn-cerrar-eliminar');
    const btnEliminar = document.getElementById('btn-eliminar');
    const modalMensaje = modalEliminar.querySelector('.modal-content p');

    let habitacionIdToDelete = null;

    if (modalEliminar && btnCerrarEliminar && btnEliminar) {
        botonesEliminar.forEach(boton => {
            boton.addEventListener('click', function () {
                habitacionIdToDelete = boton.getAttribute('data-id');
                modalMensaje.textContent = `¿Estás seguro de que quieres eliminar la habitación Número: ${habitacionIdToDelete}?`;
                modalEliminar.style.display = 'flex';
            });
        });

        btnCerrarEliminar.addEventListener('click', function () {
            modalEliminar.style.display = 'none';
        });

        btnEliminar.addEventListener('click', function () {
            if (habitacionIdToDelete) {
                fetch(`/catalogo/${habitacionIdToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error("Error al eliminar en la base de datos");
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const fila = document.querySelector(`.btn-eliminar[data-id="${habitacionIdToDelete}"]`).closest('tr');
                            if (fila) fila.remove(); 
                            console.log(data.message);
                        } else {
                            console.error(data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    })
                    .finally(() => {
                        modalEliminar.style.display = 'none';
                    });
            } else {
                console.log("No se ha seleccionado una habitación para eliminar.");
            }
        });
    }

    // EDITAR 

    const botonesEditar = document.querySelectorAll('.btn-editar');
    const modal = document.getElementById('modalEditar');
    const formEditar = document.getElementById('formEditar');
    const textoHabitacion = document.getElementById('textoHabitacion');

    botonesEditar.forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');

            formEditar.action = `/catalogo/${id}`;

            textoHabitacion.textContent = `Editar la Habitación: ${id}`;

            modal.style.display = 'flex';
        });
    });

    // Botón de cerrar modal
    const cerrarBtn = document.getElementById('cerrarModalEditar');
    cerrarBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });


});
