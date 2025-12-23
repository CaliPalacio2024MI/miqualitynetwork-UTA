document.addEventListener("DOMContentLoaded", function () {
        // Mapa de secciones principales y sus respectivas sub-secciones es un diccionario de datos que garda por seccion principal sus subsecciones
        const seccionSubsecciones = {
            calidad: [
                "contextoorg",
                "liderazgo",
                "planificacion",
                "apoyo",
                "documentacionmi",
                "controldocumental",
                "mireservaciondeeventos",
                "procesosoperativos",
                "procesosdeapoyo",
                "evaldesempeño",
                "revenuereports",
                "balancescorecard",
                "mejora",
                "controlplanesdeaccion",
            ],
            ambiental: [
                "residuos",
                "controlderesiduos",
                "reportederesiduos",
                "energia",
                "controldeenergia",
                "informaciondeenergia",
                "agua",
                "controldeagua",
                "informaciondeagua",
                "aire",
                "controldeaire",
                "informaciondeaire",
                "comunidad",
                "ruido",
                "suelo",
                "recursosnaturales",
                "reportedecontroldeenergeticos",
            ],
            salud: [
                "gestion",
                "atencionaemergencias",
                "higiene",
                "identificacionycontrolderiesgos",
                "prevencionentrabajospeligrosos",
                "perservaciondelasalud",
                "historialclinico",
                "accidentes_enfermedades",
            ],
            informacion: [
                "drp",
                "controles",
                "riesgotecnologico",
                "mantenimiento",
                "bcp",
                "circulares"
            ],
            alimentaria: [
                "cadenaalimentaria",
                "riesgosalimentarios",
                "manipulaciondealimentos",
                "medicion",
                "inocuidad",
            ],
        };

        // Iterar por cada sección principal
        for (const [seccion, subsecciones] of Object.entries(seccionSubsecciones)) {
            // Encontrar el checkbox de la sección principal
            const seccionCheckbox = document.querySelector(`input[name="acceso[]"][value="${seccion}"]`);

            // Encontrar los checkboxes de las sub-secciones
            const subCheckboxes = subsecciones.map((sub) =>
                document.querySelector(`input[name="acceso[]"][value="${sub}"]`)
            );

            // Deshabilitar sub-secciones inicialmente
            subCheckboxes.forEach((checkbox) => (checkbox.disabled = !seccionCheckbox.checked));

            // Agregar evento para habilitar/deshabilitar sub-secciones al cambiar la sección principal
            seccionCheckbox.addEventListener("change", function () {
                const isChecked = seccionCheckbox.checked;
                subCheckboxes.forEach((checkbox) => (checkbox.disabled = !isChecked));
            });
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const filtroRuta = document.getElementById('filtro-ruta');
        const listaCarpetas = document.getElementById('lista-carpetas');
        const carpetaItems = listaCarpetas.querySelectorAll('.carpeta-item');

        filtroRuta.addEventListener('change', () => {
            const rutaSeleccionada = filtroRuta.value;

            carpetaItems.forEach(item => {
                const rutaCarpeta = item.getAttribute('data-ruta');
                if (rutaSeleccionada === '' || rutaCarpeta.includes(rutaSeleccionada)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
