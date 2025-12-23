// Configuración inicial
let formModal;
let indicatorModal;

document.addEventListener('DOMContentLoaded', function () {
    formModal = new bootstrap.Modal(document.getElementById('formModal'));
    indicatorModal = new bootstrap.Modal(document.getElementById('indicatorModal'));

    // Botones principales
    document.getElementById('openCreateFormBtn')?.addEventListener('click', openCreateForm);
    document.getElementById('addSubprocessBtn')?.addEventListener('click', addSubprocess);
    document.getElementById('addIndicatorBtn')?.addEventListener('click', addIndicator);

    // --- EVENTOS CHANGE ---
    document.addEventListener('change', function (e) {
        const target = e.target;

        if (target.matches('.data-source-select')) {
            if (target.closest('#indicatorModal')) {
                handleModalDataSourceChange(target);
            } else if (target.closest('.indicator-card')) {
                handleDataSourceChange(target);
            }
        }

        if (target.matches('.data-field-select')) {
            const card = target.closest('.indicator-card');
            if (card) updateDataPreview(card);
        }
    });

    // --- EVENTOS CLICK ---
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('button');
        if (!btn) return;

        if (btn.classList.contains('add-indicator')) {
            const index = btn.getAttribute('data-subprocess-index');
            addIndicator(index);
        }

        if (btn.classList.contains('remove-subprocess')) {
            if (confirm('¿Eliminar este subproceso y todos sus indicadores?')) {
                btn.closest('.subprocess-card').remove();
            }
        }

        if (btn.classList.contains('remove-indicator')) {
            if (confirm('¿Eliminar este indicador?')) {
                btn.closest('.indicator-card').remove();
            }
        }

        if (btn.classList.contains('test-api-btn')) {
            if (btn.closest('#indicatorModal')) {
                const form = document.getElementById('indicatorForm');
                testModalApiEndpoint(form);
            } else if (btn.closest('.indicator-card')) {
                const card = btn.closest('.indicator-card');
                testApiEndpoint(card);
            }
        }

        if (btn.classList.contains('delete-process')) {
            deleteProcess(btn.getAttribute('data-process-id'));
        }

        if (btn.classList.contains('add-manual-row')) {
            addManualDataRow();
        }

        if (btn.classList.contains('remove-manual-row')) {
            btn.closest('.manual-data-row')?.remove();
        }
    });

    // --- FORMULARIOS ---
    document.getElementById('processForm')?.addEventListener('submit', submitProcessForm);

    document.getElementById('subprocessForm')?.addEventListener('submit', function (e) {
        e.preventDefault();
        submitForm(this, 'subprocessModal');
    });

    document.getElementById('indicatorForm')?.addEventListener('submit', function (e) {
        e.preventDefault();
        if (updateModalIndicatorDataJson()) {
            submitIndicatorForm(this, 'indicatorModal');
        }
    });
});


function handleModalDataSourceChange(select) {
    const form = document.getElementById('indicatorForm');
    const value = select.value;

    if (value === 'api') {
        console.log('Cambiando a configuración de API en el modal');
        form.querySelector('.api-config-section').style.display = 'block';
        form.querySelector('.manual-data-section').style.display = 'none';
    } else {
        console.log('Cambiando a configuración manual en el modal');
        form.querySelector('.api-config-section').style.display = 'none';
        form.querySelector('.manual-data-section').style.display = 'block';
    }
}

async function testModalApiEndpoint() {
    console.log('Probando API en el modal Form de indicadores');
    const form = document.getElementById('indicatorForm');
    const urlInput = form.querySelector('.api-url');
    const url = urlInput.value.trim();
    const preview = form.querySelector('.api-response-preview');
    const responseContainer = form.querySelector('.api-response-container');
    const mappingContainer = form.querySelector('.data-mapping-container');
    const previewContainer = form.querySelector('.data-preview-container');
    const btn = form.querySelector('.test-api-btn');
    
    if (!url) {
        alert('Por favor ingrese una URL válida');
        return;
    }

    try {
        // Mostrar loading
        btn.disabled = true;
        const spinner = btn.querySelector('.spinner-border');
        if (spinner) spinner.classList.remove('d-none');
        
        preview.textContent = 'Cargando...';
        responseContainer.style.display = 'block';
        mappingContainer.style.display = 'none';
        previewContainer.style.display = 'none';
        
        const response = await fetch('/bsc/objetivos/test-api', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ api_url: url })
        });
        
        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || `Error HTTP: ${response.status}`);
        }
        
        const { success, message, available_fields, data_sample } = await response.json();
        
        if (!success) {
            throw new Error(message || 'Error en la respuesta de la API');
        }
        
        preview.textContent = JSON.stringify(data_sample, null, 2);
        
        const labelSelect = form.querySelector('select[name="label_field"]');
        const valueSelect = form.querySelector('select[name="value_field"]');
        const expectedSelect = form.querySelector('select[name="expected_field"]');
        
        labelSelect.innerHTML = '<option value="">Seleccione un campo</option>' + 
            available_fields.map(f => `<option value="${f}">${f}</option>`).join('');
            
        valueSelect.innerHTML = '<option value="">Seleccione un campo</option>' + 
            available_fields.map(f => `<option value="${f}">${f}</option>`).join('');

        expectedSelect.innerHTML = '<option value="">Seleccione un campo</option>' +
            available_fields.map(f => `<option value="${f}">${f}</option>`).join('');    
        
        mappingContainer.style.display = 'block';
        previewContainer.style.display = 'block';
        updateModalIndicatorDataJson();
        updateModalDataPreview();
        
    } catch (error) {
        console.error('Error probando API:', error);
        preview.textContent = `Error: ${error.message}`;
    } finally {
        btn.disabled = false;
        const spinner = btn.querySelector('.spinner-border');
        if (spinner) spinner.classList.add('d-none');
    }
}

function updateModalDataPreview() {
    console.log('Ejecuntando updateModalDataPreview');
    const form = document.getElementById('indicatorForm');
    const previewContainer = form.querySelector('.data-preview');
    const dataSource = form.querySelector('.data-source-select').value;
    
    try {
        if (dataSource === 'api') {
            const apiResponse = form.querySelector('.api-response-preview').textContent;
            const labelField = form.querySelector('select[name="label_field"]').value;
            const valueField = form.querySelector('select[name="value_field"]').value;
            const expectedField = form.querySelector('select[name="expected_field"]')?.value || null;
            
            const data = JSON.parse(apiResponse);
            let previewData = { 
                labels: [], 
                values: [],
                expectedValues: [],
                colors: []
            };
            
            if (Array.isArray(data)) {
                data.forEach(item => {
                    previewData.labels.push(item[labelField] || '');
                    
                    let value = item[valueField];
                    if (typeof value === 'string' && value.includes('%')) {
                        value = parseFloat(value.replace('%', '')) || 0;
                    } else {
                        value = parseFloat(value) || 0;
                    }
                    previewData.values.push(value);
                    
                    if (value < 70) {
                        previewData.colors.push('rgb(231, 24, 49)');
                    } else if (value >= 70 && value < 85) {
                        previewData.colors.push('rgb(239, 198, 0)');
                    } else {
                        previewData.colors.push('rgb(140, 214, 16)');
                    }
                    
                    if (expectedField && item[expectedField]) {
                        let expectedValue = item[expectedField];
                        if (typeof expectedValue === 'string' && expectedValue.includes('%')) {
                            expectedValue = parseFloat(expectedValue.replace('%', '')) || 0;
                        } else {
                            expectedValue = parseFloat(expectedValue) || 0;
                        }
                        previewData.expectedValues.push(expectedValue);
                    }
                });
            } else if (typeof data === 'object') {
                previewData.labels.push(labelField ? data[labelField] : '');
                
                let value = valueField ? data[valueField] : '0';
                if (typeof value === 'string' && value.includes('%')) {
                    value = parseFloat(value.replace('%', '')) || 0;
                } else {
                    value = parseFloat(value) || 0;
                }
                previewData.values.push(value);
                
                if (value < 70) {
                    previewData.colors.push('rgb(231, 24, 49)');
                } else if (value >= 70 && value < 85) {
                    previewData.colors.push('rgb(239, 198, 0)');
                } else {
                    previewData.colors.push('rgb(140, 214, 16)');
                }
                
                if (expectedField && data[expectedField]) {
                    let expectedValue = data[expectedField];
                    if (typeof expectedValue === 'string' && expectedValue.includes('%')) {
                        expectedValue = parseFloat(expectedValue.replace('%', '')) || 0;
                    } else {
                        expectedValue = parseFloat(expectedValue) || 0;
                    }
                    previewData.expectedValues.push(expectedValue);
                }
            }
            
            previewContainer.innerHTML = `
                <strong>Etiquetas:</strong> ${JSON.stringify(previewData.labels)}<br>
                <strong>Valores:</strong> ${JSON.stringify(previewData.values)}%<br>
                ${previewData.expectedValues.length > 0 ? 
                  `<strong>Valores esperados:</strong> ${JSON.stringify(previewData.expectedValues)}%<br>` : ''}
                <div class="chart-container" style="height: 200px;">
                    <canvas class="chart-preview"></canvas>
                </div>
            `;
            
            renderModalChartPreview(previewData);
            
        } else if (dataSource === 'manual') {
            const labels = Array.from(form.querySelectorAll('.manual-label')).map(i => i.value);
            const values = Array.from(form.querySelectorAll('.manual-value')).map(i => parseFloat(i.value) || 0);
            const expectedValues = Array.from(form.querySelectorAll('.manual-expected')).map(i => parseFloat(i.value) || 0);
            
            if (labels.length > 0 && values.length > 0) {
                previewContainer.innerHTML = `
                    <strong>Etiquetas:</strong> ${JSON.stringify(labels)}<br>
                    <strong>Valores:</strong> ${JSON.stringify(values)}%<br>
                    ${expectedValues.length > 0 ? 
                      `<strong>Valores esperados:</strong> ${JSON.stringify(expectedValues)}%<br>` : ''}
                    <div class="alert alert-success mt-2">
                        Configuración manual válida
                    </div>
                `;
            } else {
                previewContainer.innerHTML = `
                    <div class="alert alert-warning">
                        Ingrese al menos un dato manual
                    </div>
                `;
            }
        }
        
    } catch (error) {
        console.error('Error generating data preview:', error);
        previewContainer.innerHTML = `
            <div class="alert alert-warning">
                Error al generar vista previa: ${error.message}
            </div>
        `;
    }
    
    updateModalIndicatorDataJson();
}

