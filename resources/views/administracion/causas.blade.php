{{-- resources/views/administracion/causas.blade.php --}}
@extends('layouts.app')

@section('content')
    <div id="mainContent" data-view="causas">
        <div class="grid grid-cols-2 gap-10 mt-5">

            {{-- Nueva causa --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-center text-xl font-bold text-blue-900 mb-4">
                    Registro de Causas
                </h2>
                <button onclick="abrirModalCausa()"
                    class="w-full block text-center bg-blue-900 hover:bg-blue-800 text-white py-2 rounded">
                    ➕ Nueva Causa
                </button>
            </div>

            {{-- Listado --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-center text-xl font-bold text-blue-900 mb-4">
                    Causas Registradas
                </h2>
                <div class="space-y-2">
                    @foreach($causas as $causa)
                    <div class="flex justify-between items-center border p-2 rounded">
                        <span class="text-gray-800">{{ $causa->nombre }}</span>
                        <div class="space-x-2">
                            <a href="{{ route('causas.show', $causa) }}"
                                class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">👁️</a>
                            <a href="{{ route('causas.edit', $causa) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">✏️</a>
                            <form action="{{ route('causas.destroy', $causa) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded"
                                    onclick="return confirm('¿Eliminar esta causa?')">
                                    ✖
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modalCausa" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-lg relative">
            <button onclick="cerrarModalCausa()" class="absolute top-2 right-2 text-gray-500 text-xl">×</button>
            <h2 class="text-xl font-bold mb-4">Registrar Causa</h2>
            <form id="formCausa">
                @csrf
                <label class="block text-sm font-medium">Nombre de la Causa</label>
                <input type="text" name="nombre" id="inputCausaNombre" class="w-full border p-2 rounded mt-1 mb-3" required>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">Guardar</button>
            </form>
        </div>
    </div>

    <script>
        function abrirModalCausa() {
            document.getElementById("modalCausa").classList.remove("hidden");
        }
        function cerrarModalCausa() {
            document.getElementById("modalCausa").classList.add("hidden");
            document.getElementById("formCausa").reset();
        }
        document.getElementById("formCausa").addEventListener("submit", function (e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            fetch("{{ route('admin.causas.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').content,
                    "Accept": "application/json"
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    return response.json();
                }
            })
            .then(data => {
                window.location.reload();
            })
            .catch(error => {
                console.error("Error al guardar causa:", error);
            });
        });
    </script>
@endsection