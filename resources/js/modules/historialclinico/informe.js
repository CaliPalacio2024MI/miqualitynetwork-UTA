function filtroReporte() {
    // Obtención de referencias a los elementos select
    const propiedadSelect = document.getElementById('propiedad');
    const departamentoSelect = document.getElementById('departamento');
    const puestoSelect = document.getElementById('puesto');

    // Validación: Asegurarse de que todos los selectores existen en el DOM
    if (!propiedadSelect || !departamentoSelect || !puestoSelect) {
        console.warn("Uno o más de los selectores (propiedad, departamento, puesto) no existen en el DOM. Asegúrate de que los IDs son correctos.");
        return; // Detener la ejecución si faltan elementos
    }

    /**
     * Carga los departamentos de la API basándose en la propiedad seleccionada.
     * Una vez cargados, también actualiza las estadísticas.
     * @param {string} propiedadNombre - El nombre de la propiedad seleccionada.
     */
    function cargarDepartamentosPorPropiedad(propiedadNombre = '') {
        // Limpiar y resetear los selects de departamento y puesto
        departamentoSelect.innerHTML = '<option value="">Todos</option>';
        puestoSelect.innerHTML = '<option value="">Todos</option>';

        // Si no hay una propiedad seleccionada, actualizar estadísticas con filtros vacíos
        if (!propiedadNombre) {
            window.actualizarEstadisticas(puestoSelect.value, propiedadSelect.value, departamentoSelect.value);
            return;
        }

        // Realizar la petición fetch para obtener los departamentos
        fetch(`/api/departamentos/${encodeURIComponent(propiedadNombre)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Llenar el select de departamentos
                data.forEach(dep => {
                    const option = document.createElement('option');
                    option.value = dep.departamento; // El valor de la opción es el NOMBRE del departamento
                    option.textContent = dep.departamento;
                    option.dataset.id = dep.id; // Guardar el ID del departamento en un atributo de datos para futuras peticiones
                    departamentoSelect.appendChild(option);
                });

                // Después de cargar los departamentos, actualizar las estadísticas.
                // Esto asegura que las estadísticas se refresquen cuando cambia la propiedad,
                // incluso si los selects de departamento/puesto están en "Todos".
                window.actualizarEstadisticas(puestoSelect.value, propiedadSelect.value, departamentoSelect.value);
            })
            .catch(error => console.error('Error al cargar departamentos:', error));
    }

    /**
     * Carga los puestos de la API basándose en el ID del departamento seleccionado.
     * Una vez cargados, también actualiza las estadísticas.
     * @param {string} departamentoId - El ID del departamento seleccionado.
     */
    function cargarPuestosPorDepartamento(departamentoId = '') {
        // Limpiar y resetear el select de puesto
        puestoSelect.innerHTML = '<option value="">Todos</option>';

        // Si no hay un ID de departamento válido, actualizar estadísticas con los filtros actuales
        if (!departamentoId) {
            window.actualizarEstadisticas(puestoSelect.value, propiedadSelect.value, departamentoSelect.value);
            return;
        }

        // Realizar la petición fetch para obtener los puestos
        fetch(`/api/puestos/${encodeURIComponent(departamentoId)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Llenar el select de puestos
                data.forEach(puesto => {
                    const option = document.createElement('option');
                    option.value = puesto.puesto; // El valor de la opción es el NOMBRE del puesto
                    option.textContent = puesto.puesto;
                    // No necesitamos el data-id aquí a menos que haya otro nivel de filtrado
                    puestoSelect.appendChild(option);
                });

                // Después de cargar los puestos, actualizar las estadísticas.
                // Esto asegura que las estadísticas se refresquen con el nuevo filtro de puesto.
                window.actualizarEstadisticas(puestoSelect.value, propiedadSelect.value, departamentoSelect.value);
            })
            .catch(error => console.error('Error al cargar puestos:', error));
    }

    // --- Lógica de Inicialización y Event Listeners ---

    // 1. Carga inicial de departamentos y puestos (sin filtro de propiedad al inicio)
    // Esto inicializará los selects y llamará a actualizarEstadisticas con valores vacíos.
    cargarDepartamentosPorPropiedad('');

    // 2. Listener para cuando cambia la propiedad seleccionada
    propiedadSelect.addEventListener('change', function () {
        // Cuando la propiedad cambia, recargar los departamentos y puestos
        cargarDepartamentosPorPropiedad(this.value);
        // Nota: actualizarEstadisticas se llama dentro de cargarDepartamentosPorPropiedad
    });

    // 3. Listener para cuando cambia el departamento seleccionado
    departamentoSelect.addEventListener('change', function () {
        // Obtener la opción de departamento seleccionada para extraer su ID
        const selectedOption = this.options[this.selectedIndex];
        // Usar el data-id para la llamada a la API de puestos
        const departamentoId = selectedOption.dataset.id || '';
        cargarPuestosPorDepartamento(departamentoId);
        // Nota: actualizarEstadisticas se llama dentro de cargarPuestosPorDepartamento
    });

    // 4. Listener para cuando cambia el puesto seleccionado
    puestoSelect.addEventListener('change', function () {
        // Cuando el puesto cambia, simplemente actualizar las estadísticas
        window.actualizarEstadisticas(this.value, propiedadSelect.value, departamentoSelect.value);
    });
}