function updateModalIndicatorDataJson() {
    console.log('Actualizando JSON de datos del indicador en el modal');
    const form = document.getElementById('indicatorForm');
    const jsonInput = form.querySelector('.indicator-data-json');
    const dataSource = form.querySelector('.data-source-select').value;

    let data = { data_source: dataSource };

    if (dataSource === 'manual') {
        const labels = Array.from(form.querySelectorAll('.manual-label')).map(i => i.value.trim());
        const values = Array.from(form.querySelectorAll('.manual-value')).map(i => parseFloat(i.value) || 0);
        const expectedValues = Array.from(form.querySelectorAll('.manual-expected')).map(i => parseFloat(i.value) || 0);

        if (labels.length === 0 || values.length === 0) {
            alert('Por favor ingrese al menos un dato manual completo');
            return false;
        }

        data.data_config = { labels, values, expected_values: expectedValues };
    } else if (dataSource === 'api') {
        const apiUrl = form.querySelector('.api-url').value.trim();
        if (!apiUrl) {
            alert('Por favor ingrese una URL de API válida');
            return false;
        }

        data.api_url = apiUrl;
        data.api_response = tryParseJson(form.querySelector('.api-response-preview').textContent);
        data.label_field = form.querySelector('select[name="label_field"]').value;
        data.value_field = form.querySelector('select[name="value_field"]').value;
        data.expected_field = form.querySelector('select[name="expected_field"]')?.value || null;
    }

    jsonInput.value = JSON.stringify(data);
    return true;
}

function renderModalChartPreview(data) {
    const canvas = document.querySelector('#indicatorModal .chart-preview');
    if (!canvas) return;
    
    if (canvas.chart) {
        canvas.chart.destroy();
    }
    
    setTimeout(() => {
        const ctx = canvas.getContext('2d');
        
        const chartConfig = {
            type: 'doughnut',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.values,
                    backgroundColor: data.colors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        };
        
        canvas.chart = new Chart(ctx, chartConfig);
        
        if (data.expectedValues && data.expectedValues.length > 0) {
            const chart = canvas.chart;
            const originalDraw = chart.draw;
            
            chart.draw = function() {
                originalDraw.apply(this, arguments);
                
                const {ctx, chartArea} = chart;
                const centerX = (chartArea.left + chartArea.right) / 2;
                const centerY = (chartArea.top + chartArea.bottom) / 2;
                const radius = Math.min(
                    (chartArea.right - chartArea.left) / 2,
                    (chartArea.bottom - chartArea.top) / 2
                ) * 0.85;
                
                ctx.save();
                
                data.expectedValues.forEach(expectedValue => {
                    const angle = Math.PI * (1 - (expectedValue / 100));
                    const x = centerX + Math.cos(angle) * radius;
                    const y = centerY + Math.sin(angle) * radius;
                    
                    ctx.beginPath();
                    ctx.setLineDash([6, 6]);
                    ctx.strokeStyle = 'rgb(54, 162, 235)';
                    ctx.lineWidth = 2;
                    ctx.moveTo(centerX, centerY);
                    ctx.lineTo(x, y);
                    ctx.stroke();
                    
                    ctx.fillStyle = 'rgb(54, 162, 235)';
                    ctx.font = '12px Arial';
                    ctx.fillText(`Meta: ${expectedValue}%`, x + 10, y);
                });
                
                ctx.restore();
            };
            
            chart.update();
        }
    }, 100);
}

// Funciones para abrir modales de indicadores
window.openCreateIndicatorForm = function(subprocessId) {
    const form = document.getElementById('indicatorForm');
    form.reset();
    form.setAttribute('action', '/bsc/indicators');
    form.querySelector('input[name="subprocess_id"]').value = subprocessId;
    
    let methodInput = form.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'POST';
    
    form.querySelector('.api-config-section').style.display = 'none';
    form.querySelector('.manual-data-section').style.display = 'block';
    form.querySelector('.api-response-container').style.display = 'none';
    form.querySelector('.data-mapping-container').style.display = 'none';
    form.querySelector('.data-preview-container').style.display = 'none';
    form.querySelector('.data-source-select').value = 'manual';
    
    const manualInputs = form.querySelector('.manual-data-inputs');
    manualInputs.innerHTML = '';
    addManualDataRow();
    
    const modal = new bootstrap.Modal(document.getElementById('indicatorModal'));
    modal.show();
};

