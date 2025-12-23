
function actualizarEstadisticas(puesto = '', propiedad = '', departamento = ''){
        const url = `/api/estadisticas-empleados?puesto_aspirante=${puesto}&razon_social=${propiedad}&departamento=${departamento}`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
        document.querySelector('#totalRegistros').textContent = data.total;
        document.querySelector('#rt').textContent = data.rt;
        document.querySelector('#ec').textContent = data.ec;

        const heredoDiv = document.querySelector('#heredoTop');
        heredoDiv.innerHTML = '';

        if (data.topHeredo) {
            for (const [nombre, cantidad] of Object.entries(data.topHeredo)) {
                const nombreMostrar = nombre.replace(/_/g, ' ');
                heredoDiv.innerHTML += `${nombreMostrar}: <strong>${cantidad}</strong><br>`;
            }
        } else {
            heredoDiv.textContent = 'No hay datos de antecedentes heredofamiliares.';
        }

        // Prevalencia
        const prevalenciaDiv = document.querySelector('#prevalencia');
        prevalenciaDiv.innerHTML = '';
        if (data.prevalencia && data.prevalencia.length > 0) {
            const top3 = data.prevalencia
                .sort((a, b) => b.cantidad - a.cantidad)
                .slice(0, 3);

            top3.forEach(item => {
                prevalenciaDiv.innerHTML += `${item.especifique_enfermedad}: <strong>${item.cantidad}</strong><br>`;
            });
        } else {
            prevalenciaDiv.textContent = 'No hay enfermedades registradas.';
        }

        // Semáforo
        const semaforo = document.querySelector('#semaforo');
        let color = 'green';
        if (data.porcentajePatologia > 30 && data.porcentajePatologia <= 60) color = 'yellow';
        if (data.porcentajePatologia > 60) color = 'red';

        semaforo.style.backgroundColor = color;
        document.querySelector('#porcentajePatologia').textContent = data.porcentajePatologia ? parseFloat(data.porcentajePatologia).toFixed(2) + '%' : '0%';
    })
            .catch(err => console.error('Error al actualizar estadísticas:', err));
    }

    window.actualizarEstadisticas = actualizarEstadisticas;

// Colores más sofisticados y variados
const CHART_COLORS = [
    'red', '#f28e2b', '#e15759', '#76b7b2', '#59a14f',
    '#edc948', '#b07aa1', '#ff9da7', '#9c755f', '#bab0ac'
];
// Definir colores específicos para las razones sociales (si aún los usas en otras partes)
const RAZON_SOCIAL_COLORS = {
    'Princess': '#007bff', // Azul
    'Palacio': '#dc3545', // Rojo
    'Pierre': '#28a745',  // Verde
    // Añade más si tienes otras razones sociales
};

// --- FUNCIONES AUXILIARES ---

// Función auxiliar para oscurecer/aclarar un color (útil para gradientes y bordes)
function adjustColor(hex, lum) {
    hex = String(hex).replace(/[^0-9a-f]/gi, '');
    if (hex.length < 6) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    lum = lum || 0;
    var rgb = "#", c, i;
    for (i = 0; i < 3; i++) {
        c = parseInt(hex.substr(i * 2, 2), 16);
        c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
        rgb += ("00" + c).substr(c.length);
    }
    return rgb;
}

// Función auxiliar para dibujar un punto (círculo o cuadrado)
function drawPoint(ctx, x, y, color, size = 6, shape = 'circle') {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#fff'; // Borde blanco para el punto
    ctx.lineWidth = 1.5;

    ctx.beginPath();
    if (shape === 'circle') {
        ctx.arc(x, y, size / 2, 0, 2 * Math.PI);
    } else if (shape === 'square') {
        ctx.rect(x - size / 2, y - size / 2, size, size);
    }
    ctx.fill();
    ctx.stroke();
}

