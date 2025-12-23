@vite(['resources/css/modules/historialclinico/sideBar.css'])
@vite(['resources/css/modules/historialclinico/formulario.css'])
@vite(['resources/js/modules/historialclinico/agentes.js'])
@vite(['resources/js/modules/historialclinico/firmas.js'])
@vite(['resources/js/modules/historialclinico/estadisticas.js'])
@vite(['resources/js/modules/historialclinico/filtros.js'])
@vite(['resources/js/modules/historialclinico/verYeditarRegistros.js'])
@vite(['resources/js/modules/historialclinico/descargarReporte.js'])
@vite(['resources/js/modules/historialclinico/validacionesForm.js'])
@vite(['resources/js/modules/historialclinico/informe.js'])

<div id="contentCompanies">
    <div class="navigation">
        <div class="dropdown">
            <img src="{{ asset('images/propiedad.png') }}" alt="propiedad-icon" class="iconos">
            <button>Formulario ▼</button>
            <div class="dropdown-content">
                <a href="#" class="nav-link" data-ajax>Nuevo Registro</a>
            </div>
        </div>
        <div class="dropdown">
            <img src="{{ asset('images/informe.png') }}" alt="informe-icon" class="iconos">
            <button>Informe ▼</button>
            <div class="dropdown-content">
                <a href="{{ route('historialclinico.reportStatistics') }}" class="nav-link" data-ajax>Estadísticos</a>
                <a href="{{ route('historialclinico.reportContent') }}" class="nav-link" data-ajax>Reporte</a>
            </div>
        </div>
    </div>

    <button class="logout-button">Cerrar Historial</button>
</div>

@vite(['resources/js/modules/historialclinico/cargaDeDepartamentos.js'])

<script>
// AJAX dinámico para enlaces con data-ajax
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('[data-ajax]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            fetch(this.href)
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('#mainContent');
                    if (newContent) {
                        document.querySelector('#mainContent').innerHTML = newContent.innerHTML;

                        if (typeof generarGraficaDesdeTabla === "function") {
                            const selectPropiedad = document.getElementById('propiedad');
                            if (selectPropiedad) {
                                selectPropiedad.addEventListener('change', generarGraficaDesdeTabla);
                            }
                            generarGraficaDesdeTabla();
                        }

                        if (typeof inicializarFormularioDinamico === "function") inicializarFormularioDinamico();
                        if (typeof actualizarEstadisticas === "function") actualizarEstadisticas();
                        if (typeof filtroReporte === "function") filtroReporte();
                        if (window.initCanvas) window.initCanvas();
                        if (window.initCanvasMedico) window.initCanvasMedico();
                        if (typeof filtrarTabla === "function") filtrarTabla();
                        if (typeof reporteTabla === "function") reporteTabla();
                        if (typeof mostrarRegistro === "function") mostrarRegistro();
                        if (typeof cerrarModal === "function") cerrarModal();
                        if (typeof editRegister === "function") editRegister();
                        if (typeof cerrarModals === "function") cerrarModals();
                        if (typeof descargarReporte === "function") descargarReporte();
                    }
                });
        });
    });
});

// Nueva función: cargar vistas personalizadas como estadísticas1
function loadView(view) {
    const container = document.getElementById("mainContent");
    fetch(`/seguridadysalud/historial-clinico/${view}`)
        .then(r => r.text())
        .then(html => container.innerHTML = html)
        .catch(err => console.error("Error al cargar vista:", err));
}
</script>
