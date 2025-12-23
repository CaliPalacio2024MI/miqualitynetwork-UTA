// Espera a que todo el contenido del DOM esté completamente cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function () {

    // Agrega un listener al elemento con ID "seccion" que se activa cuando cambia su valor (evento "change")
    document.getElementById('seccion').addEventListener('change', function () {

        // Objeto que contiene las subsecciones disponibles según la sección seleccionada
        let subsecciones = {
            calidad: ['Contexto de la Organización', 'Liderazgo', 'Planificación', 'Apoyo', 'Documentación de la Operación', 'Evaluación del desempeño', 'Mejora'],
            seguridad_ambiental: ['Normativas Ambientales', 'Gestión de Residuos', 'Impacto Ambiental'],
            seguridad_salud: ['Protocolos de Emergencia', 'Salud Ocupacional'],
            seguridad_informacion: ['Ciberseguridad', 'Protección de Datos'],
            seguridad_alimentaria: ['Control de Calidad', 'Manejo de Alimentos']
        };

        // Obtiene el valor seleccionado actualmente en el select "seccion"
        let seccion = this.value;

        // Obtiene el elemento del select de subsección
        let subseccionSelect = document.getElementById('subseccion');

        // Reinicia el contenido del select de subsecciones con la opción por defecto
        subseccionSelect.innerHTML = '<option value="">Seleccione una subsección</option>';

        //  Error aquí: se intenta usar 'secciones', pero debería ser 'subsecciones'
        if (secciones.hasOwnProperty(seccion)) { // <-- ERROR: 'secciones' no está definido
            // Recorre el array de subsecciones correspondiente a la sección seleccionada
            subsecciones[seccion].forEach(sub => {
                // Crea un nuevo elemento <option>
                let option = document.createElement('option');

                // Asigna el valor del option transformando el texto a minúsculas y reemplazando espacios por guiones bajos
                option.value = sub.toLowerCase().replace(/ /g, '_');

                // Establece el texto visible del option
                option.textContent = sub;

                // Agrega el option al select de subsección
                subseccionSelect.appendChild(option);
            });
        }
    });
});
