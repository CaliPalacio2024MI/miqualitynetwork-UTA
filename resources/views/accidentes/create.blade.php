@extends('layouts.app')

@section('content')
<h1>Nuevo Accidente</h1>
<form action="{{ route('admin.accidentes.store') }}" method="POST">
    @csrf
    <label>Nombre</label>
    <input name="nombre" value="{{ old('nombre') }}">
    @error('nombre') <p class="text-red-600">{{ $message }}</p> @enderror
    <button>Guardar</button>
    <a href="{{ route('admin.accidentes.index') }}">Cancelar</a>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");

        if (!form) return;

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
            })
            .then(response => {
                if (response.redirected) {
                    // ✅ Redirige automáticamente a la vista que Laravel devuelva
                    window.location.href = response.url;
                } else {
                    return response.json();
                }
            })
            .catch(error => {
                console.error("❌ Error al guardar:", error);
            });
        });
    });
</script>

@endsection