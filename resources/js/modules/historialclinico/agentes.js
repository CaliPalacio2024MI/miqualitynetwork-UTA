window.mostrarInputAgente = function(select) {
    const inputAgente = select.closest('.agent-wrapper').querySelector('.input-agente');
    
    // Mostrar el campo de texto solo si la opción seleccionada es "Otros"
    if (select.value === "Otros") {
        inputAgente.style.display = 'block';
    } else {
        inputAgente.style.display = 'none';
    }
}


window.agregarAgente = function () {
    const agenteWrapper = document.querySelector('.agents-list-antecedentes td .agent-wrapper');
    const nuevaAgente = document.createElement('div');
    nuevaAgente.classList.add('agent-wrapper');

    // Obtener el HTML del select oculto
    const templateSelect = document.getElementById('agentes-options-template');
    const clonedOptions = templateSelect.innerHTML;

    nuevaAgente.innerHTML = `
        <div class="agent-select">
            <select name="agentes[]" class="line-input" onchange="mostrarInputAgente(this)">
                ${clonedOptions}
            </select>
        </div>
        <div class="input-agente" style="display: none;">
            <input type="text" class="line-input" name="tipo-agente[]" placeholder="Especificar tipo de agente">
        </div>
    `;

    agenteWrapper.appendChild(nuevaAgente);
};


// Función para agregar más campos de Empresa, Puesto y Tiempo dentro de sus respectivos <td>
window.agregarCampos = function() {
    // Se agregan más campos de texto en los td de Empresa, Puesto y Tiempo
    const empresaTd = document.querySelector('.agents-list-antecedentes td:nth-child(1)');
    const puestoTd = document.querySelector('.agents-list-antecedentes td:nth-child(2)');
    const tiempoTd = document.querySelector('.agents-list-antecedentes td:nth-child(3)');

    // Agregar un nuevo campo de texto a cada columna (Empresa, Puesto, Tiempo)
    const nuevoCampoEmpresa = document.createElement('input');
    nuevoCampoEmpresa.type = 'text';
    nuevoCampoEmpresa.classList.add('line-input');
    nuevoCampoEmpresa.name = 'empresa[]';  // Cambié de empresa- a empresa[]

    const nuevoCampoPuesto = document.createElement('input');
    nuevoCampoPuesto.type = 'text';
    nuevoCampoPuesto.classList.add('line-input');
    nuevoCampoPuesto.name = 'puesto[]';  // Cambié de puesto- a puesto[]

    const nuevoCampoTiempo = document.createElement('input');
    nuevoCampoTiempo.type = 'text';
    nuevoCampoTiempo.classList.add('line-input');
    nuevoCampoTiempo.name = 'tiempo[]';  // Cambié de tiempo- a tiempo[]

    // Agregar los nuevos campos dentro de cada td
    empresaTd.appendChild(nuevoCampoEmpresa);
    puestoTd.appendChild(nuevoCampoPuesto);
    tiempoTd.appendChild(nuevoCampoTiempo);
}

// Función para eliminar los campos adicionales de Empresa, Puesto y Tiempo
window.eliminarCampos = function() {
    // Selecciona los <td> de Empresa, Puesto y Tiempo
    const empresaTd = document.querySelector('.agents-list-antecedentes td:nth-child(1)');
    const puestoTd = document.querySelector('.agents-list-antecedentes td:nth-child(2)');
    const tiempoTd = document.querySelector('.agents-list-antecedentes td:nth-child(3)');

    // Elimina el último campo de texto dentro de cada <td> si existe
    if (empresaTd.children.length > 1) {
        empresaTd.removeChild(empresaTd.lastElementChild);
    }
    if (puestoTd.children.length > 1) {
        puestoTd.removeChild(puestoTd.lastElementChild);
    }
    if (tiempoTd.children.length > 1) {
        tiempoTd.removeChild(tiempoTd.lastElementChild);
    }
}

