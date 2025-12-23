@extends('layouts.dashboard')

@section('title', 'Control documental')

@section('content')

    <div class="p-6 bg-white rounded-2xl shadow-md h-full flex flex-col overflow-y-auto">
  

        <!-- Encabezado con título e imagen -->
        <div class="flex items-center justify-between">
            <div class="flex items-center"> <!-- Contenedor flex para alinear el texto y la imagen -->
                <img src="/images/listamodificados.png" alt="Lista Maestra" class="w-12 h-12"> <!-- Imagen alineada a la derecha del texto -->    
                <h2 class="text-2xl font-bold text-gray-900">LMCC</h2>
            </div>
        </div>

        <p class="text-lg text-gray-600 mb-4">Lista Maestra de Control de Cambios.</p>

        <!-- Filtros y buscador -->
        <div class="flex flex-wrap items-center gap-8 mb-4">
            <!-- Buscador -->
            <input type="text" id="globalSearch" placeholder="🔎 Buscar por cualquier campo..."
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200">
        </div>

        <div class="overflow-x-auto flex-1">
            <div class="overflow-y-auto max-h-full"> <!-- Ajustado contenedor con overflow-y-auto y max-h-full -->
                <table class="min-w-full divide-y divide-gray-200 text-sm rounded-lg">
                    <thead>
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Nombre de la información documentada</th>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Tipo de información documentada</th>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Fecha de emisión</th>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Edición</th>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Cambio realizado</th>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Nueva edición</th>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Nueva fecha de emisión</th>
                            <th scope="col" class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Responsable del cambio</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-gray-100">
                        @foreach ($archivos as $archivo)
                            <tr class="odd:bg-gray-50 even:bg-gray-100 hover:bg-gray-200">
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->nombre_archivo }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->tipo_documento }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->fecha_emision }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->edicion }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->cambio_realizado }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->nueva_edicion }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->nueva_fecha_emision }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $archivo->responsable_cambio }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('globalSearch');
            const tableBody = document.getElementById('table-body');

            searchInput.addEventListener('input', function () {
                const filter = searchInput.value.toLowerCase();
                const rows = tableBody.getElementsByTagName('tr');

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    let match = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cellText = cells[j].textContent || cells[j].innerText;
                        if (cellText.toLowerCase().includes(filter)) {
                            match = true;
                            break;
                        }
                    }

                    rows[i].style.display = match ? '' : 'none';
                }
            });
        });
    </script>

@endsection