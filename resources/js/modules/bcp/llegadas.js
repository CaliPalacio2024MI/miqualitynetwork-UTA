document.addEventListener("DOMContentLoaded", function () {
    loadStoredData(); // Carga datos almacenados en LocalStorage al cargar la página
});

function importCSV() {
    const fileInput = document.getElementById("fileInput");
    const file = fileInput.files[0];

    if (!file) {
        alert("Por favor, selecciona un archivo CSV.");
        return;
    }

    const reader = new FileReader();
    reader.onload = function (event) {
        const csvData = event.target.result;
        parseCSV(csvData);
    };

    reader.readAsText(file);
}

function parseCSV(csvData) {
    const tableBody = document.getElementById("tableBody");
    const lines = csvData.split(/\r?\n/).filter(line => line.trim() !== "");

    for (let i = 1; i < lines.length; i++) {
        const row = document.createElement("tr");
        const values = parseCSVLine(lines[i]);

        for (let j = 0; j < 41; j++) {
            const cell = document.createElement("td");
            cell.textContent = values[j] || "";
            row.appendChild(cell);
        }

        const actionCell = document.createElement("td");
        actionCell.innerHTML = `
            <button onclick="editRow(this)">📝</button>
            <button onclick="deleteRow(this)">❌</button>
        `;
        row.appendChild(actionCell);

        tableBody.appendChild(row);
    }

    alert("Datos importados correctamente");
    saveDataToStorage();
}

function parseCSVLine(line) {
    const result = [];
    let current = '';
    let insideQuotes = false;

    for (let i = 0; i < line.length; i++) {
        const char = line[i];

        if (char === '"' && line[i + 1] === '"') {
            current += '"';
            i++;
        } else if (char === '"') {
            insideQuotes = !insideQuotes;
        } else if (char === ',' && !insideQuotes) {
            result.push(current.trim());
            current = '';
        } else {
            current += char;
        }
    }

    result.push(current.trim());
    return result;
}

function deleteRow(button) {
    const row = button.parentNode.parentNode;
    row.remove();
    saveDataToStorage();
}

function editRow(button) {
    const row = button.parentNode.parentNode;
    const cells = row.querySelectorAll("td:not(:last-child)");

    cells.forEach(cell => {
        const input = document.createElement("input");
        input.type = "text";
        input.value = cell.textContent;
        cell.textContent = "";
        cell.appendChild(input);
    });

    button.textContent = "✅";
    button.setAttribute("onclick", "saveRow(this)");
}

function saveRow(button) {
    const row = button.parentNode.parentNode;
    const inputs = row.querySelectorAll("input");

    inputs.forEach(input => {
        const cell = input.parentNode;
        cell.textContent = input.value;
    });

    button.textContent = "📝";
    button.setAttribute("onclick", "editRow(this)");

    saveDataToStorage();
}

function saveDataToStorage() {
    const tableBody = document.getElementById("tableBody");
    const rows = [];

    tableBody.querySelectorAll("tr").forEach(row => {
        const rowData = Array.from(row.children).map(cell => cell.textContent.trim());
        rows.push(rowData);
    });

    localStorage.setItem("tableData", JSON.stringify(rows));
}

function loadStoredData() {
    const tableBody = document.getElementById("tableBody");
    const storedData = localStorage.getItem("tableData");

    if (storedData) {
        const rows = JSON.parse(storedData);
        rows.forEach(rowData => {
            const row = document.createElement("tr");

            for (let j = 0; j < 41; j++) {
                const cell = document.createElement("td");
                cell.textContent = rowData[j] || "";
                row.appendChild(cell);
            }

            const actionCell = document.createElement("td");
            actionCell.innerHTML = `
                <button onclick="editRow(this)">📝</button>
                <button onclick="deleteRow(this)">❌</button>
            `;
            row.appendChild(actionCell);

            tableBody.appendChild(row);
        });
    }
}

// 👇 Hacemos funciones globales para que funcionen con onclick
window.importCSV = importCSV;
window.editRow = editRow;
window.deleteRow = deleteRow;
window.saveRow = saveRow;
