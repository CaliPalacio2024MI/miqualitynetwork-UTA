@extends('layouts.dashboard')

@section('title', 'Control de residuos')

@push('styles')
    @vite(['resources/css/modules/residuos/app.css'])
@endpush

@push('scripts')
    @vite(['resources/js/modules/residuos/app.js'])
@endpush

@section('content')

    {{-- Barra azul superior con navegación del micrositio --}}
    @include('modules.residuos.layouts.barra_residuos')

    <div style="margin-top: 80px;">
        <h1 class="text-2xl font-bold">Control de residuos</h1>
        <p>Contenido específico sobre Control de residuos.</p>
    </div>
    
@endsection
