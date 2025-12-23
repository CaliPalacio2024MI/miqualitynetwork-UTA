<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="processForm" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST" id="formMethod">
                
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="formTitle">Crear Proceso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre del Proceso</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="propiedad_id">Propiedad</label>
                                <select class="form-control" id="propiedad_id" name="id_propiedad" required>
                                    <option value="">Seleccione una propiedad</option>
                                    @foreach($propiedades as $propiedad)
                                        <option value="{{ $propiedad->id_propiedad }}">{{ $propiedad->nombre_propiedad }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center bg-light">
                            <h6 class="m-0 font-weight-bold">Departamento</h6>
                            <button type="button" class="btn btn-sm btn-primary" id="addSubprocessBtn">
                                <i class="fas fa-plus mr-1"></i> Agregar Departamento
                            </button>
                        </div>
                        <div class="card-body" id="subprocessesContainer">
                            <!-- Subprocesos se agregarán aquí dinámicamente -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="submit-text">Guardar</span>
                        <span class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>