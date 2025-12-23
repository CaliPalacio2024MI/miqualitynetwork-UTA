<head>
  @vite('resources/css/update.css')
  @vite('resources/js/update.js')
</head>

<body>
<div class="modal fade modal-pos" id="modal-close-plan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-label">Plan de acción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <!--div>
      @if(Session::get('success'))
        <div class="alert alert-success form-alert">
            <p class="text-success text-alert">{{ Session::get('success') }}</p>
        </div>
      @endif

      @if(Session::get('error'))
        <div class="alert alert-danger form-alert">
            <p class="text-danger text-alert">{{ Session::get('error') }}</p>
        </div>
      @endif
      </div-->

        <form action="close" method="post">
        @csrf
          <input type="hidden" name="id-plan" id="value-id">
          <label class="" for="result-plan">Seleccione el resultado de las acciones tomadas</label><br>
          <select class="border" name="result-plan">
            <option value="Eficaz">Eficaz</option>
            <option value="No eficaz">No eficaz</option>
          </select>
        
        
        
      </div>
      <div class="modal-footer">

        <input class="btn btn-primary" type="submit" value="Guardar">

        <!--button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button-->

        
        </form>

        <button id="back-to-plan" type="button" class="btn btn-secondary">Salir</button>
      </div>
    </div>
  </div>
</div>
</body>