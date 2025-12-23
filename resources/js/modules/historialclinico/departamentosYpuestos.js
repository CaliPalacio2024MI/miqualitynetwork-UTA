window.inicializarFormularioDinamico = function () {
    const propiedadSelect = document.getElementById('propiedad-select');
    const departamentoSelect = document.getElementById('departamento-select');
    const puestoSelect = document.getElementById('puesto-select');

    if (!propiedadSelect || !departamentoSelect || !puestoSelect) {
        console.warn("No se encontraron los selectores necesarios.");
        return;
    }

    propiedadSelect.addEventListener('change', function () {
        const propiedadNombre = this.value;

        departamentoSelect.innerHTML = '<option value="" disabled selected>Cargando departamentos...</option>';
        puestoSelect.innerHTML = '<option value="" disabled selected>Seleccione un puesto</option>';

        fetch(`/api/departamentos/${encodeURIComponent(propiedadNombre)}`)
            .then(res => res.json())
            .then(data => {
                departamentoSelect.innerHTML = '<option value="" disabled selected>Seleccione un departamento</option>';
                data.forEach(dep => {
                    const option = document.createElement('option');
                    option.value = dep.id;
                    option.textContent = dep.departamento;
                    departamentoSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar departamentos:', error);
                departamentoSelect.innerHTML = '<option value="" disabled selected>Error al cargar departamentos</option>';
            });
    });

    departamentoSelect.addEventListener('change', function () {
        const departamentoId = this.value;

        puestoSelect.innerHTML = '<option value="" disabled selected>Cargando puestos...</option>';

        fetch(`/api/puestos/${encodeURIComponent(departamentoId)}`)
            .then(res => res.json())
            .then(data => {
                puestoSelect.innerHTML = '<option value="" disabled selected>Seleccione un puesto</option>';
                data.forEach(puesto => {
                    const option = document.createElement('option');
                    option.value = puesto.id;
                    option.textContent = puesto.puesto;
                    puestoSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar puestos:', error);
                puestoSelect.innerHTML = '<option value="" disabled selected>Error al cargar puestos</option>';
            });
    });
};