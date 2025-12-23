{{-- resources/views/estadistico/index.blade.php --}}
@extends('modules.residuos.layouts.layout_estadistico')

@section('title', 'ESTADÍSTICO - RESIDUOS')

@push('styles')
  @vite('resources/css/modules/residuos/estadistico_barra.css')
  @vite('resources/css/modules/residuos/estadistico.css')
@endpush

@section('contenido_residuos')
  <!-- FILTROS -->
  <form action="{{ route('residuos.estadistico.index') }}" method="GET" class="filtros-container">
    <h2>Filtros:</h2>
    <div class="filtros-grid">
      <div class="filtro-item">
        <label for="tipo" class="label">Tipo de Residuo:</label>
        <select id="tipo" name="tipo" class="input">
          <option value="">Todos</option>
          @foreach($tiposResiduos as $tipo)
            <option value="{{ $tipo->nombre }}" @selected(request('tipo') == $tipo->nombre)>
              {{ $tipo->nombre }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="filtro-item">
        <label for="fecha_inicio" class="label">Fecha:</label>
        <input
          type="month"
          id="fecha_inicio"
          name="fecha_inicio"
          class="input"
          value="{{ request('fecha_inicio') }}"
        >
      </div>
    </div>
    <button type="submit" class="boton-filtros">Aplicar Filtros</button>
  </form>

  <!-- ESTADÍSTICAS: TABLA + GRÁFICA -->
  <div class="stats-wrapper">
    <!-- Tabla -->
    <div class="tabla-container">
      <table class="table">
        <thead>
          <tr>
            <th>Residuo</th>
            <th>Kg</th>
            <th>Ton</th>
            <th>Precio</th>
            <th>Compra KG</th>
            <th>PAX</th>
            <th>% Reciclado</th>
            <th>Residuo/PAX</th>
          </tr>
        </thead>
        <tbody>
          @foreach($residuosSalidas as $salida)
            <tr>
              <td>
                {{ $salida->residuo }}
                @if(isset($salida->anio) && isset($salida->mes))
                  ({{ $salida->mes }}/{{ $salida->anio }})
                @endif
              </td>
              <td>{{ number_format($salida->cantidad_kg, 2) }}</td>
              <td>{{ number_format($salida->cantidad_kg / 1000, 2) }}</td>
              <td>{{ number_format($salida->cantidad_kg * $salida->precio_kg, 2) }}</td>
              <td>{{ $salida->compra_kg ?? 0 }}</td>
              <td>{{ $salida->pax ?? 0 }}</td>
              <td>
                @if($salida->cantidad_kg > 0)
                  {{ number_format(($salida->compra_kg * 100) / $salida->cantidad_kg, 2) }}%
                @else
                  0%
                @endif
              </td>
              <td>
                @if(!empty($salida->pax) && $salida->pax != 0)
                  {{ number_format($salida->cantidad_kg / $salida->pax, 2) }}
                @else
                  0
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Gráfica -->
    <div id="chartContainer">
      <canvas id="residuosChart"></canvas>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    window._residuosData = @json($residuosSalidas);
    window._colorMapping = @json($tiposResiduos->pluck('color', 'nombre'));
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @vite('resources/js/modules/residuos/estadistico.js')
@endpush
