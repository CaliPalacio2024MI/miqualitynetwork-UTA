{{-- resources/views/accidentes.blade.php --}}
@extends('layouts.app')

@section('content')
<div id="mainContent" data-view="accidentes">
    <div class="grid grid-cols-2 gap-10 mt-5">

        {{-- Nuevo accidente --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-center text-xl font-bold text-blue-900 mb-4">
                Registro de Accidentes
            </h2>
            <button onclick="abrirModalAccidente()"
                class="w-full block text-center bg-blue-900 hover:bg-blue-800 text-white py-2 rounded">
                ➕ Nuevo Accidente
            </button>
        </div>

        {{-- Listado de Accidentes --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-center text-xl font-bold text-blue-900 mb-4">
                Accidentes Registrados
            </h2>
            <div class="space-y-2">
                @foreach($accidentes as $accidente)
                <div class="flex justify-between items-center border p-2 rounded">
                    <span class="text-gray-800">{{ $accidente->nombre }}</span>
                    <div class="space-x-2">

                        {{-- Ver detalle --}}
                        <a href="{{ route('accidentes.show', $accidente) }}"
                            class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">
                            👁️
                        </a>

                        {{-- Editar --}}
                        <a href="{{ route('accidentes.edit', $accidente) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                            ✏️
                        </a>

                        {{-- Eliminar --}}
                        <form action="{{ route('accidentes.destroy', $accidente) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded"
                                onclick="return confirm('¿Eliminar este accidente?')">
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

{{-- Modal de nuevo accidente --}}
<div id="modalAccidente" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-lg relative">
        <button onclick="cerrarModalAccidente()" class="absolute top-2 right-2 text-gray-500 text-xl">×</button>
        <h2 class="text-xl font-bold mb-4">Registrar Accidente</h2>
        <form id="formAccidente">
            @csrf
            <label class="block text-sm font-medium">Nombre del Accidente</label>
            <input type="text" name="nombre" id="inputAccidenteNombre" class="w-full border p-2 rounded mt-1 mb-3" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">Guardar</button>
        </form>
    </div>
</div>

{{-- Script de control --}}
<script>
function abrirModalAccidente() {
    document.getElementById("modalAccidente").classList.remove("hidden");
}

function cerrarModalAccidente() {
    document.getElementById("modalAccidente").classList.add("hidden");
    document.getElementById("formAccidente").reset();
}

document.getElementById("formAccidente").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch("{{ route('admin.accidentes.store') }}", {
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
        window.location.reload(); // actualiza la lista tras guardar
    })
    .catch(error => {
        console.error("Error al guardar accidente:", error);
    });
});
</script>
@endsection