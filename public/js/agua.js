document.addEventListener('DOMContentLoaded', function() {
    console.log('💧 Script de control de agua cargado');
    
    // Elementos del formulario
    const cantidadInput = document.getElementById('cantidad');
    const costoInput = document.getElementById('costo');
    const costoPromedioInput = document.getElementById('costo_promedio');
    const energeticoSelect = document.getElementById('energetico_id');

    // Función para actualizar unidad de medida
    function actualizarUnidad() {
        if (energeticoSelect) {
            const selectedOption = energeticoSelect.options[energeticoSelect.selectedIndex];
            const unidad = selectedOption?.getAttribute('data-unidad') || 'm³';
            console.log('Unidad seleccionada:', unidad);
            // Aquí puedes actualizar la visualización de la unidad si es necesario
        }
    }

    // Función para calcular costo promedio
    function calcularCostoPromedio() {
        const cantidad = parseFloat(cantidadInput?.value) || 0;
        const costo = parseFloat(costoInput?.value) || 0;
        
        if (cantidad > 0 && costo > 0) {
            costoPromedioInput.value = (costo / cantidad).toFixed(2);
        } else {
            costoPromedioInput.value = '0.00';
        }
    }

    // Event Listeners
    if (energeticoSelect) {
        energeticoSelect.addEventListener('change', actualizarUnidad);
    }
    
    if (cantidadInput && costoInput && costoPromedioInput) {
        cantidadInput.addEventListener('input', calcularCostoPromedio);
        costoInput.addEventListener('input', calcularCostoPromedio);
    }

    // Inicializaciones
    actualizarUnidad();
    calcularCostoPromedio();
});