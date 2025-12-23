@extends('layouts.dashboard')

@section('title', "Administrar: $carpeta->nombre_carpeta")

@section('content')
<div class="container p-4 mx-auto">
    <h2 class="mb-4 text-2xl font-bold">📂 Administrar: {{ $carpeta->nombre_carpeta }}</h2>

    <!--Subcarpetas dentro de esta carpeta -->
    @if (!$subcarpetas->isEmpty())
    <h3 class="my-3 text-lg font-bold">📁 Subcarpetas</h3>
    <div class="flex flex-wrap gap-4">
        @foreach ($subcarpetas as $subcarpeta)
        <div class="folder-container">
            <a href="{{ route('admin.carpeta', ['seccion' => $seccion, 'carpeta_id' => $subcarpeta->id]) }}"
                class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200">
                📂 {{ $subcarpeta->nombre_carpeta }}
            </a>

        </div>
        @endforeach
    </div>
    @endif
    <!--Filtro de visibilidad -->
    <div class="flex items-center gap-2 mb-4">
        <label for="estado" class="text-sm font-medium text-gray-700">Filtrar por estado:</label>
        <form method="GET" action="{{ route('admin.carpeta', ['seccion' => $seccion, 'carpeta_id' => $carpeta->id]) }}">
            <select name="estado" id="estado" onchange="this.form.submit()"
                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" {{ request('estado') === null ? 'selected' : '' }}>📂 Todos</option>
                <option value="visible" {{ request('estado') === 'visible' ? 'selected' : '' }}>🟢 Visibles</option>
                <option value="oculto" {{ request('estado') === 'oculto' ? 'selected' : '' }}>🔴 Ocultos</option>
            </select>
        </form>
    </div>

    <!--Tabla de archivos -->
    <h3 class="my-3 text-lg font-bold">📄 Archivos en: {{ $carpeta->nombre_carpeta }}</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">#</th>
                    <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">Nombre</th>
                    <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">Tamaño</th>
                    <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">Tipo</th>
                    <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">Estado</th>
                    <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($archivos as $archivo)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $archivo->nombre_archivo }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ number_format($archivo->tamano / 1024, 2) }} KB
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $archivo->tipoarchivo_mime }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        @if ($archivo->visible)
                        <span class="font-semibold text-green-600">Visible</span>
                        @else
                        <span class="font-semibold text-red-500">Oculto</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        <a href="{{ route('archivos.download', ['id' => $archivo->id_archivo]) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            ⬇ Descargar
                        </a>

                        @if ($archivo->tipoarchivo_mime === 'application/pdf' && $archivo->visible)
                        <a href="{{ route('archivos.verPdf', $archivo->id_archivo) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white rounded-md hover:bg-green-600 ml-2"
                            target="_blank">
                            👁 Ver
                        </a>
                        @endif

                        @if ($archivo->visible)
                        <button type="button" onclick="openModal({{ $archivo->id_archivo }})"
                            class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600">
                            🗑 Ocultar
                        </button>
                        @else
                        <form action="{{ route('archivos.restaurar', $archivo->id_archivo) }}" method="POST"
                            class="inline ml-2" onsubmit="return confirm('¿Deseas restaurar este archivo?');">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                🔁 Restaurar
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para ocultar archivo -->
    <div id="modalOcultar" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-lg font-semibold mb-4">Ocultar Archivo</h2>
            <form id="formOcultar" method="POST" action="">
                @csrf
                <input type="hidden" name="id_archivo" id="idArchivo">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Razón de Eliminación</label>
                    <input type="text" name="razon_eliminacion"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Fecha de Eliminación</label>
                    <input type="date" name="fecha_eliminacion"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ date('Y-d-m') }}"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Responsable de Eliminación</label>
                    <select name="responsable_eliminacion" id="responsableEliminacion"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        <option value="">Seleccione un responsable</option>
                        <!-- Opciones se llenan por JS -->
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                        Confirmar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Botón para eliminar carpeta -->
    <form action="{{ route('carpetas.destroy', $carpeta->id) }}" method="POST" class="mt-4"
        onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta carpeta y todos sus archivos?');">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="inline-flex items-center px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
            🗑 Eliminar Carpeta
        </button>
    </form>

    <a href="{{ $carpetaPrincipal ? route('admin.carpeta', ['seccion' => $seccion, 'carpeta_id' => $carpetaPrincipal->id]) : route('archivos.index') }}"
        class="inline-flex items-center px-4 py-2 mt-3 text-white bg-gray-500 rounded-md hover:bg-gray-600">
        ⬅ Volver
    </a>
</div>
@endsection

<script>
    function openModal(idArchivo) {
        const modal = document.getElementById('modalOcultar');
        const form = document.getElementById('formOcultar');
        const idArchivoInput = document.getElementById('idArchivo');
        const responsableSelect = document.getElementById('responsableEliminacion');

        // Configurar el ID del archivo y la acción del formulario
        idArchivoInput.value = idArchivo;
        form.action = `/archivos/${idArchivo}/ocultar`;

        // Limpiar opciones previas
        responsableSelect.innerHTML = '<option value="">Seleccione un responsable</option>';

        // Cargar responsables vía AJAX
        fetch(`/archivos/${idArchivo}/responsables`)
            .then(response => response.json())
            .then(data => {
                data.forEach(responsable => {
                    const option = document.createElement('option');
                    option.value = responsable;
                    option.textContent = responsable;
                    responsableSelect.appendChild(option);
                });
            });

        // Mostrar el modal
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('modalOcultar');
        modal.classList.add('hidden');
    }
</script>