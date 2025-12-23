@extends('layouts.dashboard')

@section('title', 'Puestos')

@section('content')
@vite(['resources/css/usuario.css'])

{{-- Meta tag para el CSRF token, necesario para peticiones AJAX --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div>
    <h2 class="text-2xl font-bold mb-6 bg-gray-300 text-center rounded-full py-3 px-6 shadow-md">
        Administración de Puestos
    </h2>
</div>

<div id="puestosFormContainer" class="wrapper">
    <div class="left-column">
        <div class="header">
            <h2>Agregar Puesto</h2>
        </div>
        <form action="{{ route('puestos.store') }}" method="POST">
            @csrf

            {{-- Select de Propiedad --}}
            <label for="selectPropiedad">Propiedad:</label>
            <select id="selectPropiedad" name="propiedad_id" class="line-input-select" required>
                <option value="" disabled {{ session('selected_propiedad') ? '' : 'selected' }}>Seleccione una propiedad</option>
                @foreach($propiedades as $propiedad)
                <option value="{{ $propiedad->id_propiedad }}"
                    {{ session('selected_propiedad') == $propiedad->id_propiedad ? 'selected' : '' }}>
                    {{ $propiedad->nombre_propiedad }}
                </option>
                @endforeach
            </select>

            {{-- Proceso asociado --}}
            <label for="proceso_id">Proceso asociado:</label>
            <select name="proceso_id" id="proceso_id" class="line-input-select">
                <option value="">Seleccione un proceso</option>
                @foreach ($procesos as $proceso)
                <option value="{{ $proceso->id_proceso }}">{{ $proceso->nombre_proceso }}</option>
                @endforeach
            </select>

            {{-- Select de Departamento --}}
            <label for="selectDepartamento">Departamento:</label>
            <select id="selectDepartamento" name="departamento_id" class="line-input-select" required>
                @if(session('selected_departamento'))
                <option value="">-- Seleccione un departamento --</option>
                @foreach($departamentos as $dep)
                @if(session('selected_propiedad') == $dep->propiedad_id)
                <option value="{{ $dep->id }}" {{ session('selected_departamento') == $dep->id ? 'selected' : '' }}>
                    {{ $dep->departamento }}
                </option>
                @endif
                @endforeach
                @else
                <option value="" disabled selected>Seleccione una propiedad primero</option>
                @endif
            </select>



            {{-- Nombre del puesto --}}
            <label for="puesto">Ingrese el nuevo Puesto:</label>
            <input class="line-input" type="text" name="puesto" id="puesto" placeholder="Ingrese el Nuevo Puesto" required>

            <button type="submit" class="button-agregar">Agregar Puesto</button>
        </form>
    </div>

    <div class="right-column">
        <div class="listaPuestos">
            <h3>Lista de Puestos</h3>
        </div>
        <input type="text" id="filtro-puesto" class="line-input" placeholder="Busca por nombre del puesto">
        <div class="puestos-container">
            <ul id="puestos-list">
                <li class="loading-indicator">Cargando puestos...</li>
            </ul>
        </div>
    </div>
</div>

{{-- Modal de edición de puesto --}}
<div id="custom-modal-container" class="custom-modal-container hidden">
    <div class="custom-modal-content">
        <p id="custom-modal-message">Editar Puesto:</p>
        <input type="text" id="custom-modal-input" placeholder="Nuevo nombre del puesto">
        <div class="custom-modal-buttons">
            <!-- Botón Editar -->
            <button class="btn-editar" onclick="updatePuesto('${puesto.id}', '${csrf}')">
                <img src="/images/editar.png" alt="editar-icon" class="iconos" style="width: 20px;">
            </button>

            <!-- Botón Eliminar -->
            <button class="btn-eliminar" onclick="deletePuesto('${puesto.id}', '${csrf}')">
                <img src="/images/iconodeborrar.png" alt="eliminar-icon" class="iconos" style="width: 20px;">
            </button>

        </div>
    </div>
</div>


{{-- Carga tu script con @vite --}}
@vite(['resources/js/modules/historialclinico/moduloPuestos.js'])
@endsection