<head>
  @vite('resources/css/update.css')
  @vite('resources/js/update.js')
</head>

<body>

@include('layouts/modal_close_item')
@include('layouts/modal_postpone_item')

<div class="modal fade" id="modal-plan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-label">Plan de acción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>No.:</strong> <span id="no"></span></p>
        <p><strong>Origen:</strong> <span id="origen"></span></p>
        <p><strong>Propiedad:</strong> <span id="propiedad"></span></p>
        <p><strong>Proceso:</strong> <span id="proceso"></span></p>
        <p><strong>Oportunidad de mejora:</strong> <span id="o_mejora"></span></p>
        <p><strong>Criterio:</strong> <span id="criterio"></span></p>
        <p><strong>Causa raíz:</strong> <span id="c_raiz"></span></p>
        <p><strong>Tipo de solución:</strong> <span id="tipo_sol"></span></p>
        <p><strong>Descripción de la solución:</strong> <span id="desc_sol"></span></p>
        <p><strong>Costo:</strong> <span id="costo"></span></p>
        <p><strong>Responsable:</strong> <span id="responsable"></span></p>
        <p><strong>Observaciones:</strong> <span id="observaciones"></span></p>
        <p><strong>Estado:</strong> <span id="estado"></span></p>
        <p><strong>Fecha de creación:</strong> <span id="fecha_creacion"></span></p>
        <p id="date-closed"><strong>Fecha de cierre:</strong> <span id="fecha_cerrado"></span></p>
        <p><strong>Fecha de inicio:</strong> <span id="fecha_inicio"></span></p>
        <p><strong>Fecha de cumplimiento:</strong> <span id="fecha_ter"></span></p>
        <p id="show-result"><strong>Resultado:</strong> <span id="resultado"></span></p>
      </div>
      <div class="modal-footer">

        <button id="close-plan" type="button" class="btn btn-primary">Cerrar</button>

        <button id="postpone-item" type="button" class="btn btn-warning">Reprogramar</button> 

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>


        


        <!--dialog class="" id="dialog">
        
          <input type="hidden" name="id-plan" id="value-id">

          <label class="" for="result-plan">Seleccione el resultado de las acciones tomadas</label><br>
            <form action="">
              <select class="" name="result-plan" id="">
                <option value="Eficaz">Eficaz</option>
                <option value="No eficaz">No eficaz</option>
              </select><br>

            <input class="" type="submit" value="Guardar">
          </form>
          



          <button onclick="window.dialog.close();">close</button>
        </dialog-->



      </div>
    </div>
  </div>
</div>
</body>