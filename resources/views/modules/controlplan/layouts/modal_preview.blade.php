<head>
  
  
</head>

<body>
<div class="modal fade" id="modal-plan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-label">Previsualización</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="previewtable" class="actions">
            <thead>
                <th>Origen</th>
                <th>Proceso</th>
                <th>Oportunidad de mejora</th>
                <th>Descripción de la solución</th>
                <th>Responsable</th>
                <th>Fecha de cumplimiento</th>    
            </thead>
            <tbody id="tablebody">
                
            </tbody>
        </table>








        

        <br><form class="signature-pad-form" action="#" method="POST">
        <canvas height="100" width="300" class="signature-pad"></canvas>
        <p><a href="#" class="clear-button">Limpiar</a></p>
        <button class="submit-button" type="submit">Guardar</button>
        </form>
    








      </div>
      <div class="modal-footer">
        <!--button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button-->
        <!--a id="obj-url" class="btn btn-info" href="{{ url('control-plan/print') }}" target="_blank">Imprimir</a-->
        <a id="obj-url" class="btn color-btn" target="_blank">Imprimir</a>
      </div>
    </div>
  </div>
</div>
</body>