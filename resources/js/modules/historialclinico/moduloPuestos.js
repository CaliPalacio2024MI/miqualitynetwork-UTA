// moduloPuestos.js

/**
 * Muestra un modal personalizado para alertas, confirmaciones o prompts.
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
 * Carga los departamentos asociados a una propiedad seleccionada.
 * @param {string} propiedadName El nombre de la propiedad.
 */
async function loadDepartamentosByPropiedad(propiedadId) {
    const departamentoSelect = document.getElementById('selectDepartamentoP');
    if (!departamentoSelect) return;

    departamentoSelect.innerHTML = '<option value="">Cargando...</option>';
    departamentoSelect.disabled = true;

    try {
        const response = await fetch(`/anfitriones/departamentos/${propiedadId}`);
        if (!response.ok) throw new Error(`Error ${response.status}`);
        const departamentos = await response.json();

        departamentoSelect.innerHTML = '<option value="">Seleccione un departamento</option>';
        departamentos.forEach(dep => {
            const option = document.createElement('option');
            option.value = dep.departamento;
            option.textContent = dep.departamento;
            departamentoSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar departamentos:', error);
        departamentoSelect.innerHTML = '<option value="">Error al cargar</option>';
    } finally {
        departamentoSelect.disabled = false;
    }
}


/**
 * Carga y muestra la lista de puestos filtrados por departamento y propiedad, y/o término de búsqueda.
 * @param {string} departamentoId El ID del departamento seleccionado.
 * @param {string} propiedadId El ID de la propiedad seleccionada.
 * @param {string} searchTerm El término de búsqueda para el nombre del puesto.
 */
async function loadPuestos(departamentoId = '', propiedadId = '', searchTerm = '') {
    const puestosList = document.getElementById('puestos-list');
    if (!puestosList) {
        console.error("El elemento 'puestos-list' no fue encontrado.");
        return;
    }
    puestosList.innerHTML = '<li class="loading-indicator">Cargando puestos...</li>'; // Indicador de carga

    try {
        let url;
        if (departamentoId && propiedadId) {
            // Codificar los IDs por si acaso, aunque para IDs numéricos no es estrictamente necesario.
            const encodedDepartamentoId = encodeURIComponent(departamentoId);
            const encodedPropiedadId = encodeURIComponent(propiedadId);

            if (searchTerm) {
                const encodedSearchTerm = encodeURIComponent(searchTerm);
                url = `/puestos/buscar/${encodedDepartamentoId}/${encodedPropiedadId}/${encodedSearchTerm}`;
            } else {
                url = `/puestos/departamento/${encodedDepartamentoId}/propiedad/${encodedPropiedadId}`;
            }
        } else {
            puestosList.innerHTML = '<li class="no-results">Seleccione una propiedad y un departamento para ver los puestos.</li>';
            return;
        }

        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const puestos = await response.json();

        puestosList.innerHTML = ''; // Limpiar lista
        if (puestos.length === 0) {
            puestosList.innerHTML = '<li class="no-results">No se encontraron puestos para el departamento y propiedad seleccionados.</li>';
            return;
        }

        puestos.forEach(puesto => {
            const li = document.createElement('li');
            li.dataset.id = puesto.id;
            li.dataset.departamentoId = puesto.departamento_id;
            li.dataset.propiedadId = puesto.propiedad_id;
            li.innerHTML = `
                <span>${puesto.puesto}</span>
                <div class="btn-container-right">
                    <button class="btn-editar" onclick="updatePuesto('${puesto.id}', '${document.querySelector('meta[name="csrf-token"]').content}')">
                        <img src="${window.editIconPath}" alt="editar-icon" class="iconos">
                    </button>
                    <button class="btn-eliminar" onclick="deletePuesto('${puesto.id}', '${document.querySelector('meta[name="csrf-token"]').content}')">
                        <img src="${window.deleteIconPath}" alt="eliminar-icon" class="iconos">
                    </button>
                </div>
            `;
            puestosList.appendChild(li);
        });


    } catch (error) {
        console.error('Error al cargar puestos:', error);
        puestosList.innerHTML = '<li class="error-loading">Error al cargar puestos.</li>';
        showCustomModal('Error al cargar los puestos. Por favor, inténtalo de nuevo más tarde.', 'alert');
    }
}

/**
 * Elimina un puesto.
 * @param {string} puestoId El ID del puesto a eliminar.
 * @param {string} csrfToken El token CSRF.
 */
function eliminarPuesto(id) {
    showCustomModal('⚠️ ¿Estás seguro de eliminar este puesto?', 'confirm', async (result) => {
        if (!result) return;

        try {
            const response = await fetch(`/puestos/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                showCustomModal('Puesto eliminado con éxito.', 'alert', () => {
                    // Recargar la lista
                    const propiedadId = document.getElementById('propiedad_id')?.value;
                    const departamentoId = document.getElementById('departamento_id')?.value;
                    if (propiedadId && departamentoId) {
                        loadPuestos(departamentoId, propiedadId);
                    }
                });
            } else {
                const err = await response.json();
                showCustomModal(`Error al eliminar el puesto: ${err.message}`, 'alert');
            }
        } catch (e) {
            console.error(e);
            showCustomModal('Error al eliminar el puesto.', 'alert');
        }
    });
}



/**
 * Actualiza un puesto.
 * @param {string} puestoId El ID del puesto a actualizar.
 * @param {string} csrfToken El token CSRF.
 */
function updatePuesto(puestoId, csrfToken) {
    showCustomModal("Ingrese el nuevo nombre del puesto:", 'prompt', async (nuevoNombre) => {
        if (nuevoNombre) {
            try {
                const response = await fetch(`/puestos/${puestoId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ puesto: nuevoNombre }),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || "Error al actualizar el puesto");
                }

                await response.json();

                showCustomModal('Puesto actualizado con éxito.', 'alert', () => {
                    const puestoElement = document.querySelector(`li[data-id="${puestoId}"] span`);
                    if (puestoElement) {
                        puestoElement.textContent = nuevoNombre;
                    }
                });
            } catch (error) {
                console.error("Error al actualizar el puesto:", error);
                showCustomModal(`Error al actualizar el puesto: ${error.message}`, 'alert');
            }
        }
    });
}



