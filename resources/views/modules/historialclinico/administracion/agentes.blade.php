@extends('layouts.dashboard')

@section('title', 'Agentes')

@section('content')
    @vite(['resources/css/usuario.css'])
    @vite(['resources/css/modules/historialclinico/agentes.css'])

    {{-- Meta tag para el CSRF token, necesario para peticiones AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <h2 class="text-2xl font-bold mb-6 bg-gray-300 text-center rounded-full py-3 px-6 shadow-md">
            Administración de Agentes
        </h2>
    </div>

    <div id="agentesFormContainer" class="wrapper">
        <div class="left-column">
            <div class="header">
                <h2>Agregar Agente</h2>
            </div>
            {{-- El formulario será manejado por JavaScript para la petición AJAX --}}
            <form action="{{ route('agentes.store') }}" method="POST">
                @csrf
                <br>
                <div class="form-group">
                    <label class='listaAgentes' for="agente">Ingrese el nuevo Agente:</label>
                    <input class='line-input' type="text" name="agente" id="agente" placeholder="Ingrese el Nuevo Agente" required>
                </div>
                <button type="submit" class="button-agregar">Agregar Agente</button>
            </form>
        </div>
        <div class="right-column">
            <div class='listaAgentes'>
                <h3>Lista de Agentes</h3>
            </div>
            <div>
                <input class='line-input' id="filtro-agente" placeholder="Busca por nombre del agente">
            </div>
            <div class="container" id="admin-container">
                <div class="agentes-container">
                    {{-- La lista de agentes se cargará dinámicamente con JavaScript --}}
                    <ul id="agentes-list">
                        <li class="loading-indicator">Cargando agentes...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Modal HTML (incluido en layouts/dashboard o directamente aquí) --}}
    {{-- Si ya lo tienes en layouts/dashboard, puedes borrar este bloque. Si no, déjalo. --}}
    <div id="custom-modal-container" class="custom-modal-container hidden">
        <div class="custom-modal-content">
            <p id="custom-modal-message"></p>
            <input type="text" id="custom-modal-input" class="hidden" placeholder="Escribe aquí...">
            <div class="custom-modal-buttons">
                <button id="custom-modal-confirm-btn" class="confirm-btn"></button>
                <button id="custom-modal-cancel-btn" class="cancel-btn"></button>
            </div>
        </div>
    </div>

    {{-- Define variables globales de JavaScript con las rutas antes de cargar el script --}}
    <script>
        window.agentesStoreRoute = "{{ route('agentes.store') }}";
        // Rutas de las imágenes procesadas por Vite para los botones de la lista (EDITAR y ELIMINAR)
        window.editIconPath = "{{ Vite::asset('resources/imagenes/editar.PNG') }}";
        window.deleteIconPath = "{{ Vite::asset('resources/imagenes/eliminar.PNG') }}";
    </script>

    {{-- Carga tu script con @vite --}}
    @vite(['resources/js/modules/historialclinico/moduloAgentes.js'])
@endsection