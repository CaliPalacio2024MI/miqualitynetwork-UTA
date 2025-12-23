{{-- resources/views/modules/residuos/layouts/layout_estadistico.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Reporte de residuos')

@push('styles')
  @vite('resources/css/modules/residuos/estadistico_barra.css')
@endpush

@push('scripts')
  @vite('resources/js/modules/residuos/estadistico.js')
@endpush

@section('content')
  {{-- Barra personalizada de la sección Estadístico --}}
  @include('modules.residuos.layouts.barra_estadistico')

  {{-- Contenido dinámico de la sección --}}
  <div class="container px-4" style="margin-top: 1px;">
    @yield('contenido_residuos')
  </div>
@endsection