// Función para inicializar la lógica de selects dinámicos
function initializeDynamicSelects() {
    const propiedadSelect = document.getElementById('propiedad-select');
    const departamentoSelect = document.getElementById('departamento-select');
    const puestoSelect = document.getElementById('puesto-select');

    function resetSelect(selectElement, defaultText) {
        if (selectElement) { // Añadir verificación para asegurar que el elemento existe
            selectElement.innerHTML = `<option value="" disabled selected>${defaultText}</option>`;
            selectElement.disabled = true;
        }
    }

    // Resetear al cargar/re-inicializar
    resetSelect(departamentoSelect, 'Seleccione un departamento');
    resetSelect(puestoSelect, 'Seleccione un puesto');

    if (propiedadSelect) {

        const newPropiedadListener = function () {
            const selectedHotel = this.value;
            resetSelect(departamentoSelect, 'Cargando departamentos...');
            resetSelect(puestoSelect, 'Seleccione un puesto');

            if (selectedHotel) {
                const url = `/api/departamentos/${selectedHotel}`; // Usar ruta absoluta
                
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(departamentos => {
                        resetSelect(departamentoSelect, 'Seleccione un departamento');
                        if (departamentoSelect) departamentoSelect.disabled = false;

                        if (departamentos.length === 0) {
                            if (departamentoSelect) departamentoSelect.innerHTML += '<option value="" disabled>No hay departamentos para esta propiedad</option>';
                        } else {
                            departamentos.forEach(departamento => {
                                const option = document.createElement('option');
                                option.value = departamento.nombre;
                                option.textContent = departamento.nombre;
                                if (departamentoSelect) departamentoSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar los departamentos:', error);
                        resetSelect(departamentoSelect, 'Error al cargar');
                    });
            } else {
                resetSelect(departamentoSelect, 'Seleccione un departamento');
            }
        };
        propiedadSelect.addEventListener('change', newPropiedadListener);
    }

    if (departamentoSelect) {
        const newDepartamentoListener = function () {
            const selectedDepartamento = this.value;
            resetSelect(puestoSelect, 'Cargando puestos...');

            if (selectedDepartamento) {
                const url = `/api/puestos/${selectedDepartamento}`;

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(puestos => {
                        resetSelect(puestoSelect, 'Seleccione un puesto');
                        if (puestoSelect) puestoSelect.disabled = false;

                        if (puestos.length === 0) {
                            if (puestoSelect) puestoSelect.innerHTML += '<option value="" disabled>No hay puestos para este departamento</option>';
                        } else {
                            puestos.forEach(puesto => {
                                const option = document.createElement('option');
                                option.value = puesto.puesto;
                                option.textContent = puesto.puesto;
                                if (puestoSelect) puestoSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar los puestos:', error);
                        resetSelect(puestoSelect, 'Error al cargar');
                    });
            } else {
                resetSelect(puestoSelect, 'Seleccione un puesto');
            }
        };
        departamentoSelect.addEventListener('change', newDepartamentoListener);
    }
}
document.addEventListener("DOMContentLoaded", initializeDynamicSelects);
