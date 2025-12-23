@extends('layouts.dashboard')

@section('title', 'Reporte de control de energéticos')

@section('content')
@vite(['resources/css/reporte-energeticos.css'])

<div class="reporte-container">
    <div class="reporte-header">
        <h2>Reporte de Consumo Energético</h2>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('reportes') }}" class="filtros-form">
        <div class="filtros-grid">
            <div class="filtro-item">
                <label for="propiedad_id">Propiedad:</label>
                <select name="propiedad_id" id="propiedad_id">
                    <option value="">Todas</option>
                    @foreach($propiedades as $propiedad)
                        <option value="{{ $propiedad->id_propiedad }}" {{ request('propiedad_id') == $propiedad->id_propiedad ? 'selected' : '' }}>
                            {{ $propiedad->nombre_propiedad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filtro-item">
                <label for="mes">Mes:</label>
                <select name="mes" id="mes">
                    <option value="">Todos</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('mes') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->locale('es')->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="filtro-item">
                <label for="anio">Año:</label>
                <select name="anio" id="anio">
                    <option value="">Todos</option>
                    @for($i = date('Y'); $i >= 2010; $i--)
                        <option value="{{ $i }}" {{ request('anio') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="filtro-item">
                <label for="energetico_id">Tipo de Recurso:</label>
                <select name="energetico_id" id="energetico_id">
                    <option value="">Todos</option>
                    @foreach($energeticos as $energetico)
                        <option value="{{ $energetico->id }}" {{ request('energetico_id') == $energetico->id ? 'selected' : '' }}>
                            {{ $energetico->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filtro-submit">
                <button type="submit" class="btn-filtrar">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Contenido del Reporte -->
    <div class="reporte-content">
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        
        @if(empty($consumos) || count($consumos) === 0)
            <div class="alert alert-info">
                No hay datos de consumo disponibles para mostrar.
            </div>
        @else
      <!-- Bloques de energéticos -->
<div class="energeticos-container">
    <div class="energeticos-grid">
        @foreach($energeticos as $energetico)
            <div class="energetico-card">
                <div class="energetico-content">
                    <h3>{{ $energetico->nombre }}</h3>
                    
                    <!-- Lista de propiedades con su consumo -->
                    <div class="propiedades-list">
                        @foreach($propiedades as $propiedad)
                            @php
                                $consumo = $consumos->where('energetico_id', $energetico->id)
                                                   ->where('propiedad_id', $propiedad->id_propiedad)
                                                   ->sum('cantidad_utilizada');
                                $consumo = $consumo ?: 0;
                            @endphp
                            <div class="propiedad-item">
                                <span class="propiedad-nombre">{{ $propiedad->nombre_propiedad }}:</span>
                                <span class="propiedad-valor">{{ number_format($consumo, 2) }} {{ $energetico->unidad }}</span>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Total general (opcional) -->
                    <div class="total-consumo">
                        @php
                            $total = $consumos->where('energetico_id', $energetico->id)
                                            ->sum('cantidad_utilizada');
                        @endphp
                        <strong>Total:</strong> {{ number_format($total ?: 0, 2) }} {{ $energetico->unidad }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

            <!-- Tabla de Datos y Gráfica -->
            <div class="reporte-grid">
                <div class="reporte-tabla">
                    <h3>Datos del {{ $usandoFiltros ? 'Mes Seleccionado' : 'Mes Anterior' }}</h3>
                    <div class="table-responsive">
                        <table class="tabla-consumos">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Propiedad</th>
                                    <th>Recurso</th>
                                    <th>Consumo</th>
                                    <th>Costo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consumos as $consumo)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($consumo->fecha)->locale('es')->translatedFormat('d/m/Y') }}</td>
                                    <td>{{ $consumo->propiedad->nombre_propiedad }}</td>
                                    <td>{{ $consumo->energetico->nombre }}</td>
                                    <td>{{ $consumo->cantidad_utilizada }} {{ $consumo->energetico->unidad }}</td>
                                    <td>${{ number_format($consumo->costo, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="costo-total">
                        <strong>Costo Total:</strong> ${{ number_format($costoTotal, 2) }} MXN
                    </div>
                </div>

                <!-- Gráfica -->
                <div class="reporte-grafica">
                    <h3>Histograma de Consumo</h3>
                    <div class="grafica-container">
                        <canvas id="graficaConsumo"></canvas>
                    </div>
                </div>
               
            </div>
        @endif
    </div>
</div>

@if(!empty($consumos) && count($consumos) > 0)
<div id="grafica-container" 
     data-labels='@json($labels ?? [])'
     data-values='@json($values ?? [])'
     data-colores='@json($energeticos->pluck("color", "id"))'
     data-consumos='@json($consumos->groupBy("energetico_id"))'>
     
    <canvas id="graficaConsumo"></canvas>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/reporteConsumo.js') }}"></script>
@endpush
@endif

<style>
    
</style>
@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Inicializar gráfica -->
       
        
        <!-- Cargar nuestro script -->
        <script src="{{ asset('js/reportedecontroldeenergeticos.js') }}"></script>