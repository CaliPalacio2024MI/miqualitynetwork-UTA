@extends('layouts.dashboard')

@section('title', 'Editar Lesión')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Editar Lesión</h2>

    <form action="{{ route('admin.lesiones.update', $lesion) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1">Nombre</label>
            <input type="text" name="nombre"
                value="{{ old('nombre', $lesion->nombre) }}"
                class="w-full border rounded px-3 py-2">
            @error('nombre')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('admin.lesiones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection