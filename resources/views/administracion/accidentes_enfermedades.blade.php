@extends('layouts.dashboard')

@section('title', 'Accidentes y Enfermedades')

@section('content')
<div class="titulo">
    <div class="titulo-fondo">
        <h2 class="titulo-usuario">Módulo de Accidentes y Enfermedades</h2>
    </div>
</div>

<div class="botonesadmin">
    {{-- Botón Accidentes --}}
    <div class="administrador">
        <a href="{{ route('admin.accidentes.index') }}" class="administrar-btn">
            <img src="{{ asset('images/iconos/accidente.png') }}" class="logo" alt="">
            Accidentes
        </a>
    </div>

    {{-- Botón Lesiones --}}
    <div class="administrador">
        <a href="{{ route('admin.lesiones.index') }}" class="administrar-btn">
            <img src="{{ asset('images/iconos/lesion.png') }}" class="logo" alt="">
            Lesiones
        </a>
    </div>

    {{-- Botón Casos --}}
    <div class="administrador">
        <a href="{{ route('admin.causas.index') }}" class="administrar-btn">
            <img src="{{ asset('images/iconos/caso.png') }}" class="logo" alt="">
            Casos
        </a>
    </div>
</div>
@endsection