// Función para eliminar el último agente añadido
window.eliminarAgente = function(){
    const agenteWrapper = document.querySelector('.agents-list-antecedentes td .agent-wrapper');
    const agentes = agenteWrapper.querySelectorAll('.agent-wrapper');
    if (agentes.length > 0) {
        // Eliminar el último agente
        agenteWrapper.removeChild(agentes[agentes.length - 1]);
    }
}
window.inicializarFormularioDinamico = function () {
    const propiedadSelect = document.getElementById('propiedad-select');
    const departamentoSelect = document.getElementById('departamento-select');
    const puestoSelect = document.getElementById('puesto-select');
    const form = document.querySelector('form'); // Aunque no lo usaremos para el submit handler, es bueno tenerlo

    // Si alguno de los elementos no existe, salimos de la función
    if (!form || !departamentoSelect || !puestoSelect) {
        console.warn("Alguno de los elementos del formulario no fue encontrado. Asegúrate de que los IDs 'propiedad-select', 'departamento-select', 'puesto-select' y el formulario existen.");
        return;
    }

    // Listener para cuando cambia la propiedad seleccionada
    propiedadSelect?.addEventListener('change', () => {
        // Realiza una petición fetch para obtener los departamentos basados en la propiedad
        fetch(`/api/departamentos/${encodeURIComponent(propiedadSelect.value)}`)
            .then(res => {
                if (!res.ok) {
                    throw new Error(`Error HTTP: ${res.status}`);
                }
                return res.json();
            })
            .then(data => {
                // Limpia las opciones actuales del select de departamento
                departamentoSelect.innerHTML = '<option value="" disabled selected>Seleccione un departamento</option>';
                // Añade las nuevas opciones de departamento
                data.forEach(dep => {
                    const opt = document.createElement('option');
                    // ¡CAMBIO CLAVE AQUÍ! El valor de la opción es el NOMBRE del departamento
                    opt.value = dep.departamento;
                    opt.textContent = dep.departamento;
                    // Guardamos el ID en un atributo de datos para la siguiente llamada fetch
                    opt.dataset.id = dep.id;
                    departamentoSelect.appendChild(opt);
                });
                // Resetea el select de puesto cuando cambia el departamento
                puestoSelect.innerHTML = '<option value="" disabled selected>Seleccione un puesto</option>';
            })
            .catch(error => console.error('Error al cargar departamentos:', error));
    });

    // Listener para cuando cambia el departamento seleccionado
    departamentoSelect.addEventListener('change', () => {
        // Obtener la opción de departamento seleccionada
        const selectedDepartamentoOption = departamentoSelect.options[departamentoSelect.selectedIndex];

        // Validar que la opción seleccionada no sea la de placeholder y que tenga un ID
        if (!selectedDepartamentoOption || selectedDepartamentoOption.disabled || !selectedDepartamentoOption.dataset.id) {
            console.warn("No se ha seleccionado un departamento válido o no tiene ID.");
            puestoSelect.innerHTML = '<option value="" disabled selected>Seleccione un puesto</option>'; // Limpiar puestos
            return;
        }

        // ¡CAMBIO CLAVE AQUÍ! Usamos el data-id para la petición fetch de puestos
        const departamentoIdParaFetch = selectedDepartamentoOption.dataset.id;

        fetch(`/api/puestos/${encodeURIComponent(departamentoIdParaFetch)}`)
            .then(res => {
                if (!res.ok) {
                    throw new Error(`Error HTTP: ${res.status}`);
                }
                return res.json();
            })
            .then(data => {
                // Limpia las opciones actuales del select de puesto
                puestoSelect.innerHTML = '<option value="" disabled selected>Seleccione un puesto</option>';
                // Añade las nuevas opciones de puesto
                data.forEach(p => {
                    const opt = document.createElement('option');
                    // ¡CAMBIO CLAVE AQUÍ! El valor de la opción es el NOMBRE del puesto
                    opt.value = p.puesto;
                    opt.textContent = p.puesto;
                    // No necesitamos data-id aquí a menos que haya otro select encadenado
                    puestoSelect.appendChild(opt);
                });
            })
            .catch(error => console.error('Error al cargar puestos:', error));
    });

    // Con esta estrategia, NO NECESITAS UN LISTENER 'submit'
    // para crear campos ocultos o deshabilitar los selects.
    // Los selects enviarán directamente los nombres porque su 'value' es el nombre.
};



window.mostrarCampoDiagnostico = function(select)  {
    const selectedValue = select.value;
    const row = select.closest('tr');
    const inputTexto = row.querySelector('.diagnostico-text');

    if (selectedValue !== "Ninguno") {
        inputTexto.style.display = 'block';
    } else {
        inputTexto.style.display = 'none';
        inputTexto.value = ''; // Limpiar campo si se oculta
    }
}

// Agregar nueva fila
window.agregarDiagnostico = function() {
    const diagnosticoRow = document.getElementById('diagnostico-row');
    const nuevaFila = diagnosticoRow.cloneNode(true);

    // Limpiar y ocultar input de texto
    const select = nuevaFila.querySelector('select');
    select.selectedIndex = 0;
    const inputTexto = nuevaFila.querySelector('.diagnostico-text');
    inputTexto.value = '';
    inputTexto.style.display = 'none';

    // Volver a asignar el evento onchange
    select.onchange = function () {
        mostrarCampoDiagnostico(this);
    };

    diagnosticoRow.parentElement.appendChild(nuevaFila);
}

// Eliminar última fila
window.eliminarDiagnostico = function() {
    const filas = document.querySelectorAll('#diagnostico-row');
    if (filas.length > 1) {
        filas[filas.length - 1].remove();
    }
}
window.agregarCampo = function(containerId, inputName) {
    const container = document.getElementById(containerId);
    const nuevoWrapper = document.createElement('div');
    nuevoWrapper.style.marginBottom = '5px';
    const nuevoInput = document.createElement('input');
    nuevoInput.type = 'text';
    nuevoInput.className = 'line-input';
    nuevoInput.name = inputName; // IMPORTANTE: Este valor debe ser correcto al llamar la función
    nuevoInput.style.display = 'block';
    nuevoInput.style.width = '100%';
    nuevoInput.style.boxSizing = 'border-box';
    nuevoWrapper.appendChild(nuevoInput);
    container.appendChild(nuevoWrapper);
}

window.eliminarCampo = function(containerId) {
    const container = document.getElementById(containerId);
    const wrappers = container.querySelectorAll('div');

    if (wrappers.length > 0) {
        container.removeChild(wrappers[wrappers.length - 1]);
    }
}