window.openEditIndicatorForm = function(indicatorId) {
    fetch(`/bsc/indicators/${indicatorId}/edit`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) throw new Error(data.message);

        const form = document.getElementById('indicatorForm');
        form.setAttribute('action', `/bsc/indicators/${indicatorId}`);
        
        // Configurar método PUT
        let methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);
        }
        methodInput.value = 'PUT';

        // Limpiar y resetear el formulario
        form.reset();
        form.querySelector('input[name="name"]').value = data.indicator.name || '';
        form.querySelector('input[name="subprocess_id"]').value = data.indicator.subprocess_id;

        let indicatorData = {};
        try {
            // Asegurarse de que data es un objeto
            indicatorData = data.indicator.data ? 
                (typeof data.indicator.data === 'string' ? 
                    JSON.parse(data.indicator.data) : 
                    data.indicator.data) : 
                {};
        } catch (e) {
            console.error('Error parsing indicator data:', e);
            indicatorData = {};
        }

        // Configurar origen de datos
        const dataSourceSelect = form.querySelector('.data-source-select');
        dataSourceSelect.value = indicatorData.data_source || 'manual';
        
        // Manejar cambio de origen de datos (versión modal)
        if (indicatorData.data_source === 'api') {
            form.querySelector('.api-config-section').style.display = 'block';
            form.querySelector('.manual-data-section').style.display = 'none';
            
            // Configurar API
            form.querySelector('.api-url').value = indicatorData.api_url || '';
            
            if (indicatorData.api_response) {
                const apiResponse = typeof indicatorData.api_response === 'string' ? 
                    JSON.parse(indicatorData.api_response) : indicatorData.api_response;
                
                const preview = form.querySelector('.api-response-preview');
                preview.textContent = JSON.stringify(apiResponse, null, 2);
                form.querySelector('.api-response-container').style.display = 'block';

                const availableFields = getAvailableFields(apiResponse);
                const labelSelect = form.querySelector('select[name="label_field"]');
                const valueSelect = form.querySelector('select[name="value_field"]');
                const expectedSelect = form.querySelector('select[name="expected_field"]');
                
                labelSelect.innerHTML = '<option value="">Seleccione un campo</option>' +
                    availableFields.map(f => `<option value="${f}" ${indicatorData.label_field === f ? 'selected' : ''}>${f}</option>`).join('');
                
                valueSelect.innerHTML = '<option value="">Seleccione un campo</option>' +
                    availableFields.map(f => `<option value="${f}" ${indicatorData.value_field === f ? 'selected' : ''}>${f}</option>`).join('');
                
                expectedSelect.innerHTML = '<option value="">Seleccione un campo</option>' +
                    availableFields.map(f => `<option value="${f}" ${indicatorData.expected_field === f ? 'selected' : ''}>${f}</option>`).join('');

                form.querySelector('.data-mapping-container').style.display = 'block';
                form.querySelector('.data-preview-container').style.display = 'block';
            }
        } else {
            // Configurar datos manuales
            form.querySelector('.api-config-section').style.display = 'none';
            form.querySelector('.manual-data-section').style.display = 'block';
            
            const manualInputs = form.querySelector('.manual-data-inputs');
            manualInputs.innerHTML = '';
            
            if (indicatorData.data_config) {
                let config = typeof indicatorData.data_config === 'string' ? 
                    JSON.parse(indicatorData.data_config) : indicatorData.data_config;
                
                const labels = config.labels || [];
                const values = config.values || [];
                const expected = config.expected_values || [];
                
                for (let i = 0; i < labels.length; i++) {
                    manualInputs.insertAdjacentHTML('beforeend', `
                        <div class="form-row manual-data-row mt-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control manual-label" 
                                       placeholder="Etiqueta (ej. Enero)" value="${labels[i] || ''}">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control manual-value" 
                                       placeholder="Valor (ej. 75)" value="${values[i] || ''}">
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control manual-expected" 
                                       placeholder="Meta (ej. 90)" value="${expected[i] || ''}">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm remove-manual-row">&times;</button>
                            </div>
                        </div>
                    `);
                }
            }
            
            if (manualInputs.querySelectorAll('.manual-data-row').length === 0) {
                addManualDataRow();
            }
        }

        // Actualizar vista previa y datos JSON
        updateModalIndicatorDataJson();
        updateModalDataPreview();

        // Mostrar el modal
        const modal = new bootstrap.Modal(document.getElementById('indicatorModal'));
        modal.show();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading indicator: ' + error.message);
    });
};
function submitIndicatorForm(form, modalId) {
    console.log('Enviando formulario de indicador');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    submitBtn.disabled = true;
    spinner?.classList.remove('d-none');

    const url = form.getAttribute('action');
    const method = form.querySelector('input[name="_method"]')?.value || 'POST' ;
    
    // Crear objeto con los datos del formulario
    const formData = {
        name: form.querySelector('input[name="name"]').value,
        subprocess_id: form.querySelector('input[name="subprocess_id"]').value,
        data: {}
    };

    // Obtener el valor del campo data (ya debe estar como objeto)
    const dataJsonInput = form.querySelector('.indicator-data-json');
    try {
        formData.data = JSON.parse(dataJsonInput.value);
    } catch (e) {
        console.error('Error parsing indicator data:', e);
        formData.data = {};
    }

    fetch(url, {
        method: method === 'PUT' ? 'POST' : method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(async response => {
        const result = await response.json();
        if (!response.ok) throw new Error(result.message || 'Error en la solicitud');
        return result;
    })
    .then(data => {
        const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
        modal?.hide();
        
        if (data.redirect) {
            window.location.href = data.redirect;
        } else {
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    })
    .finally(() => {
        submitBtn.disabled = false;
        spinner?.classList.add('d-none');
    });
}

function addManualDataRow() {
    const container = document.querySelector('#indicatorModal .manual-data-inputs');
    const index = container.querySelectorAll('.manual-data-row').length;
    
    container.insertAdjacentHTML('beforeend', `
        <div class="form-row manual-data-row mt-2">
            <div class="col-md-4">
                <input type="text" class="form-control manual-label" placeholder="Etiqueta (ej. Enero)">
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control manual-value" placeholder="Valor (ej. 75)">
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control manual-expected" placeholder="Meta (ej. 90)">
            </div>

        </div>
    `);
}

//funciones CRUD en general de todos los procesos/subprocesos(Departamentos)/indicadores
function openCreateForm(propiedadId = null) {
    resetForm();
    document.getElementById('formTitle').textContent = 'Crear Nuevo Proceso';
    document.querySelector('.submit-text').textContent = 'Guardar';
    
    // Agregar parámetro de propiedad_id si está disponible
    let url = '/bsc/processes/create';
    if (propiedadId) {
        url += `?propiedad_id=${propiedadId}`;
    }
    
    fetch(url, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const propiedadSelect = document.getElementById('propiedad_id');
            if (propiedadSelect) {
                propiedadSelect.innerHTML = '<option value="">Seleccione una propiedad</option>' + 
                    data.propiedades.map(propiedad => 
                        `<option value="${propiedad.id_propiedad}" ${propiedad.id_propiedad == data.selectedPropiedad ? 'selected' : ''}>${propiedad.nombre_propiedad}</option>`
                    ).join('');
            }
            formModal.show();
        } else {
            throw new Error(data.message || 'Error al cargar formulario');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    });
}
// Funcion para crear el formulario de proceso/subprocesos(departamentos)/indicadores
function openEditForm(processId) {
    resetForm();
    console.log('Iniciando openEditForm para proceso ID:', processId);

    fetch(`/bsc/processes/${processId}/edit`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(async response => {
        console.log('Respuesta recibida, status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Contenido del error:', errorText);
            throw new Error(`Error HTTP: ${response.status} - ${errorText}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos:', data);
        
        if (!data || !data.process) {
            throw new Error('La respuesta del servidor no contiene datos válidos');
        }

        // Configurar formulario
        const formTitle = document.getElementById('formTitle');
        const submitText = document.querySelector('.submit-text');
        const form = document.getElementById('processForm');
        
        if (!formTitle || !submitText || !form) {
            throw new Error('No se encontraron elementos del formulario');
        }

        formTitle.textContent = 'Editar Proceso';
        submitText.textContent = 'Actualizar';
        form.setAttribute('action', `/bsc/processes/${processId}`);

        // Configurar método PUT
        let methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);
        }
        methodInput.value = 'PUT';

        // Llenar datos básicos
        const nameInput = form.querySelector('input[name="name"]');
        if (nameInput) {
            nameInput.value = data.process.name || '';
        }

         const propiedadSelect = form.querySelector('select[name="propiedad_id"]');
        if (propiedadSelect) {
            propiedadSelect.innerHTML = '<option value="">Seleccione una propiedad</option>' + 
                data.propiedades.map(propiedad => 
                    `<option value="${propiedad.id_propiedad}" ${propiedad.id_propiedad == data.process.id_propiedad ? 'selected' : ''}>
                        ${propiedad.nombre_propiedad}
                    </option>`
                ).join('');
        }


        // Llenar subprocesos e indicadores
        const container = document.getElementById('subprocessesContainer');
        if (!container) {
            throw new Error('No se encontró el contenedor de subprocesos');
        }
        container.innerHTML = '';

        if (data.process.subprocesses?.length > 0) {
            data.process.subprocesses.forEach((subprocess, index) => {
                const subprocessCard = createSubprocessCard(subprocess, index);
                container.insertAdjacentHTML('beforeend', subprocessCard);
                
                //Eventos para los select de origen de datos
                const subprocessElement = container.querySelector(`.subprocess-card[data-index="${index}"]`);
                subprocessElement.querySelectorAll('.data-source-select').forEach(select => {
                
                    select.dispatchEvent(new Event('change'));
                });
            });
        }

        formModal.show();
    })
    .catch(error => {
        console.error('Error completo:', error);
        alert('Error al cargar el formulario: ' + error.message);
    });
}



// Función para abrir modal de edición de subproceso
window.openEditSubprocessForm = function(subprocessId) {
    resetForm();
    console.log('Abriendo formulario para subproceso ID:', subprocessId);


    fetch(`/bsc/subprocesses/${subprocessId}/edit`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) throw new Error(data.message);

        const form = document.getElementById('subprocessForm');
        form.setAttribute('action', `/bsc/subprocesses/${subprocessId}`);
        
        // Configurar método PUT
        let methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);
        }
        methodInput.value = 'PUT';

        // Llenar datos básicos
        form.querySelector('input[name="name"]').value = data.subprocess.name || '';
        form.querySelector('input[name="process_id"]').value = data.subprocess.process_id;

        // Mostrar el modal
        const modal = new bootstrap.Modal(document.getElementById('subprocessModal'));
        modal.show();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al cargar el subproceso: ' + error.message);
    });
};



// Función genérica para otros formularios
function submitForm(form, modalId) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    submitBtn.disabled = true;
    spinner?.classList.remove('d-none');

    const url = form.getAttribute('action');
    const method = form.querySelector('input[name="_method"]')?.value || 'POST';
    const formData = new FormData(form);
    
    fetch(url, {
        method: method === 'PUT' ? 'POST' : method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(async response => {
        const result = await response.json();
        if (!response.ok) throw new Error(result.message || 'Error en la solicitud');
        return result;
    })
    .then(data => {
        if (data.redirect) {
            window.location.href = data.redirect;
        } else {
            const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
            modal?.hide();
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    })
    .finally(() => {
        submitBtn.disabled = false;
        spinner?.classList.add('d-none');
    });
}


// Función para abrir modal de creación de subproceso
window.openCreateSubprocessForm = function(processId) {
    resetSubprocessForm();
    const form = document.getElementById('subprocessForm');
    form.setAttribute('action', '/bsc/subprocesses');
    form.querySelector('input[name="process_id"]').value = processId;
    
    // Configurar método POST
    let methodInput = form.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'POST';
    
    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('subprocessModal'));
    modal.show();
};


// Funciones para resetear formularios
function resetSubprocessForm() {
    const form = document.getElementById('subprocessForm');
    if (form) {
        form.reset();
        form.setAttribute('action', '/bsc/subprocesses');
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.value = 'POST';
    }
}
//limpiar el formulario de indicador
function resetIndicatorForm() {
    const form = document.getElementById('indicatorForm');
    if (form) {
        form.reset();
        form.setAttribute('action', '/bsc/indicators');
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.value = 'POST';
        
        // Resetear secciones de API
        form.querySelector('.api-config-section').style.display = 'none';
        form.querySelector('.manual-data-section').style.display = 'block';
    }
}


//crea el formulario de proceso con todas las configuraciones si el usuario asi lo desea
function submitProcessForm(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    submitBtn.disabled = true;
    spinner?.classList.remove('d-none');
    
    const url = form.getAttribute('action');
    const method = form.querySelector('input[name="_method"]')?.value || 'POST';
    
    // Preparar datos del formulario
    const formData = new FormData(form);
    const data = {};
    
    // Convertir FormData a objeto
    formData.forEach((value, key) => {
        // Manejar arrays anidados (subprocesos e indicadores)
        if (key.includes('[') && key.includes(']')) {
            const keys = key.split(/\[|\]/).filter(k => k !== '');
            let current = data;
            
            for (let i = 0; i < keys.length; i++) {
                if (i === keys.length - 1) {
                    current[keys[i]] = value;
                } else {
                    current[keys[i]] = current[keys[i]] || {};
                    current = current[keys[i]];
                }
            }
        } else {
            data[key] = value;
        }
    });
    
    fetch(url, {
        method: method === 'PUT' ? 'POST' : method, // Laravel maneja PUT via POST + _method
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(async response => {
        const result = await response.json();
        if (!response.ok) throw new Error(result.message || 'Error en la solicitud');
        return result;
    })
    .then(data => {
        if (data.redirect) {
            window.location.href = data.redirect;
        } else {
            formModal.hide();
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    })
    .finally(() => {
        submitBtn.disabled = false;
        spinner?.classList.add('d-none');
    });
}
//elimina el proceso
function deleteProcess(processId) {
    if (confirm('¿Estás seguro de eliminar este proceso y todos sus elementos asociados?')) {
        fetch(`/bsc/processes/${processId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) throw new Error(data.message || 'Error al eliminar');
            return data;
        })
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Error al eliminar el proceso');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar: ' + error.message);
        });
    }
}
//eliminar el subproceso (departamentos)
window.deleteSubprocess = function(subprocessId) {
    if (confirm('¿Estás seguro de eliminar este subproceso y todos sus indicadores asociados?')) {
        fetch(`/bsc/subprocesses/${subprocessId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) throw new Error(data.message || 'Error al eliminar');
            return data;
        })
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Error al eliminar el subproceso');
            }
        })
        .catch(error => {
            console.error('Error al eliminar subproceso:', error);
            alert('Error al eliminar: ' + error.message);
        });
    }
}



// Function to delete an indicator
window.deleteIndicator = function(indicatorId) {
    if (confirm('Estas Seguro de Eliminar este indicador?')) {
        fetch(`/bsc/indicators/${indicatorId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) throw new Error(data.message || 'Error deleting');
            return data;
        })
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Error deleting indicator');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error: ' + error.message);
        });
    }
};




