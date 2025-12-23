document.addEventListener('DOMContentLoaded', function () {
    console.log('✅ Script de energía cargado');
    
    const cantidad = document.getElementById('cantidad');
    const costo = document.getElementById('costo');
    const costoPromedio = document.getElementById('costo_promedio');
    const fecha = document.getElementById('fecha');

    // Configurar fecha actual
    if (fecha) {
        fecha.value = new Date().toISOString().substr(0, 10);
    }

    function actualizarCostoPromedio() {
        const kWh = parseFloat(cantidad.value) || 0;
        const total = parseFloat(costo.value) || 0;

        costoPromedio.value = (kWh > 0 && total > 0) ? 
            (total / kWh).toFixed(2) : "0.00";
    }

    // Event listeners
    cantidad.addEventListener('input', actualizarCostoPromedio);
    costo.addEventListener('input', actualizarCostoPromedio);
    
    // Calcular inicialmente
    actualizarCostoPromedio();
});