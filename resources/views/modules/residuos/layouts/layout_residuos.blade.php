@extends('layouts.dashboard')

@section('title', 'Control de residuos')

@section('styles_residuos_directo')
  <link rel="stylesheet" href="{{ Vite::asset('resources/css/modules/residuos/app.css') }}">
@endsection

@push('scripts')
  @vite('resources/js/modules/residuos/app.js')
@endpush

@section('content')
  {{-- CORREGIR ESPACIO --}}
  <div style="margin-top: -1.5rem; margin-left: -1.5rem; margin-right: -1.5rem; width: calc(100% + 3rem);">
    @include('modules.residuos.layouts.barra_residuos')
  </div>

  {{-- CONTENIDO DE CADA VISTA DE RESIDUOS --}}
  <div class="container px-4" style="margin-top: 25px;">
    @yield('contenido_residuos')
  </div>
@endsection
