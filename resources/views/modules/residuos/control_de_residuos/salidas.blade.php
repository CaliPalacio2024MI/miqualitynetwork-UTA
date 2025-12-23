{{-- resources/views/salidas.blade.php --}}
@extends('modules.residuos.layouts.layout_residuos')

@section('title', 'CAPTURA - SALIDAS')

@push('styles')
  {{-- CSS específico de la sección “Salidas” --}}
  @vite('resources/css/modules/residuos/salidas.css')
@endpush

@push('scripts')
  {{-- JS específico de la sección “Salidas” --}}
  @vite('resources/js/modules/residuos/salidas.js')
@endpush

@section('contenido_residuos')
  <form action="{{ route('salidas.create') }}" method="GET" class="filtros-form">
    <div class="filtros-container">
      <h2 class="subtitulo">Filtros:</h2>
      <div class="filtros-grid">
        <div class="filtro-item">
          <label for="tipo_filtro" class="label">Tipo de Residuo:</label>
          <select id="tipo_filtro" name="tipo_filtro" class="input">
            <option value="">Todos</option>
            @foreach($tiposPosibles as $tipoItem)
              <option value="{{ $tipoItem->id }}"
                      @if(request('tipo_filtro') == $tipoItem->id) selected @endif>
                {{ $tipoItem->nombre }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="filtro-item">
          <label for="fecha_inicio_filtro" class="label">Fecha Inicio:</label>
          <input type="date"
                 id="fecha_inicio_filtro"
                 name="fecha_inicio_filtro"
                 class="input"
                 value="{{ request('fecha_inicio_filtro') }}">
        </div>
        <div class="filtro-item">
          <label for="fecha_fin_filtro" class="label">Fecha Fin:</label>
          <input type="date"
                 id="fecha_fin_filtro"
                 name="fecha_fin_filtro"
                 class="input"
                 value="{{ request('fecha_fin_filtro') }}">
        </div>
        <div class="filtro-item filtro-item--button">
          <button type="submit" class="boton">Aplicar Filtros</button>
        </div>
      </div>
    </div>
  </form>

  <form action="{{ route('salidas.store') }}" method="POST" class="salida-form">
    @csrf

    <div class="salida-form__left">
      <h2 class="titulo">Lista de Entradas Registradas</h2>
      @if(session('success'))
        <div class="cuadro cuadro--success">{{ session('success') }}</div>
      @endif

      <div class="tabla-container">
        <table class="table salidas-table">
          <thead>
            <tr>
              <th>Sel.</th>
              <th>Fecha de Entrada</th>
              <th>Tipo de Residuo</th>
              <th>Área de Procedencia</th>
              <th>Cantidad (kg)</th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($entradas as $entrada)
              <tr>
                <td>
                  <input type="checkbox"
                         name="entrada_id[]"
                         value="{{ $entrada->id }}"
                         onchange="toggleRow(this)">
                </td>
                <td>{{ $entrada->fecha_entrada }}</td>
                <td>{{ optional($entrada->tipoResiduo)->nombre }}</td>
                <td>{{ optional($entrada->areaProcedencia)->nombre }}</td>
                <td>{{ $entrada->cantidad_kg }}</td>
                <td>{{ $entrada->observaciones }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="salida-form__right">
      <div class="formulario-container">
        <h1 class="titulo">Registrar Salida de Residuos</h1>

        <div class="grid-2">
          <div class="form-group">
            <label for="fecha_salida" class="label">Fecha de Salida:</label>
            <input type="date" id="fecha_salida" name="fecha_salida" class="input" required>
          </div>
          <div class="form-group">
            <label for="quien_se_lo_lleva" class="label">Proveedor:</label>
            <input type="text" id="quien_se_lo_lleva" name="quien_se_lo_lleva" class="input" required>
          </div>
          <div class="form-group">
            <label for="testigo" class="label">Testigo:</label>
            <input type="text" id="testigo" name="testigo" class="input">
          </div>
          <div></div>
        </div>

        <div class="form-buttons">
          <button type="submit" class="boton">Guardar Salida</button>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
  </form>

  <script>
    function toggleRow(checkbox) {
      if (checkbox.checked) {
        checkbox.closest('tr').classList.add('selected');
      } else {
        checkbox.closest('tr').classList.remove('selected');
      }
    }
  </script>
@endsection
