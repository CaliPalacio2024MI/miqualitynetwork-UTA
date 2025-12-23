<head>
  @vite('resources/css/update.css')
  @vite('resources/js/update.js')
</head>

<body>
<div class="modal fade modal-pos" id="modal-postpone-plan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <form action="postpone" method="post">
        @csrf
          <input type="hidden" name="post-id-plan" id="post-value-id">
          <input type="hidden" name="prev-date-plan" id="prev-value-date">
          <label class="" for="postpone">Seleccione la fecha de reprogramación</label><br>
          <input class="border" type="date" name="postpone" id="postpone-plan"><br>
          <label class="" for="reason">Motivo de la reprogramación</label><br>
          <textarea class="border reason-box" name="reason" id="postpone-reason" rows="2"></textarea>
      </div>
      <div class="modal-footer">

        <input class="btn btn-primary" type="submit" value="Guardar">

        <!--button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button-->

        
        </form>

        <button id="back-to-item" type="button" class="btn btn-secondary">Salir</button>
      </div>
    </div>
  </div>
</div>
</body>