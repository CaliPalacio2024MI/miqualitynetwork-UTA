@extends('layouts.dashboard')

@section('title', 'Control documental')

@section('content')

    <div class="p-6 bg-white rounded-2xl shadow-md h-full flex flex-col overflow-y-auto">
        <!-- Encabezado con título e imagen -->
        <div class="flex items-center justify-between">
            <div class="flex items-center"> <!-- Contenedor flex para alinear el texto y la imagen -->
                <img src="/images/listamaestra.png" alt="Lista Maestra" class="w-12 h-12">
                <!-- Imagen alineada a la derecha del texto -->
                <h2 class="text-2xl font-bold text-gray-900">LMD</h2>
            </div>
        </div>

        <p class="text-lm text-gray-600 mb-4">Lista Maestra de Distribución.</p>

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
                            <th class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Firma</th>
                            <th class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Fecha y Hora</th>
                            <th class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Puesto</th>
                            <th class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Nombre</th>
                            <th class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Información documentada requerida por Mundo Imperial</th>
                            <th class="px-4 py-2 text-left sticky top-0 bg-[#092034] text-[#FFF] font-semibold">Información documentada requerida por organizaciones externas</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-gray-100">
                        @foreach ($archivos as $archivo)
                            @php
                                $proceso = $archivo->proceso;
                                $responsables = [
                                    ['nombre' => $proceso->responsable1 ?? null, 'firma' => $archivo->firma1, 'fecha' => $archivo->fechafirma1],
                                    ['nombre' => $proceso->responsable2 ?? null, 'firma' => $archivo->firma2, 'fecha' => $archivo->fechafirma2],
                                    ['nombre' => $proceso->responsable3 ?? null, 'firma' => $archivo->firma3, 'fecha' => $archivo->fechafirma3],
                                ];
                            @endphp
                            @foreach ($responsables as $resp)
                                @if ($resp['nombre'])
                                    <tr class="odd:bg-gray-50 even:bg-gray-100 hover:bg-gray-200">
                                        <!-- Firma -->
                                        <td class="px-4 py-3 text-gray-900">
                                            {{ $resp['firma'] == 1 ? 'Firmado' : 'Pendiente' }}
                                        </td>
                                        <!-- Fecha y Hora -->
                                        <td class="px-4 py-3 text-gray-900">
                                            {{ $resp['fecha'] ? \Carbon\Carbon::parse($resp['fecha'])->format('Y-m-d H:i') : '-' }}
                                        </td>
                                        <!-- Puesto (nombre del proceso) -->
                                        <td class="px-4 py-3 text-gray-900">
                                            {{ 'Responsable de ' . ($proceso->nombre_proceso ?? '-') }}
                                        </td>
                                        <!-- Nombre del responsable -->
                                        <td class="px-4 py-3 text-gray-900">
                                            {{ $resp['nombre'] }}
                                        </td>
                                        <!-- Información documentada requerida por Mundo Imperial (interna) -->
                                        <td class="px-4 py-3 text-gray-900">
                                            {{ $archivo->tipo_documento == 'Interna' ? $archivo->nombre_archivo : '' }}
                                        </td>
                                        <!-- Información documentada requerida por organizaciones externas (externa) -->
                                        <td class="px-4 py-3 text-gray-900">
                                            {{ $archivo->tipo_documento == 'Externa' ? $archivo->nombre_archivo : '' }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
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