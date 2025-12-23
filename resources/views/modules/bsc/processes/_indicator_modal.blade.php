<div class="modal fade" id="indicatorModal" tabindex="-1" aria-labelledby="indicatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="indicatorModalLabel">Nuevo Indicador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="indicatorForm" method="POST">
                @csrf
                <input type="hidden" name="subprocess_id" value="">
                <input type="hidden" name="_method" value="POST">
                
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nombre del Indicador</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Origen de los datos</label>
                        <select class="form-control data-source-select" name="data_source">
                            <option value="manual">Ingreso manual</option>
                            <option value="api">API Externa</option>
                        </select>
                    </div>
                    
                    <!-- Sección para configuración de API -->
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
                        
                        <div class="form-group mb-3 api-response-container" style="display: none;">
                            <label>Respuesta de la API</label>
                            <pre class="api-response-preview bg-light p-2"></pre>
                        </div>
                        
                        <div class="form-group mb-3 data-mapping-container" style="display: none;">
                            <label>Mapeo de datos</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Campo para etiquetas</label>
                                    <select class="form-control data-field-select" name="label_field">
                                        <option value="">Seleccione un campo</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Campo para valores</label>
                                    <select class="form-control data-field-select" name="value_field">
                                        <option value="">Seleccione un campo</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Campo para valor esperado (opcional)</label>
                                    <select class="form-control data-field-select" name="expected_field">
                                        <option value="">Seleccione un campo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección para configuración manual - MODIFICADA -->
                    <div class="manual-data-section">
                        <label>Datos Manuales</label>
                        <div class="manual-data-inputs">
                            <!-- Las filas de datos manuales se agregarán dinámicamente aquí -->
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
                        </div>

                    </div>
                    
                    <div class="form-group mb-3 data-preview-container">
                        <label>Vista previa de datos</label>
                        <div class="data-preview bg-light p-2">
                            No hay datos disponibles
                        </div>
                    </div>
                    
                    
                </div>
                <input type="hidden" name="data" class="indicator-data-json" value="{}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Guardar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>