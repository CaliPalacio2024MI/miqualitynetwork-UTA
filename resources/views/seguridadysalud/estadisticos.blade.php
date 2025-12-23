@extends('layouts.app')

@section('content')
{{-- INCLUIMOS EL NAV justo al inicio de la sección --}}
@include('seguridadysalud.partials.top_navigation_formulario')
{{-- /////// ESTILOS ////// --}}
<style>
/* Contenedor principal */
.contenedor {
    max-width: 1300px;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
    font-family: 'Segoe UI', Roboto, sans-serif;
}

/* Título */
.titulo {
    text-align: center;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #092034;
    letter-spacing: 0.5px;
}

/* Contenedor visual de los filtros */
.bloque-filtros {
    background: #ffffff;
    border-radius: 12px;
    padding: 1.5rem 2rem;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 2rem;
}

/* Filtros internos */
.filtros {
    display: flex;
    flex-wrap: wrap;
    gap: 1.2rem 1.5rem;
    align-items: flex-end;
    justify-content: flex-start;
}

/* Cada par: etiqueta + input */
.filter-pair {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    min-width: 180px;
}

.filter-pair label {
    font-weight: 500;
    color: #092034;
    font-size: 0.92rem;
}

/* Inputs y selects */
.line-input,
.filtros input[type="date"],
.filtros select {
    min-width: 160px;
    padding: 0.5rem 1rem;
    border: 1px solid #BABABA;
    border-radius: 6px;
    background: #FAFAFA;
    font-size: 0.95rem;
    transition: border-color 0.2s;
}

/* Botones */
.btn-group {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.btn-group button {
    background: #BC8A55;
    color: white;
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.25s ease;
}

.btn-group button:hover {
    background: #092034;
}

/* Gráficas en grid */
.graficas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
}

/* Tarjeta gráfica */
.grafica-card {
    background: #F5F5F5;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.grafica-card h3 {
    margin-bottom: 1rem;
    color: #092034;
    font-size: 1.1rem;
    font-weight: 600;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .filtros {
        justify-content: center;
    }

    .filter-pair {
        min-width: 100%;
    }
}
/* Reduce ancho para que todo quepa bien */
.filter-pair select,
.filter-pair input[type="date"] {
    max-width: 190px;
}

/* Estilo café en bordes de los inputs/selects */
.line-input,
.filtros input[type="date"],
.filtros select {
    border: 1.5px solid #BC8A55;
    background: #FAFAFA;
}

/* Ajuste extra para el nuevo combo */
.filter-grafica-boton select {
    margin-right: 0.25rem;
}
.btn-accion {
    background: #BC8A55;
    color: white;
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.25s ease;
}

.btn-accion:hover {
    background: #092034;
}
.filter-bar-row {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.filter-bar-row label {
    font-weight: 500;
    color: #092034;
    font-size: 0.92rem;
    margin-right: 0.5rem;
}


</style>


<div class="contenedor">
    <h2 class="titulo">Estadísticas Lineales de Accidentes</h2>
<div class="bloque-filtros">
    <div class="filtros">
        {{-- HOTEL --}}
        <div class="filter-pair">
            <label for="filtroHotel">Hotel:</label>
            <select id="filtroHotel" name="hotel" class="line-input">
                <option value="" @if(request('hotel')=='' ) selected @endif>Todos</option>
                @foreach($propiedades as $prop)
                <option value="{{ $prop->id_propiedad }}" @if(request('hotel')==$prop->id_propiedad) selected @endif>
                    {{ $prop->nombre_propiedad }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- FECHA INICIO --}}
        <div class="filter-pair">
            <label for="fechaInicio">Fecha Inicio:</label>
            <input type="date" id="fechaInicio" name="fecha_inicio" class="line-input"
                value="{{ request('fecha_inicio','') }}">
        </div>

        {{-- FECHA FIN --}}
        <div class="filter-pair">
            <label for="fechaFin">Fecha Fin:</label>
            <input type="date" id="fechaFin" name="fecha_fin" class="line-input"
                value="{{ request('fecha_fin','') }}">
        </div>

        {{-- TIPO DE GRÁFICA --}}
        <div class="filter-pair">
            <label for="filtroGrafica">Tipo de gráfica:</label>
            <select id="filtroGrafica" name="grafica" class="line-input">
                <option value="todas" @if(request('grafica','todas')=='todas' ) selected @endif>Todas</option>
                <option value="departamento" @if(request('grafica')=='departamento' ) selected @endif>Accidentes por Departamento</option>
                <option value="mes" @if(request('grafica')=='mes' ) selected @endif>Accidentes por Mes</option>
                <option value="dias" @if(request('grafica')=='dias' ) selected @endif>Días Perdidos por Incapacidad</option>
                <option value="partes" @if(request('grafica')=='partes' ) selected @endif>Partes del cuerpo afectadas</option>
            </select>
        </div>

        {{-- BOTONES (directamente dentro del .filtros) --}}
        <button id="btnFiltrar" class="btn-accion">Filtrar</button>
        <button id="btnExportarPDF" class="btn-accion">Exportar PDF</button>
        <button id="btnExportarExcel" class="btn-accion">Exportar Excel</button>
    </div>
</div>

<div class="graficas-grid">
    <div class="grafica-card">
        <h3>Accidentes por Departamento</h3>
        <canvas id="graficaDepartamentos"></canvas>
    </div>
    <div class="grafica-card">
        <h3>Accidentes por Mes</h3>
        <canvas id="graficaMeses"></canvas>
    </div>
    <div class="grafica-card">
        <h3>Días Perdidos por Incapacidad</h3>
        <canvas id="graficaDiasPerdidos"></canvas>
    </div>
</div>

<hr class="my-10 border-t-2 border-gray-300">

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
    <div class="bg-white shadow-md rounded-xl p-6 overflow-auto">
        <h3 class="text-lg font-bold mb-4 text-gray-800">Partes del cuerpo más afectadas</h3>
        <table id="tablaPartesCuerpo" class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Parte del cuerpo</th>
                    <th class="px-4 py-2">Porcentaje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200" id="tbodyPartesCuerpo">
                {{-- Se llena con JS --}}
            </tbody>
        </table>
    </div>

    <div class="flex justify-center">
        <img src="{{ asset('images/modules/historialclinico/adelante_L.png') }}" alt="Cuerpo humano" class="max-w-full h-auto rounded-xl shadow-md">
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
@endsection

@push('scripts')
@vite('resources/js/modules/seguridadysalud/estadisticos.js')

@endpush
