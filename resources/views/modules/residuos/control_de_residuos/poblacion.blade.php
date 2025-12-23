{{-- resources/views/configuracion/poblacion.blade.php --}}
@extends('modules.residuos.layouts.layout_residuos')

@section('title', 'CAPTURA - POBLACIÓN')

@push('styles')
  {{-- CSS específico de Población --}}
  @vite('resources/css/modules/residuos/poblacion.css')
@endpush

@section('contenido_residuos')
  <form action="{{ route('configuracion.poblacion.index') }}" method="GET" class="filtros-form">
    <div class="filtros-container">
      <h2 class="subtitulo">Filtros:</h2>
      <div class="filtros-grid">
        <div class="filtro-item">
          <label for="fecha_inicio_filtro" class="label">Fecha Inicio:</label>
          <input type="date"
                 id="fecha_inicio_filtro"
                 name="fecha_inicio_filtro"
                 value="{{ request('fecha_inicio_filtro') }}"
                 class="input">
        </div>
        <div class="filtro-item">
          <label for="fecha_fin_filtro" class="label">Fecha Fin:</label>
          <input type="date"
                 id="fecha_fin_filtro"
                 name="fecha_fin_filtro"
                 value="{{ request('fecha_fin_filtro') }}"
                 class="input">
        </div>
        <div class="filtro-item filtro-item--button">
          <button type="submit" class="boton">Aplicar Filtros</button>
        </div>
      </div>
    </div>
  </form>

  <!-- 2) FORMULARIO / TABLA -->
  <div class="poblacion-wrapper">
    <div class="poblacion-form-left">
      <div class="formulario-container">
        <h1 class="titulo">Registro de Población</h1>

        @if(session('success'))
          <div class="cuadro cuadro--success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="cuadro cuadro--error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('configuracion.poblacion.store') }}" method="POST" id="poblacion-form">
          @csrf
          <div class="grid-2">
            <!-- Selector Mes/Año -->
            <div class="form-group">
              <label for="mes_anio" class="label">Mes y Año:</label>
              <input type="month"
                     id="mes_anio"
                     name="mes_anio"
                     required
                     class="input">
            </div>

            <!-- Campos de conteo -->
            <div class="form-group">
              <label for="huespedes" class="label">Cantidad de Huéspedes:</label>
              <input type="number" id="huespedes" name="huespedes" required class="input">
            </div>
            <div class="form-group">
              <label for="anfitriones" class="label">Cantidad de Anfitriones:</label>
              <input type="number" id="anfitriones" name="anfitriones" required class="input">
            </div>
            <div class="form-group">
              <label for="visitantes" class="label">Cantidad de Visitantes:</label>
              <input type="number" id="visitantes" name="visitantes" required class="input">
            </div>
            <div class="form-group">
              <label for="probedores" class="label">Cantidad de Proveedores:</label>
              <input type="number" id="probedores" name="probedores" required class="input">
            </div>
          </div>

          <div class="form-buttons">
            <button type="submit" class="boton">Agregar Registro</button>
          </div>
        </form>
      </div>
    </div>

    <div class="poblacion-form-right">
      <h2 class="titulo">Lista de Registros de Población</h2>
      <div class="tabla-container table-centered">
        <table class="table poblacion-table">
          <thead>
            <tr>
              <th>Fecha Inicio</th>
              <th>Huéspedes</th>
              <th>Anfitriones</th>
              <th>Visitantes</th>
              <th>Proveedores</th>
              <th>PAX</th>
            </tr>
          </thead>
          <tbody>
            @foreach($poblaciones as $p)
              <tr>
                <td>{{ $p->fecha_inicio }}</td>
                <td>{{ $p->huespedes }}</td>
                <td>{{ $p->anfitriones }}</td>
                <td>{{ $p->visitantes }}</td>
                <td>{{ $p->probedores }}</td>
                <td>{{ $p->pax }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="clearfix"></div>
  </div>
@endsection

@push('scripts')
  {{-- JS específico de Población --}}
  @vite('resources/js/modules/residuos/poblacion.js')
@endpush
