// resources/js/estadistico.js
document.addEventListener('DOMContentLoaded', () => {
  const data = Array.isArray(window._residuosData)
    ? window._residuosData.slice()
    : [];

  const labels = data.map(item =>
    item.mes && item.anio
      ? `${item.residuo} (${item.mes}/${item.anio})`
      : item.residuo
  );

  const porcentaje = data.map(item =>
    item.cantidad_kg > 0
      ? +((item.compra_kg * 100) / item.cantidad_kg).toFixed(2)
      : 0
  );
  const porPax = data.map(item =>
    item.pax && item.pax !== 0
      ? +(item.cantidad_kg / item.pax).toFixed(2)
      : 0
  );

  const colors = labels.map(cat => {
    const name = cat.split(' (')[0];
    return window._colorMapping[name] || '#3498db';
  });

  const ctx = document.getElementById('residuosChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels,
      datasets: [
        { label: '% Reciclado',  data: porcentaje,   backgroundColor: colors },
        { label: 'Residuo/PAX',  data: porPax,       backgroundColor: 'rgb(188,138,85)' }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: { title: { display:true, text:'Residuos reciclados' } },
        y: { beginAtZero:true, title:{ display:true, text:'% de reciclados' } }
      },
      plugins: {
        legend: {
          labels: {
            filter: item => item.text === 'Residuo/PAX'
          }
        }
      }
    }
  });
});
