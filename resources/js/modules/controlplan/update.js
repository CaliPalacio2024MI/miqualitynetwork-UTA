$(document).ready(function () {
    $('body').on('click', '#show-plan', function () {
      var planURL = $(this).data('url');
      $.get(planURL, function (data) {
          $('#modal-plan').modal('show');
          $('#no').text(data.no);
          $('#origen').text(data.origen);
          $('#propiedad').text(data.propiedad);
          $('#proceso').text(data.proceso);
          $('#o_mejora').text(data.o_mejora);
          $('#criterio').text(data.criterio);
          $('#c_raiz').text(data.c_raiz);
          $('#tipo_sol').text(data.tipo_sol);
          $('#desc_sol').text(data.desc_sol);
          $('#costo').text(data.costo);
          $('#responsable').text(data.responsable);
          $('#observaciones').text(data.observaciones);
          $('#estado').text(data.estado);
          $('#fecha_creacion').text(data.fecha_creacion);
          $('#fecha_cerrado').text(data.fecha_cerrado);
          $('#fecha_inicio').text(data.fecha_inicio);
          $('#fecha_ter').text(data.fecha_ter);
          $('#resultado').text(data.resultado);

          //envia el id del plan a la vista modal_close_item para cerrarlo
          $('#value-id').val(data.id);
          //envia el id y la fecha del plan a la vista modal_postpone_item para reprogramarlo
          $('#post-value-id').val(data.id);
          $('#prev-value-date').val(data.fecha_ter);
          
          //solo muestra el boton para cerrar y reprogramar si el plan no esta cerrado
          if(data.estado!="Abierto" && data.estado!="Reprogramado"){
            document.getElementById("close-plan").style.display = "none";
            document.getElementById("postpone-item").style.display = "none";
          }else{
            document.getElementById("close-plan").style.display = "block";
            document.getElementById("postpone-item").style.display = "block";
          }

          //solo muestra el resultado si el plan esta cerrado
          if(data.resultado=="Eficaz" || data.resultado=="No eficaz"){
            document.getElementById("show-result").style.display = "block";
            document.getElementById("date-closed").style.display = "block";
          }else{
            document.getElementById("show-result").style.display = "none";
            document.getElementById("date-closed").style.display = "none";
          }
      })
   });

   //abre el modal para cerrar el plan
   $('body').on('click', '#close-plan', function () {
    $('#modal-plan').modal('hide');
    $('#modal-close-plan').modal('show');
   });

   //abre el modal para reprogramar el plan
   $('body').on('click', '#postpone-item', function () {
    $('#modal-plan').modal('hide');
    $('#modal-postpone-plan').modal('show');
   });

   //cierra el modal para cerrar el plan y regresa al modal del plan
   $('body').on('click', '#back-to-plan', function () {
    $('#modal-plan').modal('show');
    $('#modal-close-plan').modal('hide');
   });

   //cierra el modal para reprogramar el plan y regresa al modal del plan
   $('body').on('click', '#back-to-item', function () {
    $('#modal-plan').modal('show');
    $('#modal-postpone-plan').modal('hide');
   });





   //stats

   const ctx = document.getElementById('bar-chart');
    console.log(json_array)
    
    //0->Abierto, 1->Cerrado, 2->Reprogramado, 3->Eficaz, 4->No eficaz
    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: ['Abierto', 'Cerrado', 'Reprogramado'],
        datasets: [{
            label: 'Estado del plan de acción',
            data: [json_array[0], json_array[3], json_array[2]],
            borderWidth: 1
          },
          {
            label: 'No eficaz',
            data: [0, json_array[4]]
          }
        ]
        },
        options: {
        scales: {
          x: {
            stacked: true,
          },
          y: {
            beginAtZero: true,
            stacked: true
          }
        }
        }
    });

    //evento del costo
    document.getElementById("plan-type").style.display = "none";

    document.getElementById("total-info").addEventListener("mouseover", mouseOver);
    document.getElementById("total-info").addEventListener("mouseout", mouseOut);

    function mouseOver() {
      document.getElementById("plan-type").style.display = "block";
    }

    function mouseOut() {
      document.getElementById("plan-type").style.display = "none";
    }

});