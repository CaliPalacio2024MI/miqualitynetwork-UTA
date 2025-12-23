@extends('layouts.dashboard')

@section('title', 'Ver Lesión')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Lesión: {{ $lesion->nombre }}</h2>
    <p><strong>ID:</strong> {{ $lesion->id }}</p>
    <p><strong>Nombre:</strong> {{ $lesion->nombre }}</p>

    <div class="mt-4 space-x-4">
        <a href="{{ route('admin.lesiones.edit', $lesion) }}"
            class="btn btn-warning">Editar</a>
        <form action="{{ route('admin.lesiones.destroy', $lesion) }}"
            method="POST" class="inline-block"
            onsubmit="return confirm('¿Eliminar esta lesión?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Eliminar</button>
        </form>
        <a href="{{ route('admin.lesiones.index') }}"
            class="btn btn-secondary">Volver al listado</a>
    </div>
</div>
@endsection