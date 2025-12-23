/**
 * Script para gestionar la interactividad en la página de Gestión de Archivos.
 * Contiene funciones para manejar formularios dinámicos, carga de subsecciones y
 * actualización de carpetas y subcarpetas en la interfaz.
 */

document.addEventListener("DOMContentLoaded", function () {
    // Definición de subsecciones para cada sección principal
    const subsecciones = {
        calidad: [
            "Contexto de la Organización",
            "Liderazgo",
            "Planificación",
            "Cafe Kali",
            "Control documental",
            "Mi reservacion de eventos",
            "Procesos operativos",
            "Procesos de apoyo",
            "Revenue Reports",
            "Balance Scorecard",
            "Control planes de acción",
        ],
        seguridad_ambiental: [
            "Control de residuos",
            "Reporte de residuos",
            "Control de energia",
            "Informacion de energia",
            "Control de agua",
            "Informacion de agua",
            "Control de aire",
            "Informacion de aire",
            "Comunidad",
            "Ruido",
            "Suelo",
            "Recursos Naturales",
            "Reporte control de energeticos",
        ],
        seguridad_salud: [
            "Gestion",
            "Atencion a emergencias",
            "Higiene",
            "Identificacion y control de riesgos",
            "Prevencion en trabajos peligrosos",
            "Historial clinico",
        ],
        seguridad_informacion: [
            "drp",
            "Controles",
            "Riesgo Tecnologico",
            "Mantenimiento",
            "bcp",
            "Circulares"
        ],
        seguridad_alimentaria: [
            "Cadena alimentaria",
            "Riesgos alimentarios",
            "Manipulacion de alimentos",
            "Inocuidad",
        ],
    };

    /**
     * Función para actualizar dinámicamente las subsecciones basadas en la sección seleccionada.
     * @param {string} seccionSelectId - ID del elemento select de la sección
     * @param {string} subseccionSelectId - ID del elemento select de la subsección
     */
    function actualizarSubsecciones(seccionSelectId, subseccionSelectId) {
        document
            .getElementById(seccionSelectId)
            .addEventListener("change", function () {
                let seccion = this.value;
                let subseccionSelect =
                    document.getElementById(subseccionSelectId);
                subseccionSelect.innerHTML =
                    '<option value="">Seleccione una subsección</option>';

                if (seccion in subsecciones) {
                    subsecciones[seccion].forEach((sub) => {
                        let option = document.createElement("option");
                        option.value = sub.toLowerCase().replace(/ /g, "_");
                        option.textContent = sub;
                        subseccionSelect.appendChild(option);
                    });
                }
            });
    }

    // Aplicar actualización de subsecciones a los formularios relevantes
    actualizarSubsecciones("seccionCarpeta", "subseccionCarpeta"); // Para Crear Carpeta
    actualizarSubsecciones("seccionArchivo", "subseccionArchivo"); // Para Subir Archivos

    /**
     * Función para actualizar la lista de carpetas disponibles según la subsección seleccionada.
     */
    document
        .getElementById("subseccionArchivo")
        .addEventListener("change", function () {
            let subseccionSeleccionada = this.value;
            let carpetaSelect = document.getElementById("carpeta_id");
            carpetaSelect.innerHTML =
                '<option value="">Seleccione una carpeta</option>';

            fetch(
                `/carpetas/getBySubseccion?subseccion=${subseccionSeleccionada}`
            )
                .then((response) => response.json())
                .then((data) => {
                    data.forEach((carpeta) => {
                        let option = document.createElement("option");
                        option.value = carpeta.id;
                        option.textContent = carpeta.nombre_carpeta;
                        carpetaSelect.appendChild(option);
                    });
                })
                .catch((error) =>
                    console.error("Error al obtener carpetas:", error)
                );
        });

    /**
     * Función para cargar dinámicamente las subcarpetas de una carpeta seleccionada.
     */
    document
        .getElementById("carpeta_id")
        .addEventListener("change", function () {
            let carpetaId = this.value;
            let subcarpetaSelect = document.getElementById("subcarpeta_id");
            subcarpetaSelect.innerHTML =
                '<option value="">Seleccione una subcarpeta</option>';

            if (carpetaId) {
                fetch(`/carpetas/${carpetaId}/subcarpetas`)
                    .then((response) => response.json())
                    .then((data) => {
                        data.forEach((subcarpeta) => {
                            let option = document.createElement("option");
                            option.value = subcarpeta.id;
                            option.textContent = subcarpeta.nombre_carpeta;
                            subcarpetaSelect.appendChild(option);
                        });
                    })
                    .catch((error) =>
                        console.error("Error al obtener subcarpetas:", error)
                    );
            }
        });

    /**
     * Función para alternar la visibilidad de los formularios y cambiar el estado activo de los botones.
     * @param {string} formId - ID del formulario a mostrar/ocultar
     * @param {HTMLElement} button - Botón que activa el formulario
     */
    window.toggleForm = function (formId, button) {
        // Ocultar todos los formularios
        const forms = document.querySelectorAll(".form-container");
        forms.forEach((form) => form.classList.add("hidden"));

        // Mostrar el formulario seleccionado
        document.getElementById(formId).classList.toggle("hidden");

        // Remover la clase "active" de todos los botones
        const buttons = document.querySelectorAll(".btn-seccion");
        buttons.forEach((btn) => btn.classList.remove("active"));

        // Agregar la clase "active" al botón seleccionado
        button.classList.add("active");
    };

    /**
     * Función para mostrar u ocultar los campos según si la carpeta es un proceso.
     * También alterna el estado activo de los botones "Sí" y "No".
     * @param {boolean} isProceso - Indica si la carpeta es un proceso o no
     * @param {HTMLElement} button - Botón que activa la selección
     */
    window.setProceso = function (isProceso, button) {
        // Remover la clase "active" de todos los botones
        const buttons = document.querySelectorAll(".btn-proceso");
        buttons.forEach((btn) => btn.classList.remove("active"));

        // Agregar la clase "active" al botón seleccionado
        button.classList.add("active");

        // Mostrar u ocultar el campo de proceso según la selección
        const campoProceso = document.getElementById("campoProceso");
        const campoNombreCarpeta =
            document.getElementById("campoNombreCarpeta");

        if (isProceso) {
            campoProceso.classList.remove("hidden");
            campoNombreCarpeta.classList.add("hidden");
        } else {
            // Opción "No": 
            // Se mantiene visible el selector de procesos y se muestra el campo para ingresar el nombre manualmente.
            campoNombreCarpeta.classList.remove("hidden");
        }
    };
    /**
     * Al seleccionar una carpeta en el formulario de subir archivos,
     * rellena automáticamente los campos de Sección, Subsección y Procesos.
     */
    document.getElementById("carpeta_id").addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];

        // Rellenar Sección
        const seccionValue = selectedOption.getAttribute("data-seccion");
        if (seccionValue) {
            const seccionSelect = document.getElementById("seccionArchivo");
            seccionSelect.value = seccionValue;

            // Disparar el evento change para que se actualicen las subsecciones
            const event = new Event("change");
            seccionSelect.dispatchEvent(event);
        }

        // Rellenar Subsección (después de que se actualicen las opciones)
        const subseccionValue = selectedOption.getAttribute("data-subseccion");
        if (subseccionValue) {
            // Espera un poco para asegurar que las opciones ya se actualizaron
            setTimeout(() => {
                const subseccionSelect = document.getElementById("subseccionArchivo");
                // Busca la opción que coincida con el valor
                for (let i = 0; i < subseccionSelect.options.length; i++) {
                    if (subseccionSelect.options[i].value === subseccionValue) {
                        subseccionSelect.selectedIndex = i;
                        break;
                    }
                }
            }, 50);
        }

        // Rellenar Procesos usando proceso_id y nombre_proceso real
        const procesoId = selectedOption.getAttribute("data-proceso");
        if (procesoId && window.procesosList && window.procesosList[procesoId]) {
            const processName = window.procesosList[procesoId];
            const tipoProcesoSelect = document.getElementById("tipo_proceso");
            for (let i = 0; i < tipoProcesoSelect.options.length; i++) {
                if (tipoProcesoSelect.options[i].text === processName) {
                    tipoProcesoSelect.selectedIndex = i;
                    break;
                }
            }
        }
        // ...existing code...
    });

    // ...existing code...

    /**
     * Script para filtrar carpetas por nombre en tiempo real.
     */
    const busquedaInput = document.getElementById("busquedaCarpeta");
    if (busquedaInput) {
        busquedaInput.addEventListener("input", function () {
            const filtro = this.value.toLowerCase();
            document
                .querySelectorAll(".folder-container")
                .forEach(function (div) {
                    const nombre = div.getAttribute("data-nombre");
                    div.style.display =
                        nombre && nombre.includes(filtro) ? "" : "none";
                });
        });
    }
    /**
     * Autocompleta el nombre de la carpeta cuando se selecciona un proceso.
     */
    document
        .getElementById("proceso_id")
        .addEventListener("change", function () {
            const procesoSeleccionado =
                this.options[this.selectedIndex].text.split(" (")[0];
            document.getElementById("nombre_carpeta").value =
                procesoSeleccionado;
        });


});