// Event listener para el envío del formulario de agregar puesto
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector(`form[action="${window.puestosStoreRoute}"]`);
    if (form) {
        form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevenir el envío tradicional del formulario

        const formData = new FormData(form);
        const puestoData = {};
        formData.forEach((value, key) => {
            puestoData[key] = value;
        });

        const procesoSelect = document.getElementById('proceso_id');
        const proceso_id = procesoSelect ? procesoSelect.value : null;
        puestoData['proceso_id'] = proceso_id;
        
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(puestoData),
                });

                if (response.ok) {
                    const responseData = await response.json();
                    showCustomModal(responseData.message, 'alert', () => {
                        // Limpiar el campo de entrada del puesto
                        const puestoInput = document.getElementById('puesto');
                        if (puestoInput) {
                            puestoInput.value = '';
                        }
                        // Recargar la lista de puestos para mostrar el nuevo
                        const propiedadSelect = document.getElementById('propiedad_id');
                        const departamentoSelect = document.getElementById('departamento_id');
                        const selectedPropiedadId = propiedadSelect ? propiedadSelect.value : '';
                        const selectedDepartamentoId = departamentoSelect ? departamentoSelect.value : '';
                        
                        if (selectedDepartamentoId && selectedPropiedadId) {
                            loadPuestos(selectedDepartamentoId, selectedPropiedadId, ''); // Cargar sin término de búsqueda
                        } else {
                            // Si no hay departamento o propiedad seleccionados, limpiar la lista
                            document.getElementById('puestos-list').innerHTML = '<li class="no-results">Seleccione una propiedad y un departamento para ver los puestos.</li>';
                        }
                    });
                } else {
                    const errorData = await response.json();
                    let errorMessage = 'Error al agregar el puesto.';
                    if (errorData.errors) {
                        errorMessage += '\n' + Object.values(errorData.errors).flat().join('\n');
                    } else if (errorData.message) {
                        errorMessage += '\n' + errorData.message;
                    }
                    showCustomModal(errorMessage, 'alert');
                }
            }
            catch (error) {
                console.error('Error al agregar puesto:', error);
                showCustomModal('Error de conexión al agregar el puesto.', 'alert');
            }
        });
    }

    // Event listeners para cargar departamentos y puestos
    const propiedadSelect = document.getElementById('propiedad_id');
    const departamentoSelect = document.getElementById('departamento_id');
    const searchInput = document.getElementById('filtro-puesto');

    if (propiedadSelect) {
        propiedadSelect.addEventListener('change', () => {
            // Obtener el TEXTO de la opción seleccionada, no el value (ID)
            const selectedOption = propiedadSelect.options[propiedadSelect.selectedIndex];
            const selectedPropiedadName = selectedOption ? selectedOption.textContent : '';
            
            if (selectedPropiedadName) {
                loadDepartamentosByPropiedad(selectedPropiedadName); // Cargar departamentos al cambiar la propiedad
            } else {
                departamentoSelect.innerHTML = '<option value="" disabled selected>Seleccione un departamento</option>';
            }
            
            // Limpiar y resetear la lista de puestos cuando cambia la propiedad
            document.getElementById('puestos-list').innerHTML = '<li class="no-results">Seleccione un departamento para ver los puestos.</li>';
            departamentoSelect.value = ""; // Resetear el select de departamento
        });
    }

    if (departamentoSelect) {
        departamentoSelect.addEventListener('change', () => {
            const selectedPropiedadId = propiedadSelect ? propiedadSelect.value : ''; // Aquí sí necesitamos el ID de la propiedad para cargar puestos
            const selectedDepartamentoId = departamentoSelect.value;
            const searchTerm = searchInput ? searchInput.value : '';
            if (selectedPropiedadId && selectedDepartamentoId) {
                loadPuestos(selectedDepartamentoId, selectedPropiedadId, searchTerm);
            } else {
                document.getElementById('puestos-list').innerHTML = '<li class="no-results">Seleccione una propiedad y un departamento para ver los puestos.</li>';
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', () => {
            const selectedPropiedadId = propiedadSelect ? propiedadSelect.value : '';
            const selectedDepartamentoId = departamentoSelect ? departamentoSelect.value : '';
            const searchTerm = searchInput.value;
            if (selectedPropiedadId && selectedDepartamentoId) {
                loadPuestos(selectedDepartamentoId, selectedPropiedadId, searchTerm);
            } else {
                document.getElementById('puestos-list').innerHTML = '<li class="no-results">Seleccione una propiedad y un departamento para ver los puestos.</li>';
            }
        });
    }

    // Cargar departamentos inicialmente si ya hay una propiedad seleccionada (ej. al recargar la página con un valor preseleccionado)
    // ... tu setTimeout ya existente:
    setTimeout(() => {
        if (propiedadSelect && propiedadSelect.value) {
            const selectedOption = propiedadSelect.options[propiedadSelect.selectedIndex];
            const selectedPropiedadName = selectedOption ? selectedOption.textContent : '';
            if (selectedPropiedadName) {
                loadDepartamentosByPropiedad(selectedPropiedadName);
            }
        }
        document.getElementById('puestos-list').innerHTML = '<li class="no-results">Seleccione una propiedad y un departamento para ver los puestos.</li>';
    }, 100);

    // 👇 ESTO ES LO NUEVO PA ANFITRIONES 👇
    const propiedadA = document.getElementById('propiedad_id');
    const departamentoA = document.getElementById('selectDepartamentoP');
    const puestoA = document.getElementById('selectPuestoP');

    if (propiedadA && departamentoA) {
        propiedadA.addEventListener('change', async () => {
            const propiedadId = propiedadA.value;
            departamentoA.innerHTML = '<option value="">Cargando departamentos...</option>';
            departamentoA.disabled = true;

            try {
                const res = await fetch(`/anfitriones/departamentos/${propiedadId}`);
                const data = await res.json();

                departamentoA.innerHTML = '<option value="">Seleccione un departamento</option>';
                data.forEach(dep => {
                    const opt = document.createElement('option');
                    opt.value = dep.id;
                    opt.textContent = dep.departamento;
                    departamentoA.appendChild(opt);
                });
                departamentoA.disabled = false;
            } catch (e) {
                console.error(e);
                departamentoA.innerHTML = '<option value="">Error al cargar</option>';
                departamentoA.disabled = false;
            }

            if (puestoA) {
                puestoA.innerHTML = '<option value="">Seleccione un puesto</option>';
                puestoA.disabled = true;
            }
        });

        departamentoA.addEventListener('change', async () => {
            const dep = departamentoA.value;
            if (!puestoA) return;
            puestoA.innerHTML = '<option value="">Cargando puestos...</option>';
            puestoA.disabled = true;

            try {
                const res = await fetch(`/anfitriones/puestos/${dep}`);
                const data = await res.json();

                puestoA.innerHTML = '<option value="">Seleccione un puesto</option>';
                data.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.puesto;
                    puestoA.appendChild(opt);
                });
                puestoA.disabled = false;
            } catch (e) {
                console.error(e);
                puestoA.innerHTML = '<option value="">Error al cargar puestos</option>';
                puestoA.disabled = false;
            }
        });
    }
});


