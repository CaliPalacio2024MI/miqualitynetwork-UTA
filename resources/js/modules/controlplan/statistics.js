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
