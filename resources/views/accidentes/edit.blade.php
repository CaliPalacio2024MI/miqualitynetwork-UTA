@extends('layouts.dashboard')
@section('title','Editar Accidente')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Editar Accidente</h2>
    <form action="{{ route('admin.accidentes.update', $accidente) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Nombre</label>
            <input type="text" name="nombre"
                class="w-full border px-3 py-2"
                value="{{ old('nombre', $accidente->nombre) }}">
            @error('nombre')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.accidentes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection