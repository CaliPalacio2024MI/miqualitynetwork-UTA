{{-- resources/views/configuracion/compras.blade.php --}}
@extends('modules.residuos.layouts.layout_residuos')

@section('title', 'CAPTURA - COMPRAS')

@push('styles')
  {{-- CSS específico de Compras --}}
  @vite('resources/css/modules/residuos/compras.css')
@endpush

@section('contenido_residuos')
  <form action="{{ route('configuracion.compras.index') }}" method="GET" class="filtros-form">
    <div class="filtros-container">
      <h2 class="subtitulo">Filtros:</h2>
      <div class="filtros-grid">
        <div class="filtro-item">
          <label for="tipo_filtro" class="label">Tipo de Residuo:</label>
          <select id="tipo_filtro" name="tipo_filtro" class="input">
            <option value="">Todos</option>
            @foreach($tipos as $tipoRes)
              <option value="{{ $tipoRes->id }}"
                {{ request('tipo_filtro') == $tipoRes->id ? 'selected' : '' }}>
                {{ $tipoRes->nombre }}
              </option>
            @endforeach
          </select>
        </div>
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

  <div class="compras-wrapper">
    <div class="compras-form-left">
      <div class="formulario-container">
        <h1 class="titulo">Registro de Compras</h1>

        @if(session('success'))
          <div class="cuadro cuadro--success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="cuadro cuadro--error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('configuracion.agregarCompra') }}" method="POST" id="compras-form">
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

            <div class="form-group">
              <label for="tipo_residuo_id" class="label">Tipo de Residuo:</label>
              <select id="tipo_residuo_id"
                      name="tipo_residuo_id"
                      required
                      class="input">
                <option value="">Seleccione un tipo de residuo</option>
                @foreach($tipos as $tipo)
                  <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="compra_kg" class="label">Compra (kg):</label>
              <input type="number"
                     id="compra_kg"
                     name="compra_kg"
                     step="0.01"
                     required
                     class="input">
            </div>
          </div>

          <div class="form-buttons">
            <button type="submit" class="boton">Agregar Compra</button>
          </div>
        </form>
      </div>
    </div>

    <div class="compras-form-right">
      <h2 class="titulo">Lista de Compras Registradas</h2>
      <div class="tabla-container table-centered">
        <table class="table compras-table">
          <thead>
            <tr>
              <th>Fecha Inicio</th>
              <th>Tipo de Residuo</th>
              <th>Compra (kg)</th>
            </tr>
          </thead>
          <tbody>
            @foreach($compras as $compra)
              <tr>
                <td>{{ $compra->fecha_inicio }}</td>
                <td>{{ optional($compra->tipo_residuo)->nombre }}</td>
                <td>{{ $compra->compra_kg }}</td>
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
  {{-- JS específico de Compras --}}
  @vite('resources/js/modules/residuos/compras.js')
@endpush