// Hacer la función filtroReporte accesible globalmente
window.filtroReporte = filtroReporte;
function filtrarTabla() {
    const propiedad = document.getElementById('propiedad').value;
    const puesto = document.getElementById('puesto').value;
    const enfermedadInput = document.getElementById('opcion-input').value.trim().toLowerCase();
    const params = new URLSearchParams();

    if (propiedad) params.append('hotel', propiedad);
    if (puesto) params.append('puesto', puesto);
    if (enfermedadInput) params.append('enfermedad', enfermedadInput); // Nuevo

    fetch(`/api/filtrar-empleados?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('.contenedor table tbody');

            // Limpiar tabla actual
            tbody.innerHTML = '';

            if (data.length > 0) {
                data.forEach(persona => {
                    const fechaRealizacion = persona.created_at
                    ? new Date(persona.created_at).toLocaleString('es-MX', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    })
                    : 'N/A';

                    const historial = persona.updated_at
                    ? new Date(persona.updated_at).toLocaleString('es-MX', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    }).replace(',', '')
                    : 'N/A';
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${persona.nombre}</td>
                        <td>${persona.genero}</td>
                        <td>${persona.razon_social}</td>
                        <td>${persona.departamento}</td>
                        <td>${persona.puesto_aspirante}</td>
                        <td>${fechaRealizacion}</td>
                        <td>${historial}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="4">No se encontraron personas con los criterios especificados.</td>`;
                tbody.appendChild(tr);
            }
        })
        .catch(error => {
            console.error('Error al filtrar:', error);
        });
}
window.filtrarTabla = filtrarTabla;

function reporteTabla() {
    const propiedad = document.getElementById('propiedad').value;
    const puesto = document.getElementById('puesto').value;
    const nombre = document.getElementById('nombre').value;

    const params = new URLSearchParams();

    if (propiedad) params.append('hotel', propiedad);
    if (puesto) params.append('puesto', puesto);
    if (nombre) params.append('nombre', nombre  );


    fetch(`/api/filtrar-empleados?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('.contenedor table tbody');

            // Limpiar tabla actual
            tbody.innerHTML = '';

            if (data.length > 0) {
               data.forEach(persona => {
const fechaRealizacion = persona.created_at
    ? new Date(persona.created_at).toLocaleString('es-MX', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
      })
    : 'N/A';

    const historial = persona.updated_at
    ? new Date(persona.updated_at).toLocaleString('es-MX', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      }).replace(',', '')
    : 'N/A';
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td>${persona.nombre}</td>
        <td>${persona.genero}</td>
        <td>${persona.razon_social}</td>
        <td>${persona.departamento}</td>
        <td>${persona.puesto_aspirante}</td>
        <td>${fechaRealizacion}</td>
        <td>${historial}</td>
        <td>
            <button class="btn-editar" onclick="mostrarRegistro(${persona.id})">
                <img src="/images/ojo.png" alt="ojo-icon" class="iconos">
            </button>
            <button class="btn-editar" onclick="editRegister(${persona.id})">
                <img src="/images/editar.png" alt="editar-icon" class="iconos">
            </button>
            <a class="btn-editar" href="/empleado/pdf/${persona.id}">
                <img src="/images/descargar.png" alt="descargar-icon" class="iconos">
            </a>
        </td>
    `;
    tbody.appendChild(tr);
});

            } else {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="4">No se encontraron personas con los criterios especificados.</td>`;
                tbody.appendChild(tr);
            }
        })
        .catch(error => {
            console.error('Error al filtrar:', error);
        });
}
    window.reporteTabla = reporteTabla;
