{{-- resources/views/entradas.blade.php --}}
@extends('modules.residuos.layouts.layout_residuos')

@section('title', 'CAPTURA - ENTRADAS')

@push('styles')
  {{-- CSS específico de la sección “Entradas” --}}
  @vite('resources/css/modules/residuos/entradas.css')
@endpush

@section('contenido_residuos')
  <!-- 1) APARTADO DE FILTROS (GET) -->
  <form action="{{ route('entradas.index') }}" method="GET" class="filtros-form">
      <div class="filtros-container">
          <h2 class="subtitulo">Filtros:</h2>
          <div class="filtros-grid">
              <!-- Tipo de Residuo -->
              <div class="filtro-item">
                  <label for="tipo_filtro" class="label">Tipo de Residuo:</label>
                  <select id="tipo_filtro" name="tipo_filtro" class="input">
                      <option value="">Todos</option>
                      @foreach($tipos as $tipo)
                          <option value="{{ $tipo->id }}"
                                  @if(request('tipo_filtro') == $tipo->id) selected @endif>
                              {{ $tipo->nombre }}
                          </option>
                      @endforeach
                  </select>
              </div>
              <!-- Fecha Inicio -->
              <div class="filtro-item">
                  <label for="fecha_inicio_filtro" class="label">Fecha Inicio:</label>
                  <input type="date"
                         id="fecha_inicio_filtro"
                         name="fecha_inicio_filtro"
                         class="input"
                         value="{{ request('fecha_inicio_filtro') }}">
              </div>
              <!-- Fecha Fin -->
              <div class="filtro-item">
                  <label for="fecha_fin_filtro" class="label">Fecha Fin:</label>
                  <input type="date"
                         id="fecha_fin_filtro"
                         name="fecha_fin_filtro"
                         class="input"
                         value="{{ request('fecha_fin_filtro') }}">
              </div>
              <!-- Botón para Aplicar Filtros -->
              <div class="filtro-item filtro-item--button">
                  <button type="submit" class="boton">Aplicar Filtros</button>
              </div>
          </div>
      </div>
  </form>

  <form action="{{ route('entradas.store') }}" method="POST" class="entrada-form">
      @csrf

      <div class="entrada-form__left">
          <div class="formulario-container">
              <h1 class="titulo">Registrar Entrada de Residuos</h1>

              @if(session('success'))
                  <div class="cuadro cuadro--success">
                      {{ session('success') }}
                  </div>
              @endif

              <div class="grid-2">
                  <!-- Fecha de Entrada -->
                  <div class="form-group">
                      <label for="fecha_entrada" class="label">Fecha de Entrada:</label>
                      <input type="date"
                             id="fecha_entrada"
                             name="fecha_entrada"
                             class="input"
                             required>
                  </div>
                  <!-- Tipo de Residuo -->
                  <div class="form-group">
                      <label for="tipo_residuo_id" class="label">Tipo de Residuo:</label>
                      <select id="tipo_residuo_id"
                              name="tipo_residuo_id"
                              class="input"
                              required>
                          <option value="">Seleccione un tipo de residuo</option>
                          @foreach($tipos as $tipo)
                              <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                  <!-- Área de Procedencia -->
                  <div class="form-group">
                      <label for="area_procedencia_id" class="label">Área de Procedencia:</label>
                      <select id="area_procedencia_id"
                              name="area_procedencia_id"
                              class="input"
                              required>
                          <option value="">Seleccione un área de procedencia</option>
                          @foreach($areas as $area)
                              <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                  <!-- Cantidad (kg) -->
                  <div class="form-group">
                      <label for="cantidad_kg" class="label">Cantidad (kg):</label>
                      <input type="number"
                             id="cantidad_kg"
                             name="cantidad_kg"
                             step="0.01"
                             class="input"
                             required>
                  </div>
                  <!-- Observaciones -->
                  <div class="form-group">
                      <label for="observaciones" class="label">Observaciones:</label>
                      <textarea id="observaciones"
                                name="observaciones"
                                class="input"
                                rows="3"></textarea>
                  </div>
              </div>

              <div class="form-buttons">
                  <button type="submit" class="boton">Guardar Entrada</button>
              </div>
          </div>
      </div>

      <div class="entrada-form__right">
          <h2 class="titulo">Lista de Entradas Registradas</h2>
          <div class="tabla-container entradas-tabla">
              <table class="table entradas-table">
                  <thead>
                      <tr>
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

      <div class="clearfix"></div>
  </form>
@endsection

@push('scripts')
  {{-- JS específico de Entradas --}}
  @vite('resources/js/modules/residuos/entradas.js')
@endpush
