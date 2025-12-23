@extends('layouts.dashboard')

@section('title', 'Administración de Racks de Habitaciones')

@section('content')

    <div>
        <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
            Administración de Racks de Habitaciones
        </h2>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class = "administrador">
            <a href="{{ route('bcp.admin.centros_consumo') }}" class = "administrar-btn"><img
                    src="{{ asset('images/modules/bcp/centros.svg') }}" class="logo">Centros de Consumo</a>
        </div>
        <div class = "administrador">
            <a href="{{ route('bcp.admin.catalogo') }}" class = "administrar-btn"><img src="{{ asset('images//modules/bcp/catalogo.svg') }}"
                    class="logo">Catálogo de habitaciones </a>
        </div>
        <div class = "administrador">
            <a href="{{ route('bcp.admin.tipos_status') }}" class = "administrar-btn"><img
                    src="{{ asset('images/modules/bcp/status.svg') }}" class="logo">Tipos de Status</a>
        </div>

    </div>



@endsection
