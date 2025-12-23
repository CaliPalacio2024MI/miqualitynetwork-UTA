{{-- resources/views/modules/residuos/administracion/admin_residuos.blade.php --}}

@extends('layouts.dashboard')

@section('title', 'Gestión de Residuos')

@section('content')

    <div>
        <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
            Gestión de Residuos
        </h2>
    </div>

    <div class="flex gap-32 administrador">
        {{-- Enlace al formulario “Tipo de Residuo” --}}
        <a href="{{ route('configuracion.tipo_residuo') }}" class="administrar-btn">
            <img src="{{ asset('images/modules/residuos/tiposderesiduos.svg') }}" class="logo">
            Tipos de Residuos
        </a>

        {{-- Enlace al formulario “Área de Procedencia” --}}
        <a href="{{ route('configuracion.area_procedencia') }}" class="administrar-btn">
            <img src="{{ asset('images/modules/residuos/areas.svg') }}" class="logo">
            Área de Procedencia
        </a>
    </div>

@endsection
