@extends('layouts.app')

@section('content')
{{-- INCLUIMOS EL NAV justo al inicio de la sección --}}
@include('seguridadysalud.partials.top_navigation_formulario')


<div class="p-6 bg-white shadow rounded m-6" id="reportePrincipal">

    <h2 class="text-2xl font-semibold mb-4">Reporte de Accidentes</h2>

    {{-- FILTROS + PDF --}}
    <form id="formFiltro" method="GET" action="{{ route('seguridadysalud.reporte') }}" class="flex flex-wrap items-end mb-4 space-x-4">
        {{-- Hotel --}}
        <div>
            <label for="filtroHotel" class="block text-sm font-medium text-gray-700">Hotel:</label>
            <select name="hotel" id="filtroHotel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Todos</option>
                @foreach($propiedades as $prop)
                <option value="{{ $prop->id_propiedad }}" {{ $hotel == $prop->id_propiedad ? 'selected' : '' }}>
                    {{ $prop->nombre_propiedad }}
                </option>
                @endforeach
            </select>
        </div>


        {{-- Desde --}}
        <div>
            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Desde:</label>
            <input
                type="date"
                name="fecha_inicio"
                id="fecha_inicio"
                value="{{ $fechaInicio ?? '' }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        {{-- Hasta --}}
        <div>
            <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Hasta:</label>
            <input
                type="date"
                name="fecha_fin"
                id="fecha_fin"
                value="{{ $fechaFin ?? '' }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>


        {{-- Botón Filtrar --}}
        <div>
            <button
                type="submit"
                id="btnFiltrar"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-gray-500 transition-colors duration-200">
                Filtrar
            </button>
        </div>

        {{-- Botón Exportar Global --}}
        <div class="mt-6">
            <button type="button" onclick="abrirModalExportar()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">
                Exportar
            </button>
        </div>

        {{-- Buscador por Nombre --}}
        <div class="flex-1">
            <label for="filtroNombre" class="block text-sm font-medium text-gray-700">Buscar por nombre:</label>
            <input
                type="text"
                name="nombre"
                id="filtroNombre"
                value="{{ $nombre }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                placeholder="Escribe el nombre aquí">
        </div>
    </form>

    {{-- TABLA --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="tablaReporte">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Edad</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dirección</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Depto.</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($registros as $i => $r)
                <tr data-id="{{ $r->id }}">
                    <td class="px-4 py-2 index">{{ $registros->firstItem() + $i }}</td>
                    <td class="px-4 py-2 field nombre">{{ $r->nombre_lesionado }}</td>
                    <td class="px-4 py-2 field edad">{{ $r->edad_lesionado }}</td>
                    <td class="px-4 py-2 field direccion">{{ $r->direccion_particular }}</td>
                    <td class="px-4 py-2 field depto">{{ $r->departamento_evento }}</td>
                    <td class="px-4 py-2 field fecha">{{ \Carbon\Carbon::parse($r->fecha_evento)->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 text-center actions space-x-2">
                        <button type="button" class="btn-edit text-indigo-600 hover:text-indigo-900">Editar</button>
                        <button type="button" class="btn-save text-green-600 hover:text-green-900 hidden">Guardar</button>
                        <button type="button" class="btn-cancel text-gray-600 hover:text-gray-900 hidden">Cancelar</button>

                        {{-- Botón Eliminar --}}
                        <form
                            action="{{ route('seguridadysalud.reporte.destroy', $r->id) }}"
                            method="POST"
                            class="inline delete-form"
                            onsubmit="return confirm('¿Seguro que deseas eliminar este registro?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                        </form>
                        
                        {{-- NUEVO: Botón Exportar Individual --}}
                        <button
                            type="button"
                            class="btn-exportar-individual px-2 py-1  bg-green-600 text-white rounded hover:bg-green-700 transition duration-200"
                            onclick="abrirModalExportarIndividual({{ $r->id }})"
                            title="Exportar registro individual">
                            Exportar
                        </button>

                    </td>
                </tr>
                @endforeach

                @if($registros->isEmpty())
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                        No se encontraron registros.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $registros->links() }}
    </div>
</div>

{{-- MODAL GLOBAL --}}
<div id="modalExportar" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80 text-center">
        <h2 class="text-lg font-semibold mb-4">¿En qué formato deseas exportar?</h2>
        <div class="flex flex-col gap-3">
            <a id="btnExportarPDF" href="#" class="bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">Exportar PDF</a>
            <a id="btnExportarExcel" href="#" class="bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Exportar Excel</a>
            <button onclick="cerrarModalExportar()" class="mt-2 text-gray-600 hover:text-black">Cancelar</button>
        </div>
    </div>
</div>

{{-- MODAL INDIVIDUAL --}}
<div id="modalExportarIndividual" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80 text-center">
        <h2 class="text-lg font-semibold mb-4">¿En qué formato deseas exportar este registro?</h2>
        <div class="flex flex-col gap-3">
            <a id="linkExportarPDFIndividual" href="#" class="bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">Exportar PDF</a>
            <a id="linkExportarExcelIndividual" href="#" class="bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Exportar Excel</a>
            <button onclick="cerrarModalExportarIndividual()" class="mt-2 text-gray-600 hover:text-black">Cancelar</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@vite('resources/js/modules/seguridadysalud/reporte.js')
@endpush