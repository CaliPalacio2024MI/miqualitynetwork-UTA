<div class="modal fade" id="subprocessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subprocessModalLabel">Editar Subproceso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="subprocessForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="process_id" value="">
                    
                    <div class="mb-3">
                        <label for="subprocessName" class="form-label">Nombre del Departamento</label>
                        <input type="text" class="form-control" id="subprocessName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>