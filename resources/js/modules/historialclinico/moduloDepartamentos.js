// moduloDepartamentos.js

function showCustomModal(message, type = 'alert', callback = null) {
    const modalContainer = document.getElementById('custom-modal-container');
    const modalMessage = document.getElementById('custom-modal-message');
    const modalConfirmBtn = document.getElementById('custom-modal-confirm-btn');
    const modalCancelBtn = document.getElementById('custom-modal-cancel-btn');
    const modalInput = document.getElementById('custom-modal-input');

    modalMessage.textContent = message;
    modalInput.value = '';

    modalConfirmBtn.style.display = 'inline-block';
    modalCancelBtn.style.display = 'none';
    modalInput.style.display = 'none';

    if (type === 'confirm') {
        modalCancelBtn.style.display = 'inline-block';
        modalConfirmBtn.textContent = 'Sí';
        modalCancelBtn.textContent = 'No';
        modalConfirmBtn.onclick = () => {
            modalContainer.classList.add('hidden');
            if (callback) callback(true);
        };
        modalCancelBtn.onclick = () => {
            modalContainer.classList.add('hidden');
            if (callback) callback(false);
        };
    } else if (type === 'prompt') {
        modalInput.style.display = 'block';
        modalCancelBtn.style.display = 'inline-block';
        modalConfirmBtn.textContent = 'Aceptar';
        modalCancelBtn.textContent = 'Cancelar';
        modalConfirmBtn.onclick = () => {
            modalContainer.classList.add('hidden');
            if (callback) callback(modalInput.value);
        };
        modalCancelBtn.onclick = () => {
            modalContainer.classList.add('hidden');
            if (callback) callback(null);
        };
    } else {
        modalConfirmBtn.textContent = 'Aceptar';
        modalConfirmBtn.onclick = () => {
            modalContainer.classList.add('hidden');
            if (callback) callback();
        };
    }

    modalContainer.classList.remove('hidden');
}

async function loadDepartamentos(propiedad = '', searchTerm = '') {
    const departamentosList = document.getElementById('departamentos-list');
    if (!departamentosList) return;
    departamentosList.innerHTML = '<li class="loading-indicator">Cargando departamentos...</li>';

    try {
        const encodedPropiedad = encodeURIComponent(propiedad);
        let url = `/departamentos/propiedad/${encodedPropiedad}`;

        if (searchTerm) {
            const encodedSearchTerm = encodeURIComponent(searchTerm);
            url = `/departamentos/buscar/${encodedPropiedad}/${encodedSearchTerm}`;
        }

        const response = await fetch(url);
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        const departamentos = await response.json();
        departamentosList.innerHTML = '';

        if (departamentos.length === 0) {
            departamentosList.innerHTML = '<li class="no-results">No se encontraron departamentos.</li>';
            return;
        }

        departamentos.forEach(departamento => {
            const li = document.createElement('li');
            li.dataset.id = departamento.id;
            li.dataset.propiedad = departamento.propiedad;
            li.innerHTML = `
                <span>${departamento.departamento}</span>
                <div class="btn-container-right">
                    <button class="btn-editar" onclick="updateDepartamento('${departamento.id}', '${document.querySelector('meta[name="csrf-token"]').content}')">
                        <img src="/images/editar.png" alt="editar-icon" class="iconos">
                    </button>
                    <button class="btn-eliminar" onclick="deleteDepartamento('${departamento.id}', '${document.querySelector('meta[name="csrf-token"]').content}')">
                        <img src="/images/iconodeborrar.png" alt="descargar-icon" class="iconos">
                    </button>
                </div>
            `;
            departamentosList.appendChild(li);
        });
    } catch (error) {
        console.error('Error al cargar departamentos:', error);
        departamentosList.innerHTML = '<li class="error-loading">Error al cargar departamentos.</li>';
        showCustomModal('Error al cargar los departamentos. Por favor, inténtalo de nuevo más tarde.', 'alert');
    }
}

