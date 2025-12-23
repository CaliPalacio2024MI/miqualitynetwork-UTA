// moduloAgentes.js

/**
 * Muestra un modal personalizado para alertas, confirmaciones o prompts.
 * Se asume que este modal está definido globalmente o en layouts.
 * @param {string} message El mensaje a mostrar en el modal.
 * @param {'alert'|'confirm'|'prompt'} type El tipo de modal (alert, confirm, prompt).
 * @param {function(boolean|string|null): void} [callback] La función a ejecutar cuando se cierra el modal.
 */
function showCustomModal(message, type = 'alert', callback = null) {
    const modalContainer = document.getElementById('custom-modal-container');
    const modalMessage = document.getElementById('custom-modal-message');
    const modalConfirmBtn = document.getElementById('custom-modal-confirm-btn');
    const modalCancelBtn = document.getElementById('custom-modal-cancel-btn');
    const modalInput = document.getElementById('custom-modal-input');

    modalMessage.textContent = message;
    modalInput.value = ''; // Limpiar cualquier valor anterior del input

    // Resetear estilos y eventos para evitar conflictos
    modalConfirmBtn.style.display = 'inline-block';
    modalCancelBtn.style.display = 'none'; // Por defecto, ocultar el botón de cancelar
    modalInput.style.display = 'none'; // Por defecto, ocultar el input

    // Establecer el texto de los botones del modal
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
            if (callback) callback(null); // Retornar null si se cancela el prompt
        };
    } else { // type === 'alert'
        modalConfirmBtn.textContent = 'Aceptar';
        modalConfirmBtn.onclick = () => {
            modalContainer.classList.add('hidden');
            if (callback) callback();
        };
    }

    modalContainer.classList.remove('hidden');
}


/**
 * Carga y muestra la lista de agentes filtrados por término de búsqueda.
 * @param {string} searchTerm El término de búsqueda para el nombre del agente.
 */
async function loadAgentes(searchTerm = '') {
    const agentesList = document.getElementById('agentes-list');
    if (!agentesList) {
        console.error("El elemento 'agentes-list' no fue encontrado.");
        return;
    }
    agentesList.innerHTML = '<li class="loading-indicator">Cargando agentes...</li>'; // Indicador de carga

    try {
        let url;
        if (searchTerm) {
            const encodedSearchTerm = encodeURIComponent(searchTerm);
            url = `/agentes/buscar/${encodedSearchTerm}`;
        } else {
            url = `/agentes/todos`; // Ruta para obtener todos los agentes
        }

        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const agentes = await response.json();

        agentesList.innerHTML = ''; // Limpiar lista
        if (agentes.length === 0) {
            agentesList.innerHTML = '<li class="no-results">No se encontraron agentes.</li>';
            return;
        }

        agentes.forEach(agente => {
            const li = document.createElement('li');
            li.dataset.id = agente.id; // Asumiendo que el ID del agente es 'id'
            li.innerHTML = `
                <span>${agente.agente}</span>
                <div class="btn-container-right">
                    <button class="btn-editar" onclick="updateAgente('${agente.id}', '${document.querySelector('meta[name="csrf-token"]').content}')">
                        <img src="/images/editar.png" alt="editar-icon" class="iconos">
                    </button>
                    <button class="btn-eliminar" onclick="deleteAgente('${agente.id}', '${document.querySelector('meta[name="csrf-token"]').content}')">
                        <img src="/images/iconodeborrar.png" alt="editar-icon" class="iconos">
                    </button>
                </div>
            `;
            agentesList.appendChild(li);
        });
    } catch (error) {
        console.error('Error al cargar agentes:', error);
        agentesList.innerHTML = '<li class="error-loading">Error al cargar agentes.</li>';
        showCustomModal('Error al cargar los agentes. Por favor, inténtalo de nuevo más tarde.', 'alert');
    }
}

/**
 * Elimina un agente.
 * @param {string} agenteId El ID del agente a eliminar.
 * @param {string} csrfToken El token CSRF.
 */
