document.addEventListener('DOMContentLoaded', function() {
    console.log('🌬️ Script de control de aire cargado');
    
    // Elementos del DOM
    const cantidadInput = document.getElementById('cantidad');
    const costoInput = document.getElementById('costo');
    const costoPromedioInput = document.getElementById('costo_promedio');
    const fechaInput = document.getElementById('fecha');

    // Configuración inicial
    if (fechaInput) {
        fechaInput.value = new Date().toISOString().substr(0, 10);
    }

    // Calcular costo por litro
    function calcularCostoPromedio() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const costo = parseFloat(costoInput.value) || 0;
        
        if (cantidad > 0 && costo > 0) {
            costoPromedioInput.value = (costo / cantidad).toFixed(2);
        } else {
            costoPromedioInput.value = '0.00';
        }
    }

    // Event listeners
    if (cantidadInput && costoInput && costoPromedioInput) {
        cantidadInput.addEventListener('input', calcularCostoPromedio);
        costoInput.addEventListener('input', calcularCostoPromedio);
        calcularCostoPromedio(); // Cálculo inicial
    }
});