function deleteDepartamento(departamentoId, csrfToken) {
    showCustomModal('¿Estás seguro de que quieres eliminar este departamento?', 'confirm', async (result) => {
        if (result) {
            try {
                const response = await fetch(`/departamentos/${departamentoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    showCustomModal('Departamento eliminado con éxito.', 'alert', () => {
                        const propiedadSelect = document.getElementById('propiedad');
                        const selectedPropiedad = propiedadSelect ? propiedadSelect.value : '';
                        const searchInput = document.getElementById('filtro-departamento');
                        const searchTerm = searchInput ? searchInput.value : '';
                        loadDepartamentos(selectedPropiedad, searchTerm);
                    });
                } else {
                    const errorData = await response.json();
                    showCustomModal(`Error al eliminar el departamento: ${errorData.message || response.statusText}`, 'alert');
                }
            } catch (error) {
                console.error('Error:', error);
                showCustomModal('Error al eliminar el departamento.', 'alert');
            }
        }
    });
}

function updateDepartamento(departamentoId, csrfToken) {
    showCustomModal("Ingrese el nuevo nombre del departamento:", 'prompt', async (nuevoNombre) => {
        if (nuevoNombre) {
            try {
                const response = await fetch(`/departamentos/${departamentoId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        departamento: nuevoNombre,
                        proceso_id: null // puedes mejorarlo después para permitir editar proceso
                    }),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || "Error al actualizar el departamento");
                }

                await response.json();

                showCustomModal('Departamento actualizado con éxito.', 'alert', () => {
                    const departamentoElement = document.querySelector(`li[data-id="${departamentoId}"] span`);
                    if (departamentoElement) {
                        departamentoElement.textContent = nuevoNombre;
                    }
                });
            } catch (error) {
                console.error("Error al actualizar el departamento:", error);
                showCustomModal(`Error al actualizar el departamento: ${error.message}`, 'alert');
            }
        }
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector(`form[action="${window.departamentosStoreRoute}"]`);
    if (form) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const propiedadSelect = document.getElementById('propiedad');
            const propiedad_id = propiedadSelect ? propiedadSelect.value : null;
            const departamentoInput = document.getElementById('departamento');
            const departamentoNombre = departamentoInput.value;
            const procesoSelect = document.getElementById('proceso_id');
            const proceso_id = procesoSelect ? procesoSelect.value : null;

            const departamentoData = {
                departamento: departamentoNombre,
                propiedad_id: propiedad_id,
                proceso_id: proceso_id // ← agregado aquí
            };



            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(departamentoData),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    console.error('Detalles del error:', errorData);
                    showCustomModal('Error al agregar el departamento: ' + errorData.message, 'alert');
                    return;
                }

                const responseData = await response.json();
                showCustomModal(responseData.message, 'alert', () => {
                    departamentoInput.value = '';
                    const selectedPropiedad = propiedadSelect ? propiedadSelect.value : '';
                    loadDepartamentos(selectedPropiedad, '');
                });
            } catch (error) {
                console.error('Error al agregar departamento:', error);
                showCustomModal('Error de conexión al agregar el departamento.', 'alert');
            }
        });
    }

    const propiedadSelect = document.getElementById('propiedad');
    const searchInput = document.getElementById('filtro-departamento');

    if (propiedadSelect) {
        propiedadSelect.addEventListener('change', () => {
            const selectedPropiedad = propiedadSelect.value;
            const searchTerm = searchInput ? searchInput.value : '';
            loadDepartamentos(selectedPropiedad, searchTerm);
        });
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', () => {
            const selectedPropiedad = propiedadSelect ? propiedadSelect.value : '';
            const searchTerm = searchInput.value;
            loadDepartamentos(selectedPropiedad, searchTerm);
        });
    }

    setTimeout(() => {
        const initialPropiedad = propiedadSelect ? propiedadSelect.value : '';
        loadDepartamentos(initialPropiedad);
    }, 100);
});

window.deleteDepartamento = deleteDepartamento;
window.updateDepartamento = updateDepartamento;
