import './bootstrap';

/*MODALES**************************************************************
function mostrarModal(id) {
    document.getElementById(id).style.display = "block";
}

function cerrarModal(id) {
    document.getElementById(id).style.display = "none";
}*/

//ADD EVENT LISTENER***********************************************************************
document.addEventListener("DOMContentLoaded", function () {

    //MODALES*************************************************************************
    // Mostrar modal si existe
    const modalSuccess = document.getElementById('modalSuccess');
    const modalError = document.getElementById('modalError');
    const btnCerrar = document.getElementById('btn-modal');

    if (modalSuccess && btnCerrar) {
        modalSuccess.style.display = 'block';

        btnCerrar.addEventListener('click', function () {
            modalSuccess.style.display = 'none';
        });
    }

    if (modalError && btnCerrar) {
        modalError.style.display = 'block';

        btnCerrar.addEventListener('click', function () {
            modalError.style.display = 'none';
        });
    }
});






//administra *********************************************************************
document.getElementById("userForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let nombre = document.getElementById("nombre").value;
    let apellidoP = document.getElementById("apellidoP").value;
    let apellidoM = document.getElementById("apellidoM").value;
    let departamento = document.getElementById("departamento").value;
    let rol = document.getElementById("rol").value;

    let tableBody = document.getElementById("userTableBody");
    let rowCount = tableBody.rows.length + 1;

    let row = tableBody.insertRow();
    row.insertCell(0).textContent = rowCount;
    row.insertCell(1).textContent = `${nombre} ${apellidoP} ${apellidoM}`;
    row.insertCell(2).textContent = departamento;
    row.insertCell(3).textContent = rol;

    let actionCell = row.insertCell(4);
    let editButton = document.createElement("button");
    editButton.textContent = "✏️";
    editButton.classList.add("bg-yellow-500", "text-white", "px-2", "py-1", "rounded", "mr-2");
    actionCell.appendChild(editButton);

    let deleteButton = document.createElement("button");
    deleteButton.textContent = "🗑️";
    deleteButton.classList.add("bg-red-500", "text-white", "px-2", "py-1", "rounded");
    deleteButton.onclick = function () {
        row.remove();
    };
    actionCell.appendChild(deleteButton);

    document.getElementById("userForm").reset();
});

document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.getElementById("userTableBody").getElementsByTagName("tr");

    for (let row of rows) {
        let userName = row.cells[1].textContent.toLowerCase();
        let departamento = row.cells[2].textContent.toLowerCase();
        let rol = row.cells[3].textContent.toLowerCase();

        if (userName.includes(filter) || departamento.includes(filter) || rol.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    }
});

