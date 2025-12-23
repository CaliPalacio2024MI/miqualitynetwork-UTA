document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscador-carpetas");
    const checkboxes = document.querySelectorAll(".carpeta-checkbox");
    const btnSeleccionarTodas = document.getElementById("btn-toggle-todas");

    buscador.addEventListener("input", function () {
        const filtro = this.value.toLowerCase();
        const carpetas = document.querySelectorAll(".carpeta-item");
        carpetas.forEach(carpeta => {
            const texto = carpeta.textContent.toLowerCase();
            carpeta.style.display = texto.includes(filtro) ? "" : "none";
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            if (this.checked) {
                this.parentElement.classList.remove("opacity-50");
            } else {
                this.parentElement.classList.add("opacity-50");
            }
        });

        if (!checkbox.checked) {
            checkbox.parentElement.classList.add("opacity-50");
        }
    });

    const btnToggleCarpetas = document.getElementById("btn-toggle-carpetas");

    btnToggleCarpetas.addEventListener("click", function () {
        const seccionCarpetas = document.getElementById("seccion-carpetas");
        seccionCarpetas.classList.toggle("hidden");
    });

    // ▼▼▼ Selects de Propiedad -> Departamento -> Puesto ▼▼▼
    const propiedadA = document.getElementById('propiedad_id');
    const departamentoA = document.getElementById('selectDepartamentoP');
    const puestoA = document.getElementById('selectPuestoP');

    if (propiedadA && departamentoA && puestoA) {

        // ▶ Al cambiar propiedad, cargar departamentos
        propiedadA.addEventListener('change', async () => {
            const propiedadId = propiedadA.value;
            departamentoA.innerHTML = '<option value="">Cargando departamentos...</option>';
            departamentoA.disabled = true;

            try {
                const res = await fetch(`/anfitriones/departamentos/${propiedadId}`);
                const data = await res.json();

                departamentoA.innerHTML = '<option value="">Seleccione un departamento</option>';
                data.forEach(dep => {
                    const opt = document.createElement('option');
                    opt.value = dep.id;
                    opt.textContent = dep.departamento;
                    departamentoA.appendChild(opt);
                });
                departamentoA.disabled = false;
            } catch (e) {
                console.error('❌ Error cargando departamentos:', e);
                departamentoA.innerHTML = '<option value="">Error al cargar</option>';
                departamentoA.disabled = false;
            }

            // Resetear puestos
            puestoA.innerHTML = '<option value="">Seleccione un puesto</option>';
            puestoA.disabled = true;
        });

        // ▶ Al cambiar departamento, cargar puestos
        departamentoA.addEventListener('change', async () => {
            const departamentoId = departamentoA.value;
            puestoA.innerHTML = '<option value="">Cargando puestos...</option>';
            puestoA.disabled = true;

            try {
                const res = await fetch(`/anfitriones/puestos/${departamentoId}`);
                const data = await res.json();

                puestoA.innerHTML = '<option value="">Seleccione un puesto</option>';
                data.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.puesto;
                    puestoA.appendChild(opt);
                });
                puestoA.disabled = false;
            } catch (e) {
                console.error('❌ Error cargando puestos:', e);
                puestoA.innerHTML = '<option value="">Error al cargar</option>';
                puestoA.disabled = false;
            }
        });
    } else {
        console.warn('⚠️ No se encontraron los selectores propiedad_id, selectDepartamentoP o selectPuestoP');
    }
});