// Funciones auxiliares
function resetForm() {
    const form = document.getElementById('processForm');
    if (form) {
        form.reset();
        form.setAttribute('action', '/bsc/processes');
        
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.value = 'POST';
        }
        
        document.getElementById('subprocessesContainer').innerHTML = '';
    }
}

function addSubprocess() {
    const container = document.getElementById('subprocessesContainer');
    const index = container.querySelectorAll('.subprocess-card').length;

    const html = `
    <div class="subprocess-card card mb-3" data-index="${index}">
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="m-0 font-weight-bold">Departamento</h6>
            <button type="button" class="btn btn-sm btn-danger remove-subprocess">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nombre del Departamento</label>
                <input type="text" name="subprocesses[${index}][name]" class="form-control" required>
            </div>
            
            <div class="indicators-container">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="m-0 font-weight-bold">Indicadores</h6>
                    <button type="button" class="btn btn-sm btn-primary add-indicator" 
                            data-subprocess-index="${index}">
                        <i class="fas fa-plus"></i> Agregar
                    </button>
                </div>
            </div>
        </div>
    </div>`;
    
    container.insertAdjacentHTML('beforeend', html);
}

function createSubprocessCard(subprocess, index) {
    let indicatorsHtml = '';
    
    if (subprocess.indicators?.length > 0) {
        indicatorsHtml = subprocess.indicators.map((indicator, idx) => {
            let indicatorData = {};
            try {
                indicatorData = indicator.data ? (typeof indicator.data === 'string' ? JSON.parse(indicator.data) : indicator.data) : {};
            } catch (e) {
                console.error('Error parsing indicator data:', e);
                indicatorData = {};
            }

            // Determinar si es API o manual
            const isApi = indicatorData.data_source === 'api';
            const apiResponse = indicatorData.api_response ? 
                (typeof indicatorData.api_response === 'string' ? 
                    JSON.parse(indicatorData.api_response) : 
                    indicatorData.api_response) : 
                null;

            return `
            <div class="indicator-card card mb-2">
                <div class="card-body">
                    <input type="hidden" name="subprocesses[${index}][indicators][${idx}][id]" 
                           value="${indicator.id || ''}">
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="m-0 font-weight-bold">Indicador</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-indicator">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Nombre del Indicador</label>
                            <input type="text" name="subprocesses[${index}][indicators][${idx}][name]" 
                                   class="form-control" value="${indicator.name || ''}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Origen de los datos</label>
                        <select class="form-control data-source-select" name="subprocesses[${index}][indicators][${idx}][data_source]">
                            <option value="manual" ${!isApi ? 'selected' : ''}>Ingreso manual</option>
                            <option value="api" ${isApi ? 'selected' : ''}>API Externa</option>
                        </select>
                    </div>

                    <div class="api-config-section" style="${isApi ? '' : 'display: none;'}">
                        <div class="form-group">
                            <label>URL de la API</label>
                            <div class="input-group">
                                <input type="text" class="form-control api-url" 
                                       value="${indicatorData.api_url || ''}" 
                                       placeholder="https://ejemplo.com/api/data">
                                <button class="btn btn-outline-secondary test-api-btn" type="button">
                                    Probar API
                                </button>
                            </div>
                        </div>

                        <div class="form-group api-response-container" style="${apiResponse ? '' : 'display: none;'}">
                            <label>Respuesta de la API</label>
                            <pre class="api-response-preview bg-light p-2">${apiResponse ? JSON.stringify(apiResponse, null, 2) : ''}</pre>
                        </div>

                        <div class="form-group data-mapping-container" style="${apiResponse ? '' : 'display: none;'}">
                            <label>Mapeo de datos</label>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Campo para etiquetas</label>
                                    <select class="form-control data-field-select" name="subprocesses[${index}][indicators][${idx}][label_field]">
                                        ${apiResponse ? generateFieldOptions(apiResponse, indicatorData.label_field) : '<option value="">Seleccione un campo</option>'}
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Campo para valores</label>
                                    <select class="form-control data-field-select" name="subprocesses[${index}][indicators][${idx}][value_field]">
                                        ${apiResponse ? generateFieldOptions(apiResponse, indicatorData.value_field) : '<option value="">Seleccione un campo</option>'}
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Campo para valor esperado (opcional)</label>
                                    <select class="form-control data-field-select" name="subprocesses[${index}][indicators][${idx}][expected_field]">
                                        ${apiResponse ? generateFieldOptions(apiResponse, indicatorData.expected_field) : '<option value="">Seleccione un campo</option>'}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group data-preview-container" style="${apiResponse ? '' : 'display: none;'}">
                            <label>Vista previa de datos</label>
                            <div class="data-preview bg-light p-2">
                                ${generateDataPreview(indicatorData)}
                            </div>
                            <small class="form-text text-muted">Esta es la estructura que se usará para el gráfico</small>
                        </div>
                    </div>

                    <div class="manual-data-section" style="${!isApi ? '' : 'display: none;'}">
                        <label>Configuración de Datos (JSON)</label>
                        <textarea name="subprocesses[${index}][indicators][${idx}][data_config]" 
                                  class="form-control" rows="3">${
                                    indicatorData.data_config ? 
                                    (typeof indicatorData.data_config === 'string' ? 
                                        indicatorData.data_config : 
                                        JSON.stringify(indicatorData.data_config, null, 2)) : 
                                    ''
                                  }</textarea>
                        <small class="form-text text-muted">Ejemplo: {"labels": ["Ene", "Feb", "Mar"], "values": [10, 20, 30]}</small>
                    </div>

                    <input type="hidden" name="subprocesses[${index}][indicators][${idx}][data]" 
                           class="indicator-data-json" value='${JSON.stringify(indicatorData)}'>
                </div>
            </div>`;
        }).join('');
    }

    return `
    <div class="subprocess-card card mb-3" data-index="${index}">
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="m-0 font-weight-bold">Departamento</h6>
            <button type="button" class="btn btn-sm btn-danger remove-subprocess">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <input type="hidden" name="subprocesses[${index}][id]" value="${subprocess.id || ''}">
            
            <div class="form-group">
                <label>Nombre del Departamento</label>
                <input type="text" name="subprocesses[${index}][name]" 
                       class="form-control" value="${subprocess.name || ''}" required>
            </div>
            
            <div class="indicators-container">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="m-0 font-weight-bold">Indicadores</h6>
                    <button type="button" class="btn btn-sm btn-primary add-indicator" 
                            data-subprocess-index="${index}">
                        <i class="fas fa-plus"></i> Agregar
                    </button>
                </div>
                ${indicatorsHtml}
            </div>
        </div>
    </div>`;
}

// Función para agregar indicador - MODIFICADA
function addIndicator(subprocessIndex) {
    const container = document.querySelector(`.subprocess-card[data-index="${subprocessIndex}"] .indicators-container`);
    const index = container.querySelectorAll('.indicator-card').length;

    const html = `
    <div class="indicator-card card mb-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="m-0 font-weight-bold">Indicador</h6>
                <button type="button" class="btn btn-sm btn-danger remove-indicator">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Nombre del Indicador</label>
                    <input type="text" name="subprocesses[${subprocessIndex}][indicators][${index}][name]" 
                           class="form-control" required>
                </div>
            </div>
            
            <div class="form-group">
                <label>Origen de los datos</label>
                <select class="form-control data-source-select" name="subprocesses[${subprocessIndex}][indicators][${index}][data_source]">
                    <option value="manual">Ingreso manual</option>
                    <option value="api">API Externa</option>
                </select>
            </div>

            <div class="api-config-section" style="display: none;">
                <div class="form-group">
                    <label>URL de la API</label>
                    <div class="input-group">
                        <input type="text" class="form-control api-url" 
                               placeholder="https://ejemplo.com/api/data">
                        <button class="btn btn-outline-secondary test-api-btn" type="button">
                            Probar API
                        </button>
                    </div>
                </div>

                <div class="form-group api-response-container" style="display: none;">
                    <label>Respuesta de la API</label>
                    <pre class="api-response-preview bg-light p-2"></pre>
                </div>

                <div class="form-group data-mapping-container" style="display: none;">
                    <label>Mapeo de datos</label>
                    
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Campo para etiquetas</label>
                            <select class="form-control data-field-select" name="subprocesses[${subprocessIndex}][indicators][${index}][label_field]">
                                <option value="">Seleccione un campo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Campo para valores</label>
                            <select class="form-control data-field-select" name="subprocesses[${subprocessIndex}][indicators][${index}][value_field]">
                                <option value="">Seleccione un campo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Campo para valor esperado (opcional)</label>
                            <select class="form-control data-field-select" name="subprocesses[${subprocessIndex}][indicators][${index}][expected_field]">
                                <option value="">Seleccione un campo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group data-preview-container" style="display: none;">
                    <label>Vista previa de datos</label>
                    <div class="data-preview bg-light p-2">
                        No hay datos disponibles
                    </div>
                    <small class="form-text text-muted">Esta es la estructura que se usará para el gráfico</small>
                </div>
            </div>

            <div class="manual-data-section">
                <label>Datos Manuales</label>
                <div class="manual-data-inputs">
                    <div class="form-row manual-data-row">
                        <div class="col-md-4">
                            <input type="text" class="form-control manual-label" placeholder="Etiqueta (ej. Enero)">
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control manual-value" placeholder="Valor (ej. 75)">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control manual-expected" placeholder="Meta (ej. 90)">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-manual-row">&times;</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-secondary mt-2 add-manual-row">Agregar dato</button>
            </div>

            <input type="hidden" name="subprocesses[${subprocessIndex}][indicators][${index}][data]" 
                   class="indicator-data-json" value='{}'>
        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
}
// NUEVAS FUNCIONES PARA MANEJO DE DATOS

function handleDataSourceChange(selectElement) {
    console.log('Manejando cambio de origen de datos');
    const card = selectElement.closest('.indicator-card');
    const value = selectElement.value;
    
    if (value === 'api') {
        console.log('Cambiando a configuración de API');
        card.querySelector('.api-config-section').style.display = 'block';
        card.querySelector('.manual-data-section').style.display = 'none';
    } else {
        console.log('Cambiando a datos manuales');
        card.querySelector('.api-config-section').style.display = 'none';
        card.querySelector('.manual-data-section').style.display = 'block';
    }
    
    updateIndicatorDataJson(card);
}

async function testApiEndpoint(card) {
    const urlInput = card.querySelector('.api-url');
    const url = urlInput.value.trim();
    const preview = card.querySelector('.api-response-preview');
    const responseContainer = card.querySelector('.api-response-container');
    const mappingContainer = card.querySelector('.data-mapping-container');
    const previewContainer = card.querySelector('.data-preview-container');
    const btn = card.querySelector('.test-api-btn');
    
    if (!url) {
        alert('Por favor ingrese una URL válida');
        return;
    }

    try {
        // Mostrar loading
        if (btn) {
            btn.disabled = true;
            const span = btn.querySelector('span');
            const spinner = btn.querySelector('.spinner-border');
            if (span) span.classList.add('d-none');
            if (spinner) spinner.classList.remove('d-none');
        }
        
        preview.textContent = 'Cargando...';
        responseContainer.style.display = 'block';
        mappingContainer.style.display = 'none';
        previewContainer.style.display = 'none';
        
        // Hacer la petición al endpoint del controlador usando POST
        const response = await fetch('/bsc/objetivos/test-api', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ api_url: url })
        });
        
        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || `Error HTTP: ${response.status}`);
        }
        
        const { success, message, available_fields, data_sample } = await response.json();
        
        if (!success) {
            throw new Error(message || 'Error en la respuesta de la API');
        }
        
        // Mostrar la respuesta formateada
        preview.textContent = JSON.stringify(data_sample, null, 2);
        
        // Generar opciones para los selects de mapeo
        const labelSelect = card.querySelector('select[name$="[label_field]"]');
        const valueSelect = card.querySelector('select[name$="[value_field]"]');
        const expectedSelect = card.querySelector('select[name$="[expected_field]"]');
        
        labelSelect.innerHTML = '<option value="">Seleccione un campo</option>' + 
            available_fields.map(f => `<option value="${f}">${f}</option>`).join('');
            
        valueSelect.innerHTML = '<option value="">Seleccione un campo</option>' + 
            available_fields.map(f => `<option value="${f}">${f}</option>`).join('');

        expectedSelect.innerHTML = '<option value="">Seleccione un campo</option>' +
            available_fields.map(f => `<option value="${f}">${f}</option>`).join('');    
        
        // Mostrar secciones
        mappingContainer.style.display = 'block';
        previewContainer.style.display = 'block';
        
        // Actualizar el JSON oculto con los datos de la API
        updateIndicatorDataJson(card);
        
        // Actualizar vista previa
        updateDataPreview(card);
        
    } catch (error) {
        console.error('Error probando API:', error);
        preview.textContent = `Error: ${error.message}`;
    } finally {
        if (btn) {
            btn.disabled = false;
            const span = btn.querySelector('span');
            const spinner = btn.querySelector('.spinner-border');
            if (span) span.classList.remove('d-none');
            if (spinner) spinner.classList.add('d-none');
        }
    }
}

function getAvailableFields(data) {
    if (Array.isArray(data) && data.length > 0) {
        // Si es un array, tomar las keys del primer objeto
        return Object.keys(data[0]);
    } else if (typeof data === 'object' && data !== null) {
        // Si es un objeto, tomar sus keys
        return Object.keys(data);
    }
    return [];
}

function generateFieldOptions(data, selectedField = '') {
    if (!data) return '<option value="">No hay campos disponibles</option>';
    
    const fields = getAvailableFields(data);
    if (fields.length === 0) return '<option value="">No hay campos disponibles</option>';
    
    return fields.map(field => 
        `<option value="${field}" ${field === selectedField ? 'selected' : ''}>${field}</option>`
    ).join('');
}


function updateDataPreview(card) {
    const labelField = card.querySelector('select[name$="[label_field]"]').value;
    const valueField = card.querySelector('select[name$="[value_field]"]').value;
    const expectedField = card.querySelector('select[name$="[expected_field]"]')?.value || null;
    const previewContainer = card.querySelector('.data-preview');
    const apiResponse = card.querySelector('.api-response-preview').textContent;
    
    try {
        const data = JSON.parse(apiResponse);
        let previewData = { 
            labels: [], 
            values: [],
            expectedValues: [],
            colors: []
        };
        
        if (Array.isArray(data)) {
            data.forEach(item => {
                previewData.labels.push(item[labelField] || '');
                
                // Procesar valor porcentual
                let value = item[valueField];
                if (typeof value === 'string' && value.includes('%')) {
                    value = parseFloat(value.replace('%', '')) || 0;
                } else {
                    value = parseFloat(value) || 0;
                }
                previewData.values.push(value);
                
                // Determinar color basado en el valor
                if (value < 70) {
                    previewData.colors.push('rgb(231, 24, 49)'); // Rojo
                } else if (value >= 70 && value < 85) {
                    previewData.colors.push('rgb(239, 198, 0)'); // Amarillo
                } else {
                    previewData.colors.push('rgb(140, 214, 16)'); // Verde
                }
                
                // Procesar valor esperado si existe
                if (expectedField && item[expectedField]) {
                    let expectedValue = item[expectedField];
                    if (typeof expectedValue === 'string' && expectedValue.includes('%')) {
                        expectedValue = parseFloat(expectedValue.replace('%', '')) || 0;
                    } else {
                        expectedValue = parseFloat(expectedValue) || 0;
                    }
                    previewData.expectedValues.push(expectedValue);
                }
            });
        } else if (typeof data === 'object') {
            previewData.labels.push(labelField ? data[labelField] : '');
            
            // Procesar valor porcentual
            let value = valueField ? data[valueField] : '0';
            if (typeof value === 'string' && value.includes('%')) {
                value = parseFloat(value.replace('%', '')) || 0;
            } else {
                value = parseFloat(value) || 0;
            }
            previewData.values.push(value);
            
            // Determinar color basado en el valor
            if (value < 70) {
                previewData.colors.push('rgb(231, 24, 49)'); // Rojo
            } else if (value >= 70 && value < 85) {
                previewData.colors.push('rgb(239, 198, 0)'); // Amarillo
            } else {
                previewData.colors.push('rgb(140, 214, 16)'); // Verde
            }
            
            // Procesar valor esperado si existe
            if (expectedField && data[expectedField]) {
                let expectedValue = data[expectedField];
                if (typeof expectedValue === 'string' && expectedValue.includes('%')) {
                    expectedValue = parseFloat(expectedValue.replace('%', '')) || 0;
                } else {
                    expectedValue = parseFloat(expectedValue) || 0;
                }
                previewData.expectedValues.push(expectedValue);
            }
        }
        
        previewContainer.innerHTML = `
            <strong>Etiquetas:</strong> ${JSON.stringify(previewData.labels)}<br>
            <strong>Valores:</strong> ${JSON.stringify(previewData.values)}%<br>
            ${previewData.expectedValues.length > 0 ? 
              `<strong>Valores esperados:</strong> ${JSON.stringify(previewData.expectedValues)}%<br>` : ''}
            <div class="chart-container" style="height: 200px;">
                <canvas class="chart-preview"></canvas>
            </div>
        `;
        
        // Renderizar el gráfico preview
        renderChartPreview(card, previewData);
        
    } catch (error) {
        console.error('Error generating data preview:', error);
        previewContainer.innerHTML = `
            <div class="alert alert-warning">
                Error al generar vista previa: ${error.message}
            </div>
        `;
    }
    
    updateIndicatorDataJson(card);
}

function renderChartPreview(card, data) {
    const canvas = card.querySelector('.chart-preview');
    if (!canvas) return;
    
    // Destruir el gráfico anterior si existe
    if (canvas.chart) {
        canvas.chart.destroy();
    }
    
    setTimeout(() => {
        const ctx = canvas.getContext('2d');
        
        // Configuración básica del gráfico
        const chartConfig = {
            type: 'doughnut',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.values,
                    backgroundColor: data.colors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        };
        
        // Crear el gráfico
        canvas.chart = new Chart(ctx, chartConfig);
        
        // Dibujar manualmente las líneas de valor esperado
        if (data.expectedValues && data.expectedValues.length > 0) {
            const chart = canvas.chart;
            const originalDraw = chart.draw;
            
            // Sobrescribir el método draw para añadir nuestras líneas
            chart.draw = function() {
                originalDraw.apply(this, arguments);
                
                const {ctx, chartArea} = chart;
                const centerX = (chartArea.left + chartArea.right) / 2;
                const centerY = (chartArea.top + chartArea.bottom) / 2;
                const radius = Math.min(
                    (chartArea.right - chartArea.left) / 2,
                    (chartArea.bottom - chartArea.top) / 2
                ) * 0.85; // Ajustar al 85% del radio
                
                ctx.save();
                
                data.expectedValues.forEach(expectedValue => {
                    // Calcular la posición del ángulo basado en el porcentaje
                    const angle = Math.PI * (1 - (expectedValue / 100));
                    
                    // Calcular las coordenadas del punto final de la línea
                    const x = centerX + Math.cos(angle) * radius;
                    const y = centerY + Math.sin(angle) * radius;
                    
                    // Dibujar la línea
                    ctx.beginPath();
                    ctx.setLineDash([6, 6]);
                    ctx.strokeStyle = 'rgb(54, 162, 235)';
                    ctx.lineWidth = 2;
                    ctx.moveTo(centerX, centerY);
                    ctx.lineTo(x, y);
                    ctx.stroke();
                    
                    // Dibujar el texto
                    ctx.fillStyle = 'rgb(54, 162, 235)';
                    ctx.font = '12px Arial';
                    ctx.fillText(`Meta: ${expectedValue}%`, x + 10, y);
                });
                
                ctx.restore();
            };
            
            // Redibujar el gráfico para mostrar las líneas
            chart.update();
        }
    }, 100);
}

function generateDataPreview(indicatorData) {
    if (!indicatorData) return 'No hay datos disponibles';
    
    if (indicatorData.data_source === 'manual') {
        return `Configuración manual: ${JSON.stringify(indicatorData.data_config || {})}`;
    } else if (indicatorData.data_source === 'api') {
        if (!indicatorData.api_response) return 'No hay datos de API disponibles';
        
        try {
            const data = typeof indicatorData.api_response === 'string' ? 
                JSON.parse(indicatorData.api_response) : indicatorData.api_response;
                
            let labels = [];
            let values = [];
            
            if (Array.isArray(data)) {
                labels = data.map(item => item[indicatorData.label_field] || '');
                values = data.map(item => item[indicatorData.value_field] || 0);
            } else if (typeof data === 'object') {
                labels = [indicatorData.label_field ? data[indicatorData.label_field] : ''];
                values = [indicatorData.value_field ? data[indicatorData.value_field] : 0];
            }
            
            return `
                <strong>Etiquetas:</strong> ${JSON.stringify(labels)}<br>
                <strong>Valores:</strong> ${JSON.stringify(values)}<br><br>
                <div class="chart-container" style="height: 200px;">
                    <canvas class="chart-preview"></canvas>
                </div>
            `;
        } catch (error) {
            return `Error al procesar datos de API: ${error.message}`;
        }
    }
    
    return 'No hay datos disponibles';
}

function updateIndicatorDataJson(card) {

    const jsonInput = card.querySelector('.indicator-data-json');
    const dataSource = card.querySelector('.data-source-select').value;
    
    let data = { data_source: dataSource };

    if (dataSource === 'manual') {
        // Procesar datos manuales
        const labels = Array.from(card.querySelectorAll('.manual-label')).map(i => i.value);
        const values = Array.from(card.querySelectorAll('.manual-value')).map(i => parseFloat(i.value) || 0);
        const expectedValues = Array.from(card.querySelectorAll('.manual-expected')).map(i => parseFloat(i.value) || 0);
        
        data.data_config = { labels, values, expected_values: expectedValues };
    } else {
        // Procesar datos de API
        data.api_url = card.querySelector('.api-url').value;
        data.api_response = tryParseJson(card.querySelector('.api-response-preview').textContent);
        data.label_field = card.querySelector('select[name$="[label_field]"]').value;
        data.value_field = card.querySelector('select[name$="[value_field]"]').value;
        
        const expectedFieldSelect = card.querySelector('select[name$="[expected_field]"]');
        if (expectedFieldSelect) {
            data.expected_field = expectedFieldSelect.value || null;
        }
    }
    
    jsonInput.value = JSON.stringify(data);
}


function tryParseJson(jsonString) {
    try {
        return JSON.parse(jsonString);
    } catch (e) {
        return jsonString;
    }
}

// Añade esto al final del archivo, antes de las exportaciones globales
function renderIndicatorCharts() {
    document.querySelectorAll('.indicator-chart').forEach(canvas => {
        try {
            const indicatorData = JSON.parse(canvas.getAttribute('data-indicator-data'));
            const data = parseIndicatorData(indicatorData);
             const indicatorId = canvas.closest('.indicator-card').querySelector('[data-indicator-id]').getAttribute('data-indicator-id');
            const currentValue = data.values[0] || 0;
            const expectedValue = data.expectedValues[0] || 0;
            
            document.querySelector(`.indicator-current-value[data-indicator-id="${indicatorId}"]`).textContent = `${currentValue.toFixed(2)}%`;
            document.querySelector(`.indicator-expected-value[data-indicator-id="${indicatorId}"]`).textContent = `${expectedValue.toFixed(2)}%`;
            // Destruir gráfico anterior si existe
            if (canvas.chart) {
                canvas.chart.destroy();
            }
            
            const ctx = canvas.getContext('2d');
            canvas.chart = new Chart(ctx, createChartConfig(data));
            
        } catch (error) {
            console.error('Error rendering indicator chart:', error);
        }
    });
}
// añade el chart del subproceso 
function loadSubprocessCharts() {
    document.querySelectorAll('.subprocess-chart').forEach(canvas => {
        try {
            const subprocessId = canvas.getAttribute('data-subprocess-id');
            const indicatorsData = JSON.parse(canvas.getAttribute('data-indicators'));
            
            console.log(`Cargando gráfico para subproceso ID: ${subprocessId}`);
            console.log('Indicadores:', indicatorsData);

            let totalValue = 0;
            let totalExpected = 0;
            let validIndicators = 0;
            
            indicatorsData.forEach(indicator => {
                try {
                    const indicatorData = indicator.data ? 
                        (typeof indicator.data === 'string' ? JSON.parse(indicator.data) : indicator.data) : 
                        {};
                    
                    if (indicatorData.data_source === 'api' && indicatorData.api_response) {
                        const response = typeof indicatorData.api_response === 'string' ? 
                            JSON.parse(indicatorData.api_response) : indicatorData.api_response;
                        
                        // Obtener valor actual
                        const valueStr = response[indicatorData.value_field] || '0%';
                        const value = parseFloat(valueStr.replace('%', '')) || 0;
                        totalValue += value;
                        
                        // Obtener valor esperado si existe
                        if (indicatorData.expected_field && response[indicatorData.expected_field]) {
                            const expectedStr = response[indicatorData.expected_field] || '0%';
                            const expectedValue = parseFloat(expectedStr.replace('%', '')) || 0;
                            totalExpected += expectedValue;
                        } else if (indicatorData.expected_values) {
                            // Manejar caso de datos manuales con valores esperados
                            const avgExpected = indicatorData.expected_values.reduce((sum, v) => sum + (parseFloat(v) || 0), 0) / indicatorData.expected_values.length;
                            totalExpected += avgExpected;
                        }
                        
                        validIndicators++;
                    } else if (indicatorData.data_source === 'manual' && indicatorData.data_config) {
                        const config = typeof indicatorData.data_config === 'string' ? 
                            JSON.parse(indicatorData.data_config) : indicatorData.data_config;
                        
                        if (config.values && config.values.length > 0) {
                            const avgValue = config.values.reduce((sum, v) => sum + (parseFloat(v) || 0), 0) / config.values.length;
                            totalValue += avgValue;
                            
                            if (config.expected_values && config.expected_values.length > 0) {
                                const avgExpected = config.expected_values.reduce((sum, v) => sum + (parseFloat(v) || 0), 0) / config.expected_values.length;
                                totalExpected += avgExpected;
                            }
                            
                            validIndicators++;
                        }
                    }
                } catch (error) {
                    console.error('Error procesando indicador:', error);
                }
            });
            
            // Calcular promedios
            const averageValue = validIndicators > 0 ? totalValue / validIndicators : 0;
            const averageExpected = validIndicators > 0 ? totalExpected / validIndicators : 0;
            
            console.log(`Resultados: ${averageValue}% (actual), ${averageExpected}% (esperado)`);
            
            // Renderizar el gráfico
            renderSubprocessChart(canvas, averageValue, averageExpected);
            
        } catch (error) {
            console.error('Error en loadSubprocessCharts:', error);
        }
    });
}

function renderSubprocessChart(canvas, currentValue, expectedValue = 0) {
    // Destruir gráfico anterior si existe
    if (canvas.chart) {
        canvas.chart.destroy();
    }
    
    const remainingValue = Math.max(0, 100 - currentValue);
    const ctx = canvas.getContext('2d');
    
    // Determinar color basado en el valor
    let color;
    if (currentValue < 70) {
        color = 'rgb(231, 24, 49)'; // Rojo
    } else if (currentValue >= 70 && currentValue < 85) {
        color = 'rgb(239, 198, 0)'; // Amarillo
    } else {
        color = 'rgb(140, 214, 16)'; // Verde
    }
    
    // Configuración del gráfico
    const chartConfig = {
        type: 'doughnut',
        data: {
            labels: ['Promedio', 'Restante'],
            datasets: [{
                data: [currentValue, remainingValue],
                backgroundColor: [color, 'rgb(240, 240, 240)'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            circumference: 180, // Medio círculo
            rotation: -90, // Comenzar desde la parte superior
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw.toFixed(2)}%`;
                        }
                    }
                }
            },
            cutout: '70%' // Grosor del anillo
        }
    };
    
    // Crear el gráfico
    canvas.chart = new Chart(ctx, chartConfig);
    
    // Añadir línea de meta si existe
    if (expectedValue > 0) {
        addExpectedLine(canvas.chart, expectedValue);
    }
    const subprocessId = canvas.getAttribute('data-subprocess-id');
    document.querySelector(`.subprocess-average-value[data-subprocess-id="${subprocessId}"]`).textContent = `${currentValue.toFixed(2)}%`;
    document.querySelector(`.subprocess-expected-value[data-subprocess-id="${subprocessId}"]`).textContent = `${expectedValue.toFixed(2)}%`;
}