function deleteAgente(agenteId, csrfToken) {
    showCustomModal('¿Estás seguro de que quieres eliminar este agente?', 'confirm', async (result) => {
        if (result) {
            try {
                const response = await fetch(`/agentes/${agenteId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    showCustomModal('Agente eliminado con éxito.', 'alert', () => {
                        loadAgentes(); // Recargar la lista de agentes después de eliminar
                    });
                } else {
                    const errorData = await response.json();
                    showCustomModal(`Error al eliminar el agente: ${errorData.message || response.statusText}`, 'alert');
                }
            } catch (error) {
                console.error('Error:', error);
                showCustomModal('Error al eliminar el agente.', 'alert');
            }
        }
    });
}

/**
 * Actualiza un agente.
 * @param {string} agenteId El ID del agente a actualizar.
 * @param {string} csrfToken El token CSRF.
 */
function updateAgente(agenteId, csrfToken) {
    showCustomModal("Ingrese el nuevo nombre del agente:", 'prompt', async (nuevoNombre) => {
        if (nuevoNombre) { // Solo si el usuario ingresó un valor (no null o cadena vacía)
            try {
                const response = await fetch(`/agentes/${agenteId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ agente: nuevoNombre }), // Se envía 'agente'
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || "Error al actualizar el agente");
                }

                await response.json(); // Consumir la respuesta

                showCustomModal('Agente actualizado con éxito.', 'alert', () => {
                    // Actualizar el texto del elemento en la lista sin recargar toda la lista
                    const agenteElement = document.querySelector(`li[data-id="${agenteId}"] span`);
                    if (agenteElement) {
                        agenteElement.textContent = nuevoNombre;
                    }
                });
            } catch (error) {
                console.error("Error al actualizar el agente:", error);
                showCustomModal(`Error al actualizar el agente: ${error.message}`, 'alert');
            }
        }
    });
}

// Event listener para el envío del formulario de agregar agente
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector(`form[action="${window.agentesStoreRoute}"]`);
    if (form) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevenir el envío tradicional del formulario

            const formData = new FormData(form);
            const agenteData = {};
            formData.forEach((value, key) => {
                agenteData[key] = value;
            });

 try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json', // Asegúrate de que esta línea esté aquí
                    },
                    body: JSON.stringify(agenteData),
                });

                if (response.ok) {
                    const responseData = await response.json();
                    showCustomModal(responseData.message, 'alert', () => {
                        const agenteInput = document.getElementById('agente');
                        if (agenteInput) {
                            agenteInput.value = '';
                        }
                        loadAgentes();
                    });
                } else {
                    // --- INICIO DE LA MODIFICACIÓN IMPORTANTE ---
                    let errorData;
                    try {
                        // Intenta parsear la respuesta como JSON
                        errorData = await response.json();
                    } catch (e) {
                        // Si falla, significa que la respuesta no es JSON (ej. HTML de error)
                        const textError = await response.text(); // Captura el texto HTML completo
                        console.error('El servidor devolvió un error inesperado (no es JSON):', textError);
                        showCustomModal(
                            `Error inesperado del servidor (Código: ${response.status}). La respuesta no es JSON. Por favor, revisa la consola del navegador para más detalles.`,
                            'alert'
                        );
                        return; // Sal del handler ya que no pudimos procesar la respuesta como JSON
                    }

                    // Si llegamos aquí, la respuesta fue JSON, pero con un status que no es OK (ej. 422 Unprocessable Entity por validación)
                    let errorMessage = 'Error al agregar el agente.';
                    if (errorData.errors) { // Si hay errores de validación específicos
                        errorMessage += '\n' + Object.values(errorData.errors).flat().join('\n');
                    } else if (errorData.message) { // Si hay un mensaje general de error
                        errorMessage += '\n' + errorData.message;
                    } else if (response.status === 419) { // Caso específico de CSRF (aunque debería dar JSON si Accept es application/json)
                         errorMessage = 'La sesión ha expirado. Por favor, recargue la página.';
                    } else {
                        errorMessage += `\nCódigo de estado: ${response.status}`;
                    }
                    showCustomModal(errorMessage, 'alert');
                    // --- FIN DE LA MODIFICACIÓN IMPORTANTE ---
                }
            }
            catch (error) {
                console.error('Error al agregar agente:', error);
                showCustomModal('Error de conexión al agregar el agente. Por favor, verifica tu conexión a internet o la URL del servidor.', 'alert');
            }
        });
    }

    // Event listener para el campo de búsqueda de agentes
    const searchInput = document.getElementById('filtro-agente');
    if (searchInput) {
        searchInput.addEventListener('keyup', () => {
            loadAgentes(searchInput.value);
        });
    }

    // Cargar agentes al inicio de la página
    loadAgentes();
});

// Exponer funciones globalmente para que puedan usarse desde HTML inline onclick=""
window.deleteAgente = deleteAgente;
window.updateAgente = updateAgente;
// Nota: showCustomModal ya está global en el alcance de este script, si necesitas que sea accesible desde HTML, también expónlo.