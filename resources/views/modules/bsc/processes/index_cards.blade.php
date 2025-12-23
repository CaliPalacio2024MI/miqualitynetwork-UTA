@extends('layouts.dashboard')


@section('title', 'Gestión de Procesos por Propiedad')

@vite([
    'resources/css/modules/bsc/procesos_cards.css',
    
    'resources/js/modules/bsc/procesos.js',
    'resources/js/modules/bsc/procesos_cards.js',
])

<nav class="navbar">
        @include('modules.bsc.layout.app')
</nav>

@section('content')
<div x-data="{ 
    open: localStorage.getItem('sidebar') === 'true',
    currentView: 'propiedades',
    selectedPropiedad: null,
    selectedProcess: null,
    selectedSubprocess: null
}" class="flex h-screen bg-gray-100">
    
    <div class="flex-1 overflow-auto">
        <div class="container-fluid px-4">
            <!-- Breadcrumb de navegación -->
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <template x-if="currentView === 'propiedades'">
                        <li class="inline-flex items-center">
                            <span class="inline-flex items-center text-sm font-medium text-gray-700">
                                <i class="fas fa-building mr-2"></i> Todas las Propiedades
                            </span>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'processes'">
                        <li class="inline-flex items-center">
                            <button @click="currentView = 'propiedades'; selectedPropiedad = null" 
                                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                <i class="fas fa-building mr-2"></i> Todas las Propiedades
                            </button>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'processes'">
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">
                                    <i class="fas fa-box-open mr-2"></i>
                                    <span x-text="selectedPropiedad.nombre_propiedad"></span>
                                </span>
                            </div>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'subprocesses'">
                        <li class="inline-flex items-center">
                            <button @click="currentView = 'propiedades'; selectedPropiedad = null" 
                                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                <i class="fas fa-building mr-2"></i> Todas las Propiedades
                            </button>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'subprocesses'">
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <button @click="currentView = 'processes'; selectedProcess = null" 
                                        class="ml-1 text-sm font-medium text-blue-600 hover:text-blue-800 md:ml-2">
                                    <i class="fas fa-box-open mr-2"></i>
                                    <span x-text="selectedPropiedad.nombre_propiedad"></span>
                                </button>
                            </div>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'subprocesses'">
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">
                                    <i class="fas fa-cogs mr-2"></i>
                                    <span x-text="selectedProcess.name"></span>
                                </span>
                            </div>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'indicators'">
                        <li class="inline-flex items-center">
                            <button @click="currentView = 'propiedades'; selectedPropiedad = null" 
                                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                <i class="fas fa-building mr-2"></i> Todas las Propiedades
                            </button>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'indicators'">
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <button @click="currentView = 'processes'; selectedProcess = null" 
                                        class="ml-1 text-sm font-medium text-blue-600 hover:text-blue-800 md:ml-2">
                                    <i class="fas fa-box-open mr-2"></i>
                                    <span x-text="selectedPropiedad.nombre_propiedad"></span>
                                </button>
                            </div>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'indicators'">
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <button @click="currentView = 'subprocesses'; selectedSubprocess = null" 
                                        class="ml-1 text-sm font-medium text-blue-600 hover:text-blue-800 md:ml-2">
                                    <i class="fas fa-cogs mr-2"></i>
                                    <span x-text="selectedProcess.name"></span>
                                </button>
                            </div>
                        </li>
                    </template>
                    
                    <template x-if="currentView === 'indicators'">
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">
                                    <i class="fas fa-chart-line mr-2"></i>
                                    <span x-text="selectedSubprocess.name"></span>
                                </span>
                            </div>
                        </li>
                    </template>
                </ol>
            </nav>

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" x-text="
                    currentView === 'propiedades' ? 'Gestión por Propiedad' : 
                    currentView === 'processes' ? 'Procesos de ' + selectedPropiedad.nombre_propiedad : 
                    currentView === 'subprocesses' ? 'Departamentos de ' + selectedProcess.name : 
                    'Indicadores de ' + selectedSubprocess.name
                "></h1>
                
                <div>
                
                    @can('create_process')
                    <button class="btn btn-primary"  
                            @click="currentView === 'propiedades' ? openPropertyForm() : 
                                    currentView === 'processes' ? openCreateForm(selectedPropiedad.id_propiedad) : 
                                    currentView === 'subprocesses' ? openCreateSubprocessForm(selectedProcess.id) : 
                                    openCreateIndicatorForm(selectedSubprocess.id)">
                        <i class="fas fa-plus-circle mr-2"></i> 
                        <span x-text="
                            currentView === 'propiedades' ? 'Nueva Propiedad' : 
                            currentView === 'processes' ? 'Nuevo Proceso' : 
                            currentView === 'subprocesses' ? 'Nuevo Departamento' : 
                            'Nuevo Indicador'
                        "></span>
                    </button>
                    @endcan
                                        
                    <template x-if="currentView !== 'propiedades'">
                        <button @click="
                            if (currentView === 'indicators') {
                                currentView = 'subprocesses';
                                selectedSubprocess = null;
                            } else if (currentView === 'subprocesses') {
                                currentView = 'processes';
                                selectedProcess = null;
                            } else if (currentView === 'processes') {
                                currentView = 'propiedades';
                                selectedPropiedad = null;
                            }
                        " class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left mr-2"></i> Volver
                        </button>
                    </template>
                </div>
            </div>
           
            <!-- Vista de Propiedades -->
            
            <div x-show="currentView === 'propiedades'" class="grid-container">
                @foreach($propiedades as $propiedad)
                    <div class="propiedad-card" 
                         @click="currentView = 'processes'; selectedPropiedad = {{ json_encode($propiedad->only(['id_propiedad', 'nombre_propiedad'])) }}">
                        <div class="card-header">
                            <i class="fas fa-building fa-2x mb-3"></i>
                            <h3>{{ $propiedad->nombre_propiedad }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <div class="stat">
                                    <i class="fas fa-box-open"></i>
                                    <span>{{ $propiedad->processes->count() }} Procesos</span>
                                </div>
                                <div class="stat">
                                    <i class="fas fa-cogs"></i>
                                    <span>{{ $propiedad->processes->sum(fn($p) => $p->subprocesses->count()) }} Subprocesos</span>
                                </div>
                                <div class="stat">
                                    <i class="fas fa-chart-line"></i>
                                    <span>{{ $propiedad->processes->sum(fn($p) => $p->subprocesses->sum(fn($sp) => $sp->indicators->count())) }} Indicadores</span>
                                </div>
                            </div>
                            <div class="mini-chart-container">
                                <canvas class="propiedad-chart" 
                                        data-propiedad-id="{{ $propiedad->id_propiedad }}"
                                        data-processes="{{ json_encode($propiedad->processes) }}"
                                        x-init="setTimeout(() => { loadPropiedadCharts($el) }, 200)"></canvas>
                            </div>
                            <div class="average-values">
                                <div class="average-value">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Promedio: <span class="propiedad-average-value" data-propiedad-id="{{ $propiedad->id_propiedad }}">0%</span></span>
                                </div>
                                <div class="average-value">
                                    <i class="fas fa-bullseye"></i>
                                    <span>Meta: <span class="propiedad-expected-value" data-propiedad-id="{{ $propiedad->id_propiedad }}">0%</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
      
            
            <!-- Vista de Procesos -->
            <div x-show="currentView === 'processes'" class="grid-container">
                <template x-if="selectedPropiedad">
                    <template x-for="process in {{ json_encode($propiedades->flatMap->processes) }}.filter(p => p.id_propiedad === selectedPropiedad.id_propiedad)" 
                            :key="process.id">
                        <div class="process-card" 
                            @click="currentView = 'subprocesses'; selectedProcess = process">
                            <div class="card-header">
                                <i class="fas fa-box-open fa-2x mb-3"></i>
                                <h3 x-text="process.name"></h3>
                            </div>
                            <div class="card-body">
                                <div class="stats">
                                    <div class="stat">
                                        <i class="fas fa-cogs"></i>
                                        <span x-text="process.subprocesses.length + ' Subprocesos'"></span>
                                    </div>
                                    <div class="stat">
                                        <i class="fas fa-chart-line"></i>
                                        <span x-text="process.subprocesses.reduce((acc, sp) => acc + sp.indicators.length, 0) + ' Indicadores'"></span>
                                    </div>
                                </div>
                                <div class="mini-chart-container">
                                    <canvas class="process-chart" 
                                            :data-process-id="process.id"
                                            :data-subprocesses="JSON.stringify(process.subprocesses)"
                                            x-init="setTimeout(() => { loadProcessCharts($el) }, 200)"></canvas>
                                </div>
                                <div class="average-values">
                                    <div class="average-value">
                                        <i class="fas fa-chart-line"></i>
                                        <span>Promedio: <span class="process-average-value" :data-process-id="process.id">0%</span></span>
                                    </div>
                                    <div class="average-value">
                                        <i class="fas fa-bullseye"></i>
                                        <span>Meta: <span class="process-expected-value" :data-process-id="process.id">0%</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actions">
                                @can('edit_process')
                                <button class="material-icons btn-action edit" 
                                        @click.stop="openEditForm(process.id)">
                                    <i>edit_square</i>
                                </button>
                                @endcan
                                
                                @can('delete_process')
                                <button class="material-icons btn-action delete" 
                                        @click.stop="deleteProcess(process.id)">
                                    <i>backspace</i>
                                </button>
                                @endcan
                            </div>
                        </div>
                    </template>
                </template>
            </div>

           <!-- Vista de Subprocesos -->
            <div x-show="currentView === 'subprocesses'" class="grid-container">
                <template x-if="selectedProcess">
                    <template x-for="subprocess in {{ json_encode($processes->flatMap->subprocesses) }}.filter(sp => sp.process_id === selectedProcess.id)" 
                            :key="subprocess.id">
                        <div class="subprocess-card" 
                            @click="currentView = 'indicators'; selectedSubprocess = subprocess">
                            <div class="card-header">
                                <i class="fas fa-cogs fa-2x mb-3"></i>
                                <h3 x-text="subprocess.name"></h3>
                            </div>
                            <div class="card-body">
                                <div class="stats">
                                    <div class="stat">
                                        <i class="fas fa-chart-line"></i>
                                        <span x-text="subprocess.indicators.length + ' Indicadores'"></span>
                                    </div>
                                </div>
                                <div class="mini-chart-container">
                                    <canvas class="subprocess-chart" 
                                            :data-subprocess-id="subprocess.id"
                                            :data-indicators="JSON.stringify(subprocess.indicators)"
                                            x-init="setTimeout(() => { loadSubprocessCharts($el) }, 100)"></canvas>
                                </div>
                                <div class="average-values">
                                    <div class="average-value">
                                        <i class="fas fa-chart-line"></i>
                                        <span>Promedio: <span class="subprocess-average-value" :data-subprocess-id="subprocess.id">0%</span></span>
                                    </div>
                                    <div class="average-value">
                                        <i class="fas fa-bullseye"></i>
                                        <span>Meta: <span class="subprocess-expected-value" :data-subprocess-id="subprocess.id">0%</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actions">
                                @can('edit_process')
                                <button class="material-icons btn-action edit" 
                                        @click.stop="openEditSubprocessForm(subprocess.id)">
                                    <i >edit_square</i>
                                </button>
                                @endcan
                                
                                @can('delete_process')
                                <button class="material-icons btn-action delete" 
                                        @click.stop="deleteSubprocess(subprocess.id)">
                                    <i >backspace</i>
                                </button>
                                @endcan
                            </div>
                        </div>
                    </template>
                </template>
            </div>

       
            <!-- Vista de Indicadores -->
            <div x-show="currentView === 'indicators'" class="grid-container">
                <template x-if="selectedSubprocess">
                    <template x-for="indicator in {{ json_encode(
                        $processes->flatMap(function($p) { 
                            return $p->subprocesses->flatMap(function($sp) {
                                return $sp->indicators;
                            }); 
                        })
                    ) }}.filter(i => i.subprocess_id === selectedSubprocess.id)" 
                            :key="indicator.id">
                        <div class="indicator-card">
                            <div class="card-header">
                                <i class="fas fa-chart-line fa-2x mb-3"></i>
                                <h3 x-text="indicator.name"></h3>
                            </div>
                            <div class="card-body">
                                <div class="stats">
                                    <div class="stat">
                                        <i class="fas fa-percentage"></i>
                                        <span>Valor actual: <span class="indicator-current-value" :data-indicator-id="indicator.id">0%</span></span>
                                    </div>
                                    <div class="stat">
                                        <i class="fas fa-bullseye"></i>
                                        <span>Meta: <span class="indicator-expected-value" :data-indicator-id="indicator.id">0%</span></span>
                                    </div>
                                </div>
                                <div class="mini-chart-container">
                                    <canvas class="indicator-chart" 
                                            :data-indicator-data="JSON.stringify(indicator.data)"
                                            x-init="renderIndicatorCharts($el)"></canvas>
                                </div>
                                <div class="indicator-meta">
                                    <div>
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Última actualización: <span x-text="indicator.updated_at || '12/05/2023'"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actions">
                                @can('edit_process')
                                <button class="material-icons btn-action edit" 
                                        @click.stop="openEditIndicatorForm(indicator.id)">
                                    <i>edit_square</i>
                                </button>
                                @endcan
                                
                                @can('delete_process')
                                <button class="material-icons btn-action delete" 
                                        @click.stop="deleteIndicator(indicator.id)">
                                    <i>backspace</i>
                                </button>   
                                @endcan
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </div>
</div>

@include('modules.bsc.processes._form')
@include('modules.bsc.processes._subprocess_modal')
@include('modules.bsc.processes._indicator_modal')

@endsection