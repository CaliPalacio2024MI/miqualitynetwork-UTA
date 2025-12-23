@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow p-6 rounded mt-10">
    <h1 class="text-xl font-bold text-blue-900 mb-4">Editar Causa</h1>

    <form action="{{ route('causas.update', $causa) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nombre de la Causa</label>
            <input type="text" name="nombre" value="{{ old('nombre', $causa->nombre) }}"
                class="w-full border p-2 rounded mt-1" required>
            @error('nombre')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.causas.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>
@endsection