function addExpectedLine(chart, expectedValue) {
    const originalDraw = chart.draw;
    
    chart.draw = function() {
        originalDraw.apply(this, arguments);
        
        const {ctx, chartArea} = chart;
        const centerX = (chartArea.left + chartArea.right) / 2;
        const centerY = (chartArea.top + chartArea.bottom) / 2;
        const radius = Math.min(
            (chartArea.right - chartArea.left) / 2,
            (chartArea.bottom - chartArea.top) / 2
        ) * 0.85;
        
        // Calcular posición de la línea
        const angle = Math.PI * (1 - (expectedValue / 100));
        const endX = centerX + Math.cos(angle) * radius;
        const endY = centerY + Math.sin(angle) * radius;
        
        // Dibujar línea
        ctx.save();
        ctx.beginPath();
        ctx.strokeStyle = 'rgb(54, 162, 235)';
        ctx.lineWidth = 2;
        ctx.setLineDash([5, 5]);
        ctx.moveTo(centerX, centerY);
        ctx.lineTo(endX, endY);
        ctx.stroke();
        
        // Añadir texto
        ctx.fillStyle = 'rgb(54, 162, 235)';
        ctx.font = '12px Arial';
        ctx.fillText(`Meta: ${expectedValue.toFixed(2)}%`, endX + 10, endY);
        ctx.restore();
    };
    
    chart.update();
}

