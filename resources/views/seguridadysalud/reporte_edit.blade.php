<form method="POST" action="{{ route('seguridadysalud.reporte.update', $registro->id) }}">
    @csrf @method('PUT')

    {{-- campos… --}}
    <div class="mb-4">
        <label>Nombre:</label>
        <input name="nombre_lesionado" value="{{ old('nombre_lesionado', $registro->nombre_lesionado) }}" class="w-full" />
    </div>
    {{-- resto de campos… --}}

    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Guardar</button>
</form>