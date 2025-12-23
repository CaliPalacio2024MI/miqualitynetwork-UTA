document.addEventListener("DOMContentLoaded", () => {
    // Configuración de los pares checkbox-fieldset
    const configuraciones = [
        {
            checkboxClass: '.ck-calidad',
            fieldsetId: '#Calidad',
            descripcion: 'Sección de controles de calidad'
        },
        {
            checkboxClass: '.ck-ambiental',
            fieldsetId: '#Ambiental',
            descripcion: 'Sección de controles ambientales'
        },
        {
            checkboxClass: '.ck-salud',
            fieldsetId: '#Salud',
            descripcion: 'Sección de controles de salud y seguridad'
        },
        {
            checkboxClass: '.ck-informacion',
            fieldsetId: '#Informacion',
            descripcion: 'Sección de gestión de información'
        },
        {
            checkboxClass: '.ck-alimentaria',
            fieldsetId: '#Alimentaria',
            descripcion: 'Sección de controles alimentarios'
        }
    ];

    // Manejo de secciones principales
    configuraciones.forEach(item => {
        const checkbox = document.querySelector(item.checkboxClass);
        const fieldset = document.querySelector(item.fieldsetId);

        if (checkbox && fieldset) {
            checkbox.addEventListener('change', function () {
                fieldset.style.display = this.checked ? "block" : "none";
            });

            fieldset.style.display = checkbox.checked ? "block" : "none";
        }
    });

    // Manejo de sub-secciones y módulos
    const subSecciones = document.querySelectorAll(".ck-subseccion");

    subSecciones.forEach(subSeccion => {
        const modulosId = subSeccion.getAttribute("data-modulos");
        const textoDinamico = subSeccion.getAttribute("data-texto");
        const modulosDiv = modulosId ? document.getElementById(modulosId) : null;

        let textoDiv = null;

        // Solo crear texto si hay texto dinámico y div de módulos
        if (textoDinamico && modulosDiv) {
            textoDiv = document.createElement("div");
            textoDiv.className = "texto-modulos";
            textoDiv.style.display = "none";
            textoDiv.style.margin = "10px 0";
            textoDiv.style.fontWeight = "bold";
            textoDiv.style.color = "#092034";
            textoDiv.textContent = textoDinamico;

            modulosDiv.prepend(textoDiv);
        }

        // Evento de cambio
        subSeccion.addEventListener("change", function () {
            if (modulosDiv) {
                modulosDiv.style.display = this.checked ? "block" : "none";
            }
            if (textoDiv) {
                textoDiv.style.display = this.checked ? "block" : "none";
            }
        });

        // Inicialización al cargar
        if (modulosDiv) {
            modulosDiv.style.display = subSeccion.checked ? "block" : "none";
        }
        if (textoDiv) {
            textoDiv.style.display = subSeccion.checked ? "block" : "none";
        }

        // Asegurar clickeabilidad
        subSeccion.disabled = false;
        subSeccion.style.pointerEvents = "auto";
    });
});