// Función para cargar gráficos de procesos
function loadProcessCharts(canvas) {
    try {
        const processId = canvas.getAttribute('data-process-id');
        const subprocessesData = JSON.parse(canvas.getAttribute('data-subprocesses'));
        
        console.log(`Cargando gráfico para proceso ID: ${processId}`);
        console.log('Subprocesos:', subprocessesData);

        // Calcular promedios de subprocesos
        let totalValue = 0;
        let totalExpected = 0;
        let validSubprocesses = 0;
        
        subprocessesData.forEach(subprocess => {
            try {
                // Obtener el valor consolidado del subproceso
                const subprocessValue = calculateSubprocessAverage(subprocess);
                
                if (subprocessValue !== null) {
                    totalValue += subprocessValue.average;
                    if (subprocessValue.expected) {
                        totalExpected += subprocessValue.expected;
                    }
                    validSubprocesses++;
                }
            } catch (error) {
                console.error('Error procesando subproceso:', error);
            }
        });
        
        // Calcular promedios
        const averageValue = validSubprocesses > 0 ? totalValue / validSubprocesses : 0;
        const averageExpected = validSubprocesses > 0 ? totalExpected / validSubprocesses : 0;
        
        console.log(`Resultados proceso: ${averageValue}% (actual), ${averageExpected}% (esperado)`);
                // Actualizar los valores en la card
        document.querySelector(`.process-average-value[data-process-id="${processId}"]`).textContent = `${averageValue.toFixed(2)}%`;
        document.querySelector(`.process-expected-value[data-process-id="${processId}"]`).textContent = `${averageExpected.toFixed(2)}%`;
        // Renderizar el gráfico (usamos la misma función que para subprocesos)
        renderSubprocessChart(canvas, averageValue, averageExpected);
        
    } catch (error) {
        console.error('Error en loadProcessCharts:', error);
    }
}

// Función para calcular el promedio de un subproceso
function calculateSubprocessAverage(subprocess) {
    let totalValue = 0;
    let totalExpected = 0;
    let validIndicators = 0;
    
    subprocess.indicators.forEach(indicator => {
        try {
            const indicatorData = indicator.data ? 
                (typeof indicator.data === 'string' ? JSON.parse(indicator.data) : indicator.data) : 
                {};
            
            if (indicatorData.data_source === 'api' && indicatorData.api_response) {
                const response = typeof indicatorData.api_response === 'string' ? 
                    JSON.parse(indicatorData.api_response) : indicatorData.api_response;
                
                const valueStr = response[indicatorData.value_field] || '0%';
                const value = parseFloat(valueStr.replace('%', '')) || 0;
                totalValue += value;
                
                if (indicatorData.expected_field && response[indicatorData.expected_field]) {
                    const expectedStr = response[indicatorData.expected_field] || '0%';
                    const expectedValue = parseFloat(expectedStr.replace('%', '')) || 0;
                    totalExpected += expectedValue;
                }
                
                validIndicators++;
            } else if (indicatorData.data_source === 'manual' && indicatorData.data_config) {
                const config = typeof indicatorData.data_config === 'string' ? 
                    JSON.parse(indicatorData.data_config) : indicatorData.data_config;

                if (Array.isArray(config.values) && config.values.length > 0) {
                    const sumValues = config.values.reduce((sum, v) => sum + (parseFloat(v) || 0), 0);
                    const avgValue = sumValues / config.values.length;
                    totalValue += avgValue;

                    if (Array.isArray(config.expected_values) && config.expected_values.length > 0) {
                        const sumExpected = config.expected_values.reduce((sum, v) => sum + (parseFloat(v) || 0), 0);
                        const avgExpected = sumExpected / config.expected_values.length;
                        totalExpected += avgExpected;
                    }

                    validIndicators++;
                }

            }
        } catch (error) {
            console.error('Error procesando indicador:', error);
        }
    });
    
    if (validIndicators === 0) return null;
    
    return {
        average: totalValue / validIndicators,
        expected: totalExpected / validIndicators
    };
    
}
function loadPropiedadCharts(canvas) {
    try {
        const propiedadId = canvas.getAttribute('data-propiedad-id');
        const processesData = JSON.parse(canvas.getAttribute('data-processes'));
        
        console.log(`Cargando gráfico para propiedad ID: ${propiedadId}`);
        console.log('Procesos:', processesData);

        // Calcular promedios de procesos
        let totalValue = 0;
        let totalExpected = 0;
        let validProcesses = 0;
        
        processesData.forEach(process => {
            try {
                // Obtener el valor consolidado del proceso
                const processValue = calculateProcessAverage(process);
                
                if (processValue !== null) {
                    totalValue += processValue.average;
                    if (processValue.expected) {
                        totalExpected += processValue.expected;
                    }
                    validProcesses++;
                }
                
            } catch (error) {
                console.error('Error procesando proceso:', error);
            }
        });
        
        // Calcular promedios
        const averageValue = validProcesses > 0 ? totalValue / validProcesses : 0;
        const averageExpected = validProcesses > 0 ? totalExpected / validProcesses : 0;
        
        console.log(`Resultados propiedad: ${averageValue}% (actual), ${averageExpected}% (esperado)`);
        
        // Renderizar el gráfico
        renderPropiedadChart(canvas, averageValue, averageExpected);

    } catch (error) {
        console.error('Error en loadPropiedadCharts:', error);
    }
}