// Exponer funciones globalmente para que puedan usarse desde HTML inline onclick=""
window.deletePuesto = eliminarPuesto;
window.updatePuesto = updatePuesto;


////////////////////////////////////////////////////////////////////////////////////
 document.addEventListener('DOMContentLoaded', () => {
        const selProp = document.getElementById('selectPropiedad');
        const selDep = document.getElementById('selectDepartamento');
        const lista = document.getElementById('puestos-list');
        const filtro = document.getElementById('filtro-puesto');

        function renderPuestos(puestos) {
            lista.innerHTML = ''; // Limpiar

            if (puestos.length === 0) {
                lista.innerHTML = '<li>No hay puestos registrados.</li>';
                return;
            }

            puestos.forEach(p => {
                const li = document.createElement('li');
                li.classList.add('puesto-item');
                li.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>${p.puesto}</span>
                    <div style="display: flex; gap: 8px;">
                        <button onclick="editarPuesto(${p.id}, '${p.puesto}')" title="Editar">
                            <img src="${window.editIconPath}" alt="Editar" width="20">
                        </button>
                        <button onclick="eliminarPuesto(${p.id})" title="Eliminar">
                            <img src="${window.deleteIconPath}" alt="Eliminar" width="20">
                        </button>
                    </div>
                </div>
            `;
                lista.appendChild(li);
            });
        }

        function cargarPuestos(propiedadId, departamentoId) {
            if (!propiedadId || !departamentoId) return;

            fetch(`/puestos/filtrar/${propiedadId}/${departamentoId}`)
                .then(res => res.json())
                .then(data => renderPuestos(data))
                .catch(err => {
                    console.error(err);
                    lista.innerHTML = '<li>Error al cargar puestos.</li>';
                });
        }

        selProp?.addEventListener('change', e => {
            const propId = e.target.value;
            selDep.innerHTML = '<option value="">Cargando departamentos…</option>';

            fetch(`/propiedades/${propId}/departamentos`)
                .then(res => res.json())
                .then(data => {
                    selDep.innerHTML = '<option value="">-- Seleccione un departamento --</option>';
                    data.forEach(d => {
                        selDep.appendChild(new Option(d.departamento, d.id));
                    });
                });
        });

        selDep?.addEventListener('change', () => {
            cargarPuestos(selProp.value, selDep.value);
        });

        filtro?.addEventListener('input', () => {
            const filtroTexto = filtro.value.toLowerCase();
            const items = lista.querySelectorAll('li');
            items.forEach(li => {
                const texto = li.textContent.toLowerCase();
                li.style.display = texto.includes(filtroTexto) ? 'block' : 'none';
            });
        });

        // Cargar los puestos al cargar la página si ya hay selección
        if (selProp?.value && selDep?.value) {
            cargarPuestos(selProp.value, selDep.value);
        }

        // Función global para eliminar
        window.eliminarPuesto = function(id) {
            if (!confirm('¿Estás seguro de eliminar este puesto?')) return;

            fetch(`/puestos/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(res => {
                if (res.ok) cargarPuestos(selProp.value, selDep.value);
                else alert('Error al eliminar el puesto.');
            });
        };

        // Función global para editar (con prompt temporal)
        window.editarPuesto = function(id, nombreActual) {
            const nuevo = prompt('Nuevo nombre para el puesto:', nombreActual);
            if (!nuevo || nuevo === nombreActual) return;

            fetch(`/puestos/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    puesto: nuevo
                })
            }).then(res => {
                if (res.ok) cargarPuestos(selProp.value, selDep.value);
                else alert('Error al actualizar el puesto.');
            });
        };
    });