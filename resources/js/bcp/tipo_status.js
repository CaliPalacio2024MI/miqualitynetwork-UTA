import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    const colorPicker = document.getElementById("colorPicker");
    const rgbValue = document.getElementById("rgbValue");

    function hexToRgb(hex) {
        const bigint = parseInt(hex.slice(1), 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;
        return `rgb(${r}, ${g}, ${b})`;
    }

    if (colorPicker && rgbValue) {
        rgbValue.value = hexToRgb(colorPicker.value);

        colorPicker.addEventListener("input", function () {
            rgbValue.value = hexToRgb(this.value);
        });
    }

    // BUSCADOR

    document.getElementById('btn-buscar-status').addEventListener('click', function () {
        const filtro = document.getElementById('buscar-status').value.trim().toLowerCase();
        const filas = document.querySelectorAll('#tabla-status-body tr');

        let coincidencias = 0;

        filas.forEach(fila => {
            const textoFila = fila.textContent.trim().toLowerCase();

            if (!filtro || textoFila.includes(filtro)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });

        // Mostrar mensaje si no hay coincidencias
        const tbody = document.getElementById('tabla-status-body');
        const filaNoHay = document.getElementById('fila-no-hay');

        if (coincidencias === 0) {
            if (!filaNoHay) {
                const nuevaFila = document.createElement('tr');
                nuevaFila.id = 'fila-no-hay';
                nuevaFila.innerHTML = `
                <td colspan="100%" style="text-align: center;">No existen coincidencias</td>
            `;
                tbody.appendChild(nuevaFila);
            }
        } else {
            if (filaNoHay) {
                filaNoHay.remove();
            }
        }
    });

    // ELIMINAR

    let idEliminar = null;

    // Botones eliminar
    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function () {
            idEliminar = this.getAttribute('data-id');
            document.getElementById('modalEliminar').style.display = 'block';
        });
    });

    // Cerrar modal eliminar
    document.getElementById('btn-cerrar-eliminar').addEventListener('click', function () {
        document.getElementById('modalEliminar').style.display = 'none';
        idEliminar = null;
    });

    // Confirmar eliminar
    document.getElementById('btn-eliminar').addEventListener('click', function () {
        if (idEliminar) {
            fetch(`/tipo_status/${idEliminar}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.json().then(data => {
                            mostrarModal('modalError', data.message || 'Error desconocido');
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarModal('modalError', 'Hubo un error al eliminar el Tipo de Status.');
                })
                .finally(() => {
                    document.getElementById('modalEliminar').style.display = 'none';
                    idEliminar = null;
                });
        }
    });

    // EDITAR 

    const botonesEditar = document.querySelectorAll('.btn-editar');
    const modal = document.getElementById('modalEditar');
    const formEditar = document.getElementById('formEditar');
    const textoHabitacion = document.getElementById('textoHabitacion');

    botonesEditar.forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const fila = this.closest('tr');
            const nombre = fila.cells[0].textContent.trim();
            const codigo = fila.cells[1].textContent.trim();
            const color = fila.querySelector('div').style.backgroundColor;
            const colorPickerEditar = document.getElementById("colorPickerEditar");
            const rgbValueEditar = document.getElementById("rgbValueEditar");

            if (colorPickerEditar && rgbValueEditar) {
                rgbValueEditar.value = colorPickerEditar.value;
                colorPickerEditar.addEventListener("input", function () {
                    rgbValueEditar.value = this.value;
                });
            }

            formEditar.action = `/tipo_status/${id}`;
            textoHabitacion.textContent = `Editar el Tipo de Status: ${id}`;

            // Llenar formulario
            formEditar.Nombre.value = nombre;
            formEditar.Codigo.value = codigo;

            // Convertir RGB a HEX
            function rgbToHex(rgb) {
                const result = rgb.match(/\d+/g);
                return "#" + result.map(x => {
                    const hex = parseInt(x).toString(16);
                    return hex.length == 1 ? "0" + hex : hex;
                }).join('');
            }

            const hexColor = rgbToHex(color);
            colorPickerEditar.value = hexColor;

            modal.style.display = 'flex';
        });
    });

    // Cerrar modal
    document.getElementById('cerrarModalEditar').addEventListener('click', function () {
        modal.style.display = 'none';
    });

});
