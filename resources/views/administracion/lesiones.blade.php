@extends('layouts.app')

@section('content')
<div id="mainContent" data-view="lesiones">
    <div class="grid grid-cols-2 gap-10 mt-5">

        {{-- ► Nuevo registro --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-center text-xl font-bold text-blue-900 mb-4">
                Registro de Lesiones
            </h2>
            <button onclick="abrirModalLesion()"
                class="w-full block text-center bg-blue-900 hover:bg-blue-800 text-white py-2 rounded">
                ➕ Nueva Lesión
            </button>
        </div>

        {{-- ► Listado de Lesiones --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-center text-xl font-bold text-blue-900 mb-4">
                Lesiones Registradas
            </h2>
            <div class="space-y-2">
                @foreach($lesiones as $lesion)
                    <div class="flex justify-between items-center border rounded p-2">
                        <span>{{ $lesion->nombre }}</span>
                        <div class="space-x-1">
                            {{-- Ver detalles --}}
                            <a href="{{ route('admin.lesiones.show', $lesion) }}"
                               class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">
                               👁️
                            </a>
                            {{-- Editar --}}
                            <a href="{{ route('admin.lesiones.edit', $lesion) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                               ✏️
                            </a>
                            {{-- Eliminar --}}
                            <form action="{{ route('admin.lesiones.destroy', $lesion) }}"
                                  method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

{{-- Modal de nueva lesión --}}
<div id="modalLesion"
     class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-lg relative">
        <button onclick="cerrarModalLesion()"
                class="absolute top-2 right-2 text-gray-500 text-xl">×</button>
        <h2 class="text-xl font-bold mb-4">Registrar Lesión</h2>
        <form id="formLesion">
            @csrf
            <label class="block text-sm font-medium">Nombre de la Lesión</label>
            <input type="text" name="nombre" id="inputLesionNombre"
                   class="w-full border p-2 rounded mt-1 mb-3" required>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
                Guardar
            </button>
        </form>
    </div>
</div>

{{-- Script JS para el modal y el POST --}}
<script>
function abrirModalLesion() {
    document.getElementById("modalLesion").classList.remove("hidden");
}
function cerrarModalLesion() {
    document.getElementById("modalLesion").classList.add("hidden");
    document.getElementById("formLesion").reset();
}

document.getElementById("formLesion").addEventListener("submit", function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    fetch('/admin/lesiones', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
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
        console.error("Error al guardar lesión:", error);
    });
});
</script>
@endsection