function renderPropiedadChart(canvas, currentValue, expectedValue = 0) {
    // Similar a renderSubprocessChart pero con estilo diferente

    if (canvas.chart) {
        canvas.chart.destroy();
    }
    
    const remainingValue = Math.max(0, 100 - currentValue);
    const ctx = canvas.getContext('2d');
    
    // Determinar color basado en el valor
    let color;
    if (currentValue < 70) {
        color = 'rgb(231, 24, 49)'; // Rojo
    } else if (currentValue >= 70 && currentValue < 85) {
        color = 'rgb(239, 198, 0)'; // Amarillo
    } else {
        color = 'rgb(140, 214, 16)'; // Verde
    }
    
    // Configuración del gráfico
    const chartConfig = {
        type: 'doughnut',
        data: {
            labels: ['Promedio', 'Restante'],
            datasets: [{
                data: [currentValue, remainingValue],
                backgroundColor: [color, 'rgb(240, 240, 240)'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            circumference: 180,
            rotation: -90,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw.toFixed(2)}%`;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    };
    
    // Crear el gráfico
    canvas.chart = new Chart(ctx, chartConfig);
    
    // Añadir línea de meta si existe
    if (expectedValue > 0) {
        addExpectedLine(canvas.chart, expectedValue);
    }
           const propiedadId = canvas.getAttribute('data-propiedad-id');
    document.querySelector(`.propiedad-average-value[data-propiedad-id="${propiedadId}"]`).textContent = `${currentValue.toFixed(2)}%`;
    document.querySelector(`.propiedad-expected-value[data-propiedad-id="${propiedadId}"]`).textContent = `${expectedValue.toFixed(2)}%`;
    
}

// Función para calcular el promedio de un proceso
function calculateProcessAverage(process) {
    let totalValue = 0;
    let totalExpected = 0;
    let validSubprocesses = 0;
    
    process.subprocesses.forEach(subprocess => {
        const subprocessValue = calculateSubprocessAverage(subprocess);
        if (subprocessValue !== null) {
            totalValue += subprocessValue.average;
            if (subprocessValue.expected) {
                totalExpected += subprocessValue.expected;
            }
            validSubprocesses++;
        }
    });

    
    if (validSubprocesses === 0) return null;
    
    return {
        average: totalValue / validSubprocesses,
        expected: totalExpected / validSubprocesses
        
    };
    
}


// Llamar al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    loadSubprocessCharts();
});

function parseIndicatorData(indicatorData) {
    // Parsear los datos del indicador para la gráfica
    let data = {
        labels: [],
        values: [],
        expectedValues: [],
        colors: []
    };
    
    try {
        if (indicatorData.data_source === 'api' && indicatorData.api_response) {
            const apiData = typeof indicatorData.api_response === 'string' ? 
                JSON.parse(indicatorData.api_response) : indicatorData.api_response;
            
            if (Array.isArray(apiData)) {
                const item = apiData[0]; // Tomamos el primer elemento para la vista de tabla
                data.labels.push(item[indicatorData.label_field] || '');
                
                let value = item[indicatorData.value_field];
                if (typeof value === 'string' && value.includes('%')) {
                    value = parseFloat(value.replace('%', '')) || 0;
                } else {
                    value = parseFloat(value) || 0;
                }
                data.values.push(value);
                
                if (indicatorData.expected_field) {
                    let expectedValue = item[indicatorData.expected_field];
                    if (typeof expectedValue === 'string' && expectedValue.includes('%')) {
                        expectedValue = parseFloat(expectedValue.replace('%', '')) || 0;
                    } else {
                        expectedValue = parseFloat(expectedValue) || 0;
                    }
                    data.expectedValues.push(expectedValue);
                }
            } else if (typeof apiData === 'object') {
                data.labels.push(apiData[indicatorData.label_field] || '');
                
                let value = apiData[indicatorData.value_field];
                if (typeof value === 'string' && value.includes('%')) {
                    value = parseFloat(value.replace('%', '')) || 0;
                } else {
                    value = parseFloat(value) || 0;
                }
                data.values.push(value);
                
                if (indicatorData.expected_field) {
                    let expectedValue = apiData[indicatorData.expected_field];
                    if (typeof expectedValue === 'string' && expectedValue.includes('%')) {
                        expectedValue = parseFloat(expectedValue.replace('%', '')) || 0;
                    } else {
                        expectedValue = parseFloat(expectedValue) || 0;
                    }
                    data.expectedValues.push(expectedValue);
                }
            }
        } else if (indicatorData.data_source === 'manual' && indicatorData.data_config) {
            const config = typeof indicatorData.data_config === 'string' ? 
                JSON.parse(indicatorData.data_config) : indicatorData.data_config;
            
            if (config.labels && config.values) {
                data.labels.push(config.labels[0] || '');
                data.values.push(parseFloat(config.values[0]) || 0);
            }
        }
        
        // Determinar color basado en el valor
        const value = data.values[0] || 0;
        if (value < 70) {
            data.colors.push('rgb(231, 24, 49)'); // Rojo
        } else if (value >= 70 && value < 85) {
            data.colors.push('rgb(239, 198, 0)'); // Amarillo
        } else {
            data.colors.push('rgb(140, 214, 16)'); // Verde
        }
        
    } catch (error) {
        console.error('Error parsing indicator data:', error);
    }
    
    return data;
}

function createChartConfig(data) {
    const currentValue = data.values[0] || 0;
    const expectedValue = data.expectedValues[0] || 0;
    const remainingValue = Math.max(0, 100 - currentValue);
    
    // Configuración básica del gráfico
    const config = {
        type: 'doughnut',
        data: {
            labels: ['Promedio', 'Restante'],
            datasets: [{
                data: [currentValue, remainingValue],
                backgroundColor: [data.colors[0] || 'rgb(140, 214, 16)', 'rgb(200, 200, 200)'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            circumference: 180,
            rotation: -90,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            },
            cutout: '70%'
        }
    };
    
    return config;
}


// Llama a esta función después de cargar la página
document.addEventListener('DOMContentLoaded', function() {
    renderIndicatorCharts();
        document.querySelector('#indicatorModal .data-source-select')?.addEventListener('change', function(e) {
        handleModalDataSourceChange(e.target);
    });
    
    document.querySelector('#indicatorModal .test-api-btn')?.addEventListener('click', function() {
        testModalApiEndpoint();
    });
    
    document.querySelector('#indicatorModal').addEventListener('change', function(e) {
        if (e.target.matches('.data-field-select')) {
            updateModalDataPreview();
        }
    });

    document.querySelector('#indicatorModal').addEventListener('click', function(e) {
        if (e.target.matches('.add-manual-row')) {
            addManualDataRow();
        }
        if (e.target.matches('.remove-manual-row')) {
            e.target.closest('.manual-data-row').remove();
            updateModalIndicatorDataJson();
            updateModalDataPreview();
        }
    });

    document.querySelector('#indicatorModal').addEventListener('input', function(e) {
        if (e.target.matches('.manual-label') || e.target.matches('.manual-value') || e.target.matches('.manual-expected')) {
            updateModalIndicatorDataJson();
            updateModalDataPreview();
        }
    });
});


// También llama a esta función después de cualquier actualización dinámica de la tabla
window.renderIndicatorCharts = renderIndicatorCharts;
window.loadSubprocessCharts = loadSubprocessCharts;

window.loadPropiedadCharts = loadPropiedadCharts;

    document.addEventListener('click', function(e) {
        if (e.target.matches('.add-manual-row')) {
            const container = e.target.closest('.manual-data-section').querySelector('.manual-data-inputs');
            container.insertAdjacentHTML('beforeend', `
                <div class="form-row manual-data-row mt-2">
                    <div class="col-md-5">
                        <input type="text" class="form-control manual-label" placeholder="Etiqueta (ej. Enero)">
                    </div>
                    <div class="col-md-5">
                        <input type="number" class="form-control manual-value" placeholder="Valor (ej. 75)">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-manual-row">&times;</button>
                    </div>
                </div>`);
        }

        if (e.target.matches('.remove-manual-row')) {
            e.target.closest('.manual-data-row').remove();
            
        }
    });

    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('manual-label') || e.target.classList.contains('manual-value') || e.target.classList.contains('manual-expected')) {
            const card = e.target.closest('.indicator-card');
            updateIndicatorDataJson(card);
            updateDataPreview(card);
        }
    });

    


// Hacer funciones accesibles globalmente
window.openEditForm = openEditForm;
window.openCreateForm = openCreateForm;
window.addSubprocess = addSubprocess;
window.addIndicator = addIndicator;
window.openEditForm = openEditForm;
window.deleteProcess = deleteProcess;
window.loadProcessCharts = loadProcessCharts;
