if (window._reporteInitialized) {
    console.warn("reporte.js: ya inicializado, cancelando segunda carga");
} else {
    window._reporteInitialized = true;

    document.addEventListener("DOMContentLoaded", () => {
        function enterEditMode(row) {
            row.querySelectorAll("td.field").forEach((td) => {
                const classes = Array.from(td.classList);
                const key = classes[classes.indexOf("field") + 1];
                const value = td.textContent.trim();
                td.innerHTML = `
                    <input type="${key === "fecha" ? "date" : "text"}" name="${key}" value="${value}" class="w-full border-gray-300 rounded-md" />
                `;
            });
            toggleActionButtons(row, true);
        }

        function exitEditMode(row, original) {
            row.querySelectorAll("td.field").forEach((td) => {
                const classes = Array.from(td.classList);
                const key = classes[classes.indexOf("field") + 1];
                td.textContent = original[key];
            });
            toggleActionButtons(row, false);
        }

        function toggleActionButtons(row, editing) {
            row.querySelector(".btn-edit")?.classList.toggle("hidden", editing);
            row.querySelector(".btn-save")?.classList.toggle("hidden", !editing);
            row.querySelector(".btn-cancel")?.classList.toggle("hidden", !editing);
            row.querySelector(".delete-form")?.classList.toggle("hidden", editing);
            row.querySelector(".btn-exportar-individual")?.classList.toggle("hidden", editing);
        }

        async function saveRow(row) {
            const id = row.dataset.id;
            const data = {};
            row.querySelectorAll("td.field input").forEach(
                (i) => (data[i.name] = i.value)
            );

            const token = document.querySelector('meta[name="csrf-token"]').content;
            const formData = new FormData();
            formData.append("_method", "PUT");
            Object.entries(data).forEach(([k, v]) => formData.append(k, v));

            try {
                const res = await fetch(`/seguridadysalud/reporte/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": token,
                        "X-Requested-With": "XMLHttpRequest",
                        Accept: "application/json",
                    },
                    body: formData,
                });
                const payload = await res.json();

                if (!res.ok) {
                    const errs = payload.errors
                        ? Object.values(payload.errors).flat().join("\n")
                        : payload.message;
                    throw new Error(errs);
                }

                row.querySelectorAll("td.field").forEach((td) => {
                    const classes = Array.from(td.classList);
                    const key = classes[classes.indexOf("field") + 1];
                    td.textContent = payload[key];
                });
                toggleActionButtons(row, false);
            } catch (err) {
                alert(err.message);
            }
        }

        function filterTable(term) {
            const table = document.getElementById("tablaReporte");
            if (!table) return;
            table.querySelectorAll("tbody tr").forEach((row) => {
                const hay = Array.from(row.querySelectorAll("td.field"))
                    .filter((td) => !td.classList.contains("fecha"))
                    .map((td) => td.textContent.toLowerCase())
                    .some((text) => text.includes(term));
                row.style.display = hay ? "" : "none";
            });
        }

        function dedupeReporte() {
            const headings = Array.from(document.querySelectorAll("h2")).filter(
                (h2) => h2.textContent.trim() === "Reporte de Historial Clínico"
            );
            if (headings.length > 1) {
                headings.slice(1).forEach((h2) => {
                    const section = h2.closest("div.p-6.bg-white.shadow.rounded");
                    if (section) section.remove();
                });
                console.info(`Reporte: eliminadas ${headings.length - 1} secciones duplicadas`);
            }
        }

        // INICIALIZACIÓN
        const table = document.getElementById("tablaReporte");
        const form = document.getElementById("formFiltro");
        const sHotel = document.getElementById("filtroHotel");
        const inputNm = document.getElementById("filtroNombre");
        const fInicio = document.getElementById("fecha_inicio");
        const fFin = document.getElementById("fecha_fin");

        // Edición inline
        if (table) {
            table.addEventListener("click", (e) => {
                const row = e.target.closest("tr");
                if (!row) return;

                if (e.target.matches(".btn-edit")) {
                    const original = {};
                    row.querySelectorAll("td.field").forEach((td) => {
                        const classes = Array.from(td.classList);
                        const key = classes[classes.indexOf("field") + 1];
                        original[key] = td.textContent.trim();
                    });
                    row._original = original;
                    enterEditMode(row);
                }

                if (e.target.matches(".btn-cancel")) {
                    exitEditMode(row, row._original);
                }

                if (e.target.matches(".btn-save")) {
                    saveRow(row);
                }
            });
        }

        // Filtros
        if (form) {
            form.addEventListener("submit", () => {
                if (inputNm) inputNm.value = "";
            });

            const submitFilters = () => {
                if (inputNm) inputNm.value = "";
                form.submit();
            };

            sHotel?.addEventListener("change", submitFilters);
            fInicio?.addEventListener("change", submitFilters);
            fFin?.addEventListener("change", submitFilters);
        }

        // Buscador en vivo
        if (inputNm) {
            let timer;
            inputNm.addEventListener("input", () => {
                clearTimeout(timer);
                const term = inputNm.value.toLowerCase().trim();
                timer = setTimeout(() => filterTable(term), 300);
            });
        }

        dedupeReporte();

        // Exportar global con filtros
        const exportModal = document.getElementById("modalExportar");
        const exportBtn = document.querySelector('[onclick="abrirModalExportar()"]');
        const cancelBtn = document.querySelector('#modalExportar button[onclick="cerrarModalExportar()"]');
        const btnExportarPDF = document.getElementById("btnExportarPDF");
        const btnExportarExcel = document.getElementById("btnExportarExcel");

        function construirURLConFiltros(baseURL) {
            const params = new URLSearchParams();

            if (sHotel?.value) params.append("hotel", sHotel.value);
            if (fInicio?.value) params.append("fecha_inicio", fInicio.value);
            if (fFin?.value) params.append("fecha_fin", fFin.value);
            if (inputNm?.value) params.append("nombre", inputNm.value);

            return `${baseURL}?${params.toString()}`;
        }

        window.abrirModalExportar = function () {
            if (btnExportarPDF && btnExportarExcel) {
                btnExportarPDF.href = construirURLConFiltros("/seguridadysalud/reporte/pdf");
                btnExportarExcel.href = construirURLConFiltros("/seguridadysalud/reporte/excel");
            }
            exportModal.classList.remove("hidden");
        };

        if (cancelBtn) {
            cancelBtn.addEventListener("click", () => {
                exportModal.classList.add("hidden");
            });
        }

        // Exportar individual
        const modalExportarInd = document.getElementById("modalExportarIndividual");
        const linkPDF = document.getElementById("linkExportarPDFIndividual");
        const linkExcel = document.getElementById("linkExportarExcelIndividual");
        const cerrarBtnInd = document.querySelector('#modalExportarIndividual button[onclick="cerrarModalExportarIndividual()"]');

        window.abrirModalExportarIndividual = function (id) {
            if (linkPDF && linkExcel && modalExportarInd) {
                linkPDF.href = `/seguridadysalud/reporte/pdf/individual/${id}`;
                linkExcel.href = `/seguridadysalud/reporte/excel/individual/${id}`;
                modalExportarInd.classList.remove("hidden");
            }
        };

        window.cerrarModalExportarIndividual = function () {
            if (modalExportarInd) {
                modalExportarInd.classList.add("hidden");
            }
        };

        if (cerrarBtnInd) {
            cerrarBtnInd.addEventListener("click", () => {
                modalExportarInd.classList.add("hidden");
            });
        }
    });
}
