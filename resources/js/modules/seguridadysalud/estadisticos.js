import Chart from "chart.js/auto";

// ——— Helpers globales ——————————————————————————————

async function captureChart(id) {
    const canvas = document.getElementById(id);
    return window.html2canvas(canvas).then((c) => c.toDataURL("image/png"));
}

function crearChart(canvasId) {
    const ctx = document.getElementById(canvasId).getContext("2d");
    return new Chart(ctx, {
        type: "line",
        data: {
            labels: [],
            datasets: [{ label: "", data: [], fill: false, tension: 0.4 }],
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } },
    });
}

function renderChart(chart, labels, data, labelText) {
    chart.data.labels = labels;
    chart.data.datasets[0].data = data;
    chart.data.datasets[0].label = labelText;
    chart.update();
}

// ——— Principal ——————————————————————————————————————
document.addEventListener("DOMContentLoaded", () => {
    const filtroHotel = document.getElementById("filtroHotel");
    const fechaInicio = document.getElementById("fechaInicio");
    const fechaFin = document.getElementById("fechaFin");
    const filtroGrafica = document.getElementById("filtroGrafica");
    const btnFiltrar = document.getElementById("btnFiltrar");
    const btnExportarPDF = document.getElementById("btnExportarPDF");
    const btnExportarExcel = document.getElementById("btnExportarExcel");

    const cardDepto = document
        .getElementById("graficaDepartamentos")
        .closest(".grafica-card");
    const cardMes = document
        .getElementById("graficaMeses")
        .closest(".grafica-card");
    const cardDias = document
        .getElementById("graficaDiasPerdidos")
        .closest(".grafica-card");

    function toggleCards(tipo) {
        cardDepto.style.display =
            tipo === "todas" || tipo === "departamento" ? "" : "none";
        cardMes.style.display =
            tipo === "todas" || tipo === "mes" ? "" : "none";
        cardDias.style.display =
            tipo === "todas" || tipo === "dias" ? "" : "none";
    }

    const chartDepto = crearChart("graficaDepartamentos");
    const chartMes = crearChart("graficaMeses");
    const chartDias = crearChart("graficaDiasPerdidos");

    async function cargarYPintar(hotel, inicio, fin, tipoGrafica) {
        toggleCards(tipoGrafica);

        const params = new URLSearchParams();
        if (hotel) params.append("hotel", hotel);
        if (inicio) params.append("fecha_inicio", inicio);
        if (fin) params.append("fecha_fin", fin);

        const res = await fetch(
            `/seguridadysalud/estadisticos/data?${params}`,
            {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            }
        );
        if (!res.ok) return console.error("Error servidor:", res.status);

        const { porDepto, porMes, porDias, porPartes } = await res.json();

        // Deptos
        if (tipoGrafica === "todas" || tipoGrafica === "departamento") {
            renderChart(
                chartDepto,
                porDepto.map((i) => i.etiqueta),
                porDepto.map((i) => i.valores),
                "Accidentes por Departamento"
            );
        } else renderChart(chartDepto, [], [], "");

        // Meses
        if (tipoGrafica === "todas" || tipoGrafica === "mes") {
            renderChart(
                chartMes,
                porMes.map((i) => i.etiqueta),
                porMes.map((i) => i.valores),
                "Accidentes por Mes"
            );
        } else renderChart(chartMes, [], [], "");

        // Días
        if (tipoGrafica === "todas" || tipoGrafica === "dias") {
            renderChart(
                chartDias,
                porDias.map((i) => i.etiqueta),
                porDias.map((i) => i.valores),
                "Días Perdidos por Incapacidad"
            );
        } else renderChart(chartDias, [], [], "");

        // Tabla de partes del cuerpo
        const tbody = document.getElementById("tbodyPartesCuerpo");
        tbody.innerHTML = "";

        const total = porPartes.reduce((acc, obj) => acc + obj.valores, 0);

        porPartes
            .sort((a, b) => b.valores - a.valores)
            .forEach((parte) => {
                const porcentaje = total ? ((parte.valores / total) * 100).toFixed(1) : 0;
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="px-4 py-2">${parte.etiqueta}</td>
                    <td class="px-4 py-2">${porcentaje}%</td>
                `;
                tbody.appendChild(row);
            });
    }

    // carga inicial
    cargarYPintar(
        filtroHotel.value,
        fechaInicio.value,
        fechaFin.value,
        filtroGrafica.value
    );

    // listeners
    btnFiltrar.addEventListener("click", () =>
        cargarYPintar(
            filtroHotel.value,
            fechaInicio.value,
            fechaFin.value,
            filtroGrafica.value
        )
    );
    filtroGrafica.addEventListener("change", () =>
        cargarYPintar(
            filtroHotel.value,
            fechaInicio.value,
            fechaFin.value,
            filtroGrafica.value
        )
    );

    // export PDF
    btnExportarPDF.addEventListener("click", async () => {
        const payload = {
            mostrar: filtroGrafica.value,
            imgDepartamento: await captureChart("graficaDepartamentos"),
            imgMes: await captureChart("graficaMeses"),
            imgDias: await captureChart("graficaDiasPerdidos"),
        };
        fetch(URL_EXPORT_PDF, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                "Content-Type": "application/json",
            },
            body: JSON.stringify(payload),
        })
            .then((r) => r.blob())
            .then((blob) => {
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "estadisticas.pdf";
                a.click();
            })
            .catch(console.error);
    });

    // export EXCEL
    btnExportarExcel.addEventListener("click", async (e) => {
        e.preventDefault();

        const params = new URLSearchParams({
            hotel: filtroHotel.value,
            fecha_inicio: fechaInicio.value,
            fecha_fin: fechaFin.value,
        });
        const resDatos = await fetch(
            `/seguridadysalud/estadisticos/data?${params}`,
            {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            }
        );
        if (!resDatos.ok) {
            return alert("No se pudo obtener datos para Excel.");
        }
        const { porDepto, porMes, porDias, porPartes } = await resDatos.json();

        const payload = {
            mostrar: filtroGrafica.value,
            porDepto,
            porMes,
            porDias,
            porPartes,
        };

        try {
            const res = await fetch(URL_EXPORT_EXCEL, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(payload),
            });
            if (!res.ok) throw new Error(res.status);
            const blob = await res.blob();
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "estadisticas.xlsx";
            document.body.appendChild(a);
            a.click();
            a.remove();
            URL.revokeObjectURL(url);
        } catch (err) {
            console.error(err);
            alert("Error generando Excel. Revisa la consola.");
        }
    });
});
