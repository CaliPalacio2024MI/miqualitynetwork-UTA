document.addEventListener("DOMContentLoaded", function() {
    // Obtener el contenedor con los datos
    const container = document.getElementById('grafica-container');
    if (!container) return;

    try {
        // Obtener datos desde los atributos data
        const labels = JSON.parse(container.dataset.labels);
        const values = JSON.parse(container.dataset.values);
        const colores = JSON.parse(container.dataset.colores);
        const consumos = JSON.parse(container.dataset.consumos);

        // Preparar colores
        const backgroundColors = [];
        const borderColors = [];
        
        Object.keys(consumos).forEach(energeticoId => {
            backgroundColors.push(colores[energeticoId] || '#cccccc');
            borderColors.push('#ffffff');
        });

        // Crear el gráfico
        const ctx = document.getElementById("graficaConsumo").getContext("2d");
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Consumo por tipo de recurso",
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { 
                    y: { 
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });

    } catch (error) {
        console.error('Error al crear el gráfico:', error);
        container.innerHTML = `<div class="alert alert-danger">Error al cargar el gráfico: ${error.message}</div>`;
    }
});