// Función auxiliar para dibujar rectángulos redondeados (para barras)
function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
    if (typeof radius === 'undefined') radius = 5;
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.lineTo(x + width - radius, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
    ctx.lineTo(x + width, y + height - radius);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
    ctx.lineTo(x + radius, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
    ctx.lineTo(x, y + radius);
    ctx.quadraticCurveTo(x, y, x + radius, y);
    ctx.closePath();
    if (fill) ctx.fill();
    if (stroke) ctx.stroke();
}

// Función auxiliar para normalizar un valor a una escala de 0 a 100
// Esta función ahora será usada selectivamente
function normalizeValue(value, minExpected, maxExpected) {
    if (maxExpected === minExpected) return 0; // Evitar división por cero si min y max son iguales
    const normalized = ((value - minExpected) / (maxExpected - minExpected)) * 100;
    return Math.max(0, Math.min(100, normalized)); // Asegurar que esté entre 0 y 100
}

// --- FUNCIONES DE DIBUJO DE GRÁFICAS ---

function dibujarBarChart(ctx, labels, data, titulo, horizontal = false, xAxisTitle = '', yAxisTitle = '', trendLineValue = null, trendLineLabel = 'Promedio') {
    const width = ctx.canvas.width;
    const height = ctx.canvas.height;
    const padding = 70;
    const barCount = data.length;
    const font = "13px 'Segoe UI', sans-serif";
    const titleFont = "bold 18px 'Segoe UI', sans-serif";
    const axisTitleFont = "bold 14px 'Segoe UI', sans-serif";
    const barSpacing = 15;
    const valueLabelOffset = 8;
    const cornerRadius = 5;
    const gridColor = '#e0e0e0';
    const trendLineColor = '#FF0000';
    const trendLineLabelColor = '#FF0000';
    const trendLineWidth = 2;
    const trendLineDash = [5, 5];

    ctx.clearRect(0, 0, width, height);

    ctx.font = titleFont;
    ctx.textAlign = "center";
    ctx.fillStyle = "#333";
    ctx.fillText(titulo, width / 2, 30);

    let maxDataValue = Math.max(...data);
    let scaleMax = 0;
    if (maxDataValue > 0) {
        scaleMax = Math.ceil(maxDataValue / 10) * 10;
        if (scaleMax === 0) scaleMax = 10;
    } else {
        scaleMax = 10;
    }
    if (trendLineValue !== null && trendLineValue > scaleMax) {
        scaleMax = Math.ceil(trendLineValue / 10) * 10;
    }

    const plotAreaLeft = padding;
    const plotAreaRight = width - padding / 2;
    const plotAreaTop = padding;
    const plotAreaBottom = height - padding;

    ctx.strokeStyle = '#aaa';
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(plotAreaLeft, plotAreaBottom);
    ctx.lineTo(plotAreaRight, plotAreaBottom);
    ctx.moveTo(plotAreaLeft, plotAreaBottom);
    ctx.lineTo(plotAreaLeft, plotAreaTop);
    ctx.stroke();

    if (!horizontal) { // Gráfica de Barras Vertical
        const availableWidth = plotAreaRight - plotAreaLeft;
        const barSize = Math.min(70, Math.max(15, (availableWidth / barCount) - barSpacing));
        const totalBarsWidth = barCount * (barSize + barSpacing);
        const startX = plotAreaLeft + (availableWidth - totalBarsWidth) / 2 + barSpacing / 2;

        ctx.font = font;

        const numTicks = 5;
        ctx.strokeStyle = gridColor;
        ctx.lineWidth = 0.5;
        ctx.textAlign = "right";
        for (let i = 0; i <= numTicks; i++) {
            const val = Math.round((scaleMax / numTicks) * i);
            const y = plotAreaBottom - (val / scaleMax) * (plotAreaBottom - plotAreaTop);
            ctx.fillStyle = "#666";
            ctx.fillText(val, plotAreaLeft - 10, y + 4);
            if (i > 0) {
                ctx.beginPath();
                ctx.moveTo(plotAreaLeft, y);
                ctx.lineTo(plotAreaRight, y);
                ctx.stroke();
            }
        }

        for (let i = 0; i < barCount; i++) {
            const barHeight = (data[i] / scaleMax) * (plotAreaBottom - plotAreaTop);
            const x = startX + i * (barSize + barSpacing);
            const y = plotAreaBottom - barHeight;

            const grad = ctx.createLinearGradient(x, y, x, plotAreaBottom);
            grad.addColorStop(0, CHART_COLORS[i % CHART_COLORS.length]);
            grad.addColorStop(1, adjustColor(CHART_COLORS[i % CHART_COLORS.length], -20));

            ctx.fillStyle = grad;
            roundRect(ctx, x, y, barSize, barHeight, cornerRadius, true, false);

            ctx.strokeStyle = adjustColor(CHART_COLORS[i % CHART_COLORS.length], -40);
            ctx.lineWidth = 1;
            ctx.stroke();

            ctx.fillStyle = "#333";
            ctx.textAlign = "center";
            ctx.fillText(labels[i], x + barSize / 2, plotAreaBottom + 20);
            ctx.fillText(data[i], x + barSize / 2, y - valueLabelOffset);
        }

        if (trendLineValue !== null && typeof trendLineValue === 'number' && !isNaN(trendLineValue)) {
            const trendLineY = plotAreaBottom - (trendLineValue / scaleMax) * (plotAreaBottom - plotAreaTop);
            ctx.strokeStyle = trendLineColor;
            ctx.lineWidth = trendLineWidth;
            ctx.setLineDash(trendLineDash);

            ctx.beginPath();
            ctx.moveTo(plotAreaLeft, trendLineY);
            ctx.lineTo(plotAreaRight, trendLineY);
            ctx.stroke();

            ctx.setLineDash([]);

            ctx.fillStyle = trendLineLabelColor;
            ctx.font = "bold 12px 'Segoe UI', sans-serif";
            ctx.textAlign = "left";
            ctx.fillText(`${trendLineLabel}: ${trendLineValue.toFixed(2)}`, plotAreaRight + 5, trendLineY + 4);
        }

        ctx.font = axisTitleFont;
        ctx.fillStyle = "#333";
        ctx.textAlign = "center";
        ctx.fillText(xAxisTitle, plotAreaLeft + availableWidth / 2, height - 10);
        ctx.save();
        ctx.translate(plotAreaLeft - 40, plotAreaTop + (plotAreaBottom - plotAreaTop) / 2);
        ctx.rotate(-Math.PI / 2);
        ctx.fillText(yAxisTitle, 0, 0);
        ctx.restore();

    } else { // Gráfica de Barras Horizontal
        const availableHeight = plotAreaBottom - plotAreaTop;
        const barSize = Math.min(50, Math.max(15, (availableHeight / barCount) - barSpacing));
        const totalBarsHeight = barCount * (barSize + barSpacing);
        const startY = plotAreaTop + (availableHeight - totalBarsHeight) / 2 + barSpacing / 2;

        ctx.font = font;

        const numTicks = 5;
        ctx.strokeStyle = gridColor;
        ctx.lineWidth = 0.5;
        ctx.textAlign = "center";
        for (let i = 0; i <= numTicks; i++) {
            const val = Math.round((scaleMax / numTicks) * i);
            const x = plotAreaLeft + (val / scaleMax) * (plotAreaRight - plotAreaLeft);
            ctx.fillStyle = "#666";
            ctx.fillText(val, x, plotAreaBottom + 20);
            if (i > 0) {
                ctx.beginPath();
                ctx.moveTo(x, plotAreaTop);
                ctx.lineTo(x, plotAreaBottom);
                ctx.stroke();
            }
        }

        for (let i = 0; i < barCount; i++) {
            const barWidth = (data[i] / scaleMax) * (plotAreaRight - plotAreaLeft);
            const y = startY + i * (barSize + barSpacing);

            const grad = ctx.createLinearGradient(plotAreaLeft, y, plotAreaLeft + barWidth, y);
            grad.addColorStop(0, CHART_COLORS[i % CHART_COLORS.length]);
            grad.addColorStop(1, adjustColor(CHART_COLORS[i % CHART_COLORS.length], -20));

            ctx.fillStyle = grad;
            roundRect(ctx, plotAreaLeft, y, barWidth, barSize, cornerRadius, true, false);

            ctx.strokeStyle = adjustColor(CHART_COLORS[i % CHART_COLORS.length], -40);
            ctx.lineWidth = 1;
            ctx.stroke();

            ctx.fillStyle = "#333";
            ctx.textAlign = "right";
            ctx.fillText(labels[i], plotAreaLeft - 10, y + barSize / 2 + 4);

            ctx.textAlign = "left";
            ctx.fillText(data[i], plotAreaLeft + barWidth + valueLabelOffset, y + barSize / 2 + 4);
        }

        if (trendLineValue !== null && typeof trendLineValue === 'number' && !isNaN(trendLineValue)) {
            const trendLineX = plotAreaLeft + (trendLineValue / scaleMax) * (plotAreaRight - plotAreaLeft);
            ctx.strokeStyle = trendLineColor;
            ctx.lineWidth = trendLineWidth;
            ctx.setLineDash(trendLineDash);

            ctx.beginPath();
            ctx.moveTo(trendLineX, plotAreaTop);
            ctx.lineTo(trendLineX, plotAreaBottom);
            ctx.stroke();

            ctx.setLineDash([]);

            ctx.fillStyle = trendLineLabelColor;
            ctx.font = "bold 12px 'Segoe UI', sans-serif";
            ctx.textAlign = "center";
            ctx.fillText(`${trendLineLabel}: ${trendLineValue.toFixed(2)}`, trendLineX, plotAreaTop - 10);
        }

        ctx.font = axisTitleFont;
        ctx.fillStyle = "#333";
        ctx.textAlign = "center";
        ctx.fillText(yAxisTitle, plotAreaLeft - 40, plotAreaTop + availableHeight / 2);
        ctx.fillText(xAxisTitle, plotAreaLeft + (plotAreaRight - plotAreaLeft) / 2, height - 10);
    }
}

// Nueva función dibujarRadarChart, modificada para aceptar rangos máximos
function dibujarRadarChart(ctx, dataValues, dataLabels, titulo, maxValues) {
    const width = ctx.canvas.width;
    const height = ctx.canvas.height;
    ctx.clearRect(0, 0, width, height);

    const centerX = width / 2;
    const centerY = height / 2 + 20;
    const radius = Math.min(width, height) / 3 - 20;
    const numAxes = dataLabels.length;
    const angleIncrement = (2 * Math.PI) / numAxes;

    const font = "13px 'Segoe UI', sans-serif";
    const titleFont = "bold 18px 'Segoe UI', sans-serif";
    const axisLabelFont = "12px 'Segoe UI', sans-serif";
    const valueLabelFont = "bold 11px 'Segoe UI', sans-serif";

    ctx.font = titleFont;
    ctx.textAlign = "center";
    ctx.fillStyle = "#333";
    ctx.fillText(titulo, width / 2, 30);

    const numCircles = 5;
    ctx.strokeStyle = '#007bff';
    ctx.lineWidth = 1;
    ctx.fillStyle = 'black';
    ctx.font = "10px 'Segoe UI', sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";

    const allDataValues = dataValues.map((val, i) => {
        if (maxValues && typeof maxValues[i] === 'number') {
            return normalizeValue(val, 0, maxValues[i]); // Re-normalizar para encontrar el MAX para la grilla
        }
        return val;
    });

    let maxGridValue = 100; // Por defecto para porcentajes 0-100
    // Si hay valores directos, necesitamos que la cuadrícula se adapte a su magnitud
    if (dataValues.some((val, i) => !maxValues || typeof maxValues[i] !== 'number')) {
        // Encontrar el valor máximo entre los valores que NO son porcentajes
        const maxNonNormalized = Math.max(0, ...dataValues.filter((val, i) => !maxValues || typeof maxValues[i] !== 'number'));
        if (maxNonNormalized > maxGridValue) {
            maxGridValue = Math.ceil(maxNonNormalized / 10) * 10; // Redondear al siguiente 10
        }
    }


    for (let i = 1; i <= numCircles; i++) {
        const r = (radius / numCircles) * i;
        ctx.beginPath();
        ctx.arc(centerX, centerY, r, 0, 2 * Math.PI);
        ctx.stroke();
        // Etiquetas de porcentaje/valor en los círculos del grid
        // Ajustamos las etiquetas para reflejar la escala.
        const labelStep = maxGridValue / numCircles;
        ctx.fillText(`${(labelStep * i).toFixed(0)}`, centerX + r + 15, centerY);
    }

    // Dibujar los ejes y sus etiquetas
    ctx.strokeStyle = '#007bff';
    ctx.lineWidth = 1;
    ctx.font = axisLabelFont;
    ctx.fillStyle = '#333';

    for (let i = 0; i < numAxes; i++) {
        const angle = i * angleIncrement - Math.PI / 2;
        const x = centerX + radius * Math.cos(angle);
        const y = centerY + radius * Math.sin(angle);

        ctx.beginPath();
        ctx.moveTo(centerX, centerY);
        ctx.lineTo(x, y);
        ctx.stroke();

        ctx.save();
        ctx.translate(x, y);
        if (Math.abs(Math.cos(angle)) < 0.1) {
            ctx.textAlign = "center";
        } else if (Math.cos(angle) > 0) {
            ctx.textAlign = "left";
        } else {
            ctx.textAlign = "right";
        }
        ctx.fillText(dataLabels[i], 0, (Math.sin(angle) > 0 ? 1 : -1) * 20);
        ctx.restore();
    }

    // --- Dibujar los Datos (el polígono de riesgo) ---
    ctx.beginPath();
    ctx.strokeStyle = CHART_COLORS[0];
    ctx.fillStyle = adjustColor(CHART_COLORS[0], 40);
    ctx.lineWidth = 3;
    ctx.shadowColor = "rgba(0,0,0,0.3)";
    ctx.shadowBlur = 8;

    for (let i = 0; i < numAxes; i++) {
        let value = dataValues[i];
        let displayValue; // Para mostrar en la etiqueta

        // Normalizar solo las métricas que deben ir de 0 a 100
        if (maxValues && typeof maxValues[i] === 'number') { // Si se proporcionó un max para esta métrica
            value = normalizeValue(value, 0, maxValues[i]); // Esto escala el valor al 0-100
            displayValue = `${value.toFixed(1)}%`; // Mostrar como porcentaje
        } else {
            value = (value / maxGridValue) * 100; // Escalar el valor directo al 0-100 del radio
            displayValue = value.toFixed(1); // Mostrar el valor directo, sin %
        }


        const pointRadius = (value / 100) * radius;
        const angle = i * angleIncrement - Math.PI / 2;

        const x = centerX + pointRadius * Math.cos(angle);
        const y = centerY + pointRadius * Math.sin(angle);

        if (i === 0) {
            ctx.moveTo(x, y);
        } else {
            ctx.lineTo(x, y);
        }

        drawPoint(ctx, x, y, CHART_COLORS[0]);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    ctx.shadowBlur = 0;

    // Dibujar las etiquetas de valor numérico junto a cada punto
    ctx.font = valueLabelFont;
    ctx.shadowColor = "rgba(255, 255, 255, 0.8)";
    ctx.shadowBlur = 4;
    ctx.fillStyle = "#333";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";

    for (let i = 0; i < numAxes; i++) {
        let value = dataValues[i];
        let labelText;

        // Decidir qué etiqueta mostrar y si es porcentaje o no
        if (maxValues && typeof maxValues[i] === 'number') {
            labelText = `${normalizeValue(value, 0, maxValues[i]).toFixed(1)}%`;
        } else {
            labelText = value.toFixed(1); // Mostrar el valor directo sin símbolo de porcentaje
        }

        // Para calcular la posición del texto, volvemos a escalar el valor original
        // con la escala general del radar (maxGridValue)
        const pointRadius = (value / maxGridValue) * radius; // Escalar el valor directo
        const angle = i * angleIncrement - Math.PI / 2;

        const x = centerX + (pointRadius + 15) * Math.cos(angle);
        const y = centerY + (pointRadius + 15) * Math.sin(angle);

        let offsetX = 0;
        let offsetY = 0;

        if (Math.abs(Math.cos(angle)) < 0.1) {
            offsetX = 0;
            offsetY = (Math.sin(angle) > 0) ? 10 : -10;
        } else if (Math.cos(angle) > 0) {
            offsetX = 5;
            offsetY = 0;
            ctx.textAlign = "left";
        } else {
            offsetX = -5;
            offsetY = 0;
            ctx.textAlign = "right";
        }

        ctx.fillText(labelText, x + offsetX, y + offsetY);
    }
}


// --- FUNCIÓN PRINCIPAL DE GENERACIÓN DE GRÁFICAS ---
function generarGraficaDesdeTabla() {
    const propiedad = document.getElementById('propiedad')?.value || '';
    const queryParams = new URLSearchParams();

    if (propiedad) {
        queryParams.append('razon_social', propiedad);
    }

    fetch('/api/estadisticas-empleados?' + queryParams.toString())
        .then(res => {
            if (!res.ok) {
                throw new Error('Error en la respuesta de la API: ' + res.statusText);
            }
            return res.json();
        })
        .then(json => {
    const canvas = document.getElementById('graficaCanvas');
    if (!canvas || !canvas.parentElement) {
        console.warn("No se encontró el canvas con id 'graficaCanvas' o su contenedor.");
        return; // Salir sin intentar dibujar
    }

    canvas.width = canvas.parentElement.offsetWidth > 600 ? 600 : canvas.parentElement.offsetWidth - 20;
    canvas.height = 400;
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    if (propiedad && json.dataByRazonSocial && json.dataByRazonSocial[propiedad]) {
        const fuente = json.dataByRazonSocial[propiedad].spiderChartData;

        dibujarRadarChart(
            ctx,
            fuente.values,
            fuente.labels,
            'Perfil de Salud y Riesgos de Empleados',
            fuente.maxValues
        );
    } else {
        const totalEmpleados = json.total > 0 ? json.total : 1;

        const labels = [
            'Riesgo Trabajo',
            'Riesgo Enfermedad',
            'Patología Detectada',
            'Sobrepeso/Obesidad',
            'Anomalías Físicas (Avg)',
            'Heredofamiliares Relevantes (%)'
        ];

        const dataForRadar = [
            (json.rt / totalEmpleados) * 100,
            (json.ec / totalEmpleados) * 100,
            json.porcentajePatologia,
            ((json.distribucionIMC['Sobrepeso'] + json.distribucionIMC['Obesidad']) / totalEmpleados) * 100,
            json.trendLines.promedioAnomalias,
            (Object.values(json.topHeredo).reduce((a, b) => a + b, 0) / totalEmpleados) * 100
        ];

        const maxValuesForNormalization = [100, 100, 100, 100, null, null];

        dibujarRadarChart(
            ctx,
            dataForRadar,
            labels,
            'Perfil de Salud y Riesgos de Empleados',
            maxValuesForNormalization
        );
    }
})
.catch(error => {
    console.error("Error al obtener datos o generar gráfica:", error);
    const container = document.getElementById('graficaContainer');
    if (container) {
        container.innerHTML = '<p style="color: red; text-align: center;">Error al cargar la gráfica: ' + error.message + '</p>';
    } else {
        console.warn("No se encontró el contenedor con id 'graficaContainer' para mostrar el mensaje de error.");
    }
});

}
window.generarGraficaDesdeTabla = generarGraficaDesdeTabla;
