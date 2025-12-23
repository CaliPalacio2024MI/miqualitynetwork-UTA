// Buscar centros de consumo por nombre o propiedad
function buscarUsuario() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#userTable tr");

    rows.forEach(row => {
        const celdas = row.querySelectorAll("td");
        const encontrado = Array.from(celdas).some(celda =>
            celda.textContent.toLowerCase().includes(input)
        );
        row.style.display = encontrado ? "" : "none";
    });
}

// Lógica para editar y eliminar filas
document.addEventListener("DOMContentLoaded", function () {
    const userTable = document.getElementById("userTable");

    // 🛠️ Cargar propiedades dinámicamente en el select
const selectPropiedad = document.getElementById("propiedad");

if (selectPropiedad) {
    const opcionBase = selectPropiedad.querySelector('option[value=""]');
    const propiedadesGuardadas = JSON.parse(localStorage.getItem("propiedades")) || [];

    // Limpiar opciones actuales (deja solo "Seleccionar propiedad")
    selectPropiedad.innerHTML = '';
    if (opcionBase) {
        selectPropiedad.appendChild(opcionBase);
    } else {
        const nuevaBase = document.createElement('option');
        nuevaBase.value = '';
        nuevaBase.textContent = 'Seleccionar propiedad';
        selectPropiedad.appendChild(nuevaBase);
    }

    // Agregar las propiedades dinámicamente
    propiedadesGuardadas.forEach(nombre => {
        const option = document.createElement("option");
        option.value = nombre;
        option.textContent = nombre;
        selectPropiedad.appendChild(option);
    });
}


    function agregarEventosFila(fila) {
        const editarBtn = fila.querySelector(".editarusuario");
        const eliminarBtn = fila.querySelector(".eliminarusuario");

        if (editarBtn) {
            editarBtn.addEventListener("click", () => editarFila(fila));
        }

        if (eliminarBtn) {
            eliminarBtn.addEventListener("click", () => fila.remove());
        }
    }

    function editarFila(fila) {
        const celdas = fila.querySelectorAll("td:not(.actions)");

        celdas.forEach(celda => {
            const valor = celda.textContent;
            celda.innerHTML = `<input type="text" value="${valor}">`;
        });

        const acciones = fila.querySelector(".actions");
        acciones.innerHTML = `
            <button class="guardarusuario">✅</button>
            <button class="cancelarusuario">❌</button>
        `;

        acciones.querySelector(".guardarusuario").addEventListener("click", () => guardarEdicion(fila));
        acciones.querySelector(".cancelarusuario").addEventListener("click", () => cancelarEdicion(fila));
    }

    function guardarEdicion(fila) {
        const celdas = fila.querySelectorAll("td:not(.actions)");

        celdas.forEach(celda => {
            const input = celda.querySelector("input");
            if (input) {
                celda.textContent = input.value;
            }
        });

        restaurarAcciones(fila);
    }

    function cancelarEdicion(fila) {
        const celdas = fila.querySelectorAll("td:not(.actions)");

        celdas.forEach(celda => {
            const input = celda.querySelector("input");
            if (input) {
                celda.textContent = input.defaultValue;
            }
        });

        restaurarAcciones(fila);
    }

    function restaurarAcciones(fila) {
        const acciones = fila.querySelector(".actions");
        acciones.innerHTML = `
            <button class="editarusuario"><img src="/images/editar.svg"></button>
            <button class="eliminarusuario"><img src="/images/eliminar.svg"></button>
        `;

        agregarEventosFila(fila);
    }

    // Inicializar eventos para las filas existentes
    document.querySelectorAll("#userTable tr").forEach(fila => {
        agregarEventosFila(fila);
    });
});
