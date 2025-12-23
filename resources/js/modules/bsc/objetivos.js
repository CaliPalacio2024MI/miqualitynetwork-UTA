

document.addEventListener('alpine:init', () => {
    Alpine.data('objetivosApp', () => ({
        showForm: false,
        editMode: false,
        loading: false,
        formData: {
            id: null,
            name: '',
            peso: '',
            property_id: '',
            parent_id: '',
            api_url: '',
            api_params: [
                { key: 'periodo', value: '2024' },
                { key: 'propiedad', value: 'Principal' }
            ],
            indicador_key: '',
            chart_config: {
                type: 'line',
                color: '#3c8dbc',
                showValues: true
            }
        },
        availableFields: [],
        apiPreviewUrl: '',
        apiData: null,
        chart: null,

        // Método de inicialización
        init() {
            console.log('Componente objetivosApp inicializado');
        },

        // Método para abrir el formulario de creación
        openCreateForm() {
            console.log('Función openCreateForm ejecutada');
            this.resetForm();
            this.showForm = true;
            this.editMode = false;
            this.formAction = '/objetivos'; // Ruta POST para crear
        },

        // Resto de tus métodos permanecen igual...
        resetForm() {
            this.formData = {
                id: null,
                name: '',
                peso: '',
                property_id: '',
                parent_id: '',
                api_url: '',
                api_params: [
                    { key: 'periodo', value: '2024' },
                    { key: 'propiedad', value: 'Principal' }
                ],
                indicador_key: '',
                chart_config: {
                    type: 'line',
                    color: '#3c8dbc',
                    showValues: true
                }
            };
            this.apiPreviewUrl = '';
            this.apiData = null;
            this.availableFields = [];
        },openEditForm(objetivo) {
            this.loading = true;
            this.showForm = true;
            this.editMode = true;
            
            // Convertir los datos del objetivo al formato del formulario
            this.formData = {
                id: objetivo.id,
                name: objetivo.name,
                peso: objetivo.peso,
                property_id: objetivo.property_id,
                parent_id: objetivo.parent_id,
                api_url: objetivo.api_url,
                api_params: JSON.parse(objetivo.api_params),
                indicador_key: objetivo.indicador_key,
                chart_config: JSON.parse(objetivo.chart_config)
            };
            
            this.formAction = `/objetivos/${objetivo.id}`;
            this.loading = false;
            
            // Si hay URL de API, actualizar vista previa
            if (objetivo.api_url) {
                this.updateApiPreview();
            }
        },

        closeForm() {
            this.showForm = false;
            this.resetForm();
            if (this.chart) {
                this.chart.destroy();
                this.chart = null;
            }
        },

        resetForm() {
            this.formData = {
                id: null,
                name: '',
                peso: '',
                property_id: '',
                parent_id: '',
                api_url: '',
                api_params: [
                    { key: 'periodo', value: '2024' },
                    { key: 'propiedad', value: 'Principal' }
                ],
                indicador_key: '',
                chart_config: {
                    type: 'line',
                    color: '#3c8dbc',
                    showValues: true
                }
            };
            this.apiPreviewUrl = '';
            this.apiData = null;
            this.availableFields = [];
        },

        // Métodos para parámetros API
        addParam() {
            this.formData.api_params.push({ key: '', value: '' });
        },

        removeParam(index) {
            this.formData.api_params.splice(index, 1);
            this.updateApiPreview();
        },

        updateApiPreview() {
            if (!this.formData.api_url) return;
            
            const params = {};
            this.formData.api_params.forEach(param => {
                if (param.key && param.value) {
                    params[param.key] = param.value;
                }
            });
            
            const queryString = new URLSearchParams(params).toString();
            this.apiPreviewUrl = `${this.formData.api_url}?${queryString}`;
        },

        // Métodos para vista previa
        fetchData() {
            if (!this.formData.api_url || !this.apiPreviewUrl) {
                alert('Complete la URL de la API y los parámetros primero');
                return;
            }
            
            this.loading = true;
            this.apiData = null;
            
            fetch(this.apiPreviewUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta de la API');
                    return response.json();
                })
                .then(data => {
                    this.apiData = this.processApiData(data);
                    this.availableFields = this.extractAvailableFields(data);
                    this.renderChart();
                    this.loading = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al obtener datos de la API: ' + error.message);
                    this.loading = false;
                });
        },

        processApiData(data) {
            if (!data) return null;
            
            // Procesamiento básico de datos para el gráfico
            if (Array.isArray(data) && data.length > 0) {
                return {
                    labels: data.map(item => item.fecha || item.periodo || 'Dato ' + (index + 1)),
                    values: data.map(item => item[this.formData.indicador_key] || 0)
                };
            } else if (typeof data === 'object') {
                return {
                    labels: Object.keys(data),
                    values: Object.values(data)
                };
            }
            return null;
        },

        extractAvailableFields(data) {
            if (Array.isArray(data) && data.length > 0) {
                return Object.keys(data[0]);
            } else if (typeof data === 'object') {
                return Object.keys(data);
            }
            return [];
        },

        renderChart() {
            if (!this.apiData) return;
            
            const ctx = document.getElementById('previewChart').getContext('2d');
            
            // Destruir gráfico anterior si existe
            if (this.chart) {
                this.chart.destroy();
            }
            
            this.chart = new Chart(ctx, {
                type: this.formData.chart_config.type,
                data: {
                    labels: this.apiData.labels,
                    datasets: [{
                        label: this.formData.indicador_key,
                        data: this.apiData.values,
                        backgroundColor: this.getBackgroundColors(),
                        borderColor: this.formData.chart_config.color,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        },

        getBackgroundColors() {
            if (this.formData.chart_config.type === 'line') {
                return this.formData.chart_config.color;
            }
            
            // Para gráficos de barras/pastel, generar colores variados
            return this.apiData.values.map((_, i) => {
                return this.adjustColor(this.formData.chart_config.color, i * 30);
            });
        },

        adjustColor(color, amount) {
            return '#' + color.replace(/^#/, '').replace(/../g, color => 
                ('0' + Math.min(255, Math.max(0, parseInt(color, 16) + amount)).toString(16)).slice(-2)
            );
        }
        

        
    }));
});