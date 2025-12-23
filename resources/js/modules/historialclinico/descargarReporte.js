function descargarReporte() {
    const propiedad = document.getElementById('propiedad').value;
    const puesto = document.getElementById('puesto').value;
    const departamento = document.getElementById('departamento').value;
//    const enfermedad = document.getElementById('enfermedad').value;

    const params = new URLSearchParams();
    if (propiedad) params.append('hotel', propiedad);
    if (puesto) params.append('puesto', puesto);
    if (departamento) params.append('departamento', departamento);
//    if (enfermedad) params.append('enfermedad', enfermedad);

    const url = `/reporte/pdf?${params.toString()}`;

    // Abrir la URL en una nueva pestaña para iniciar la descarga
    window.open(url, '_blank');
}
    window.descargarReporte = descargarReporte;


function descargarGrafica() {
    // Obtener los valores de los selects de filtro
    const propiedad = document.getElementById('propiedad')?.value || '';
    const departamento = document.getElementById('departamento')?.value || '';
    const puesto = document.getElementById('puesto')?.value || '';
    // Obtener el valor del campo de "Condición" (datalist input)
    const enfermedad = document.getElementById('opcion-input')?.value || '';

    // Crear un objeto URLSearchParams para construir los parámetros de la URL
    const params = new URLSearchParams();

    // Añadir los parámetros si tienen un valor (no vacío)
    if (propiedad) params.append('hotel', propiedad); // Coincide con el nombre del parámetro en el controlador
    if (departamento) params.append('departamento', departamento); // Coincide con el nombre del parámetro en el controlador
    if (puesto) params.append('puesto', puesto); // Coincide con el nombre del parámetro en el controlador
    if (enfermedad) params.append('enfermedad', enfermedad); // ¡Nuevo parámetro para el filtro de enfermedad!

    // Construir la URL completa para la ruta del reporte en PDF
    const url = `/reporte/pdf?${params.toString()}`;

    // Abrir la URL en una nueva pestaña para iniciar la descarga del PDF
    window.open(url, '_blank');
}

// Asegúrate de que esta función esté accesible globalmente si la llamas desde el HTML
window.descargarGrafica = descargarGrafica;