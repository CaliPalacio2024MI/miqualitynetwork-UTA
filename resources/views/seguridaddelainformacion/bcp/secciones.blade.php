@extends('layouts.app')
@section('title', 'Secciones')
@section('content')
@vite(['resources/js/bcp/secciones.js'])

@vite(['resources/css/bcp/app.css', 'resources/js/bcp/app.js'])
@include('seguridaddelainformacion.bcp.layouts.barra')

@if(session('success'))
<div id="modalSuccess" class="modal">
    <div class="modal-content">
        <p>{{ session('success') }}</p>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

@if(session('error'))
<div id="modalError" class="modal">
    <div class="modal-content">
        <p>{{ session('error') }}</p>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

@if ($errors->any())
<div id="modalError" class="modal">
    <div class="modal-content">
        <ul>
            @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

<div class="container_entero">
    <h2>SECCIONES</h2>

    <div class="flex space-x-6 justify-between w-[70%] mx-auto">

        <!-- Sección Izquierda: Crear Sección -->

        <div class="w-[400px] bg-white p-6 rounded-lg shadow-md text-center">
            <h2 class="text-xl font-semibold mb-4">Crear Sección</h2>

            <form id="seccionesid" class="space-y-4 text-left" method="POST" action="{{ route('secciones.store') }}">
                @csrf

                <input type="hidden" name="habitacionesSeleccionadas" id="habitacionesSeleccionadas">

                <!-- Nombre de la Sección -->
                <div>
                    <label>Nombre de la Sección</label><br> <!--class="block text-sm mb-1"-->
                    <input type="text" name="Secciones" required>
                </div>

                <!-- Edificio -->
                <div>
                    <label>Edificio de la Habitación</label><br>
                    <input type="text" name="Edificio">
                </div>

                <!-- Piso -->
                <div>
                    <label>Piso de la Habitación</label><br>
                    <input type="number" name="Piso">
                </div>

                <!-- Habitaciones -->
                <label>Habitaciones</label>
                <div class="flex justify-between space-x-4 h-52">

                    <div class="container_tablas">
                        <table border="1" cellpadding="5">
                            <tbody id="tabla-habitaciones">
                                <!-- Habitaciones con checkbox aparecerán aquí -->
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center">
                        <button type="button" id="btnSeleccionar" class="btn-secciones">Seleccionar</button>
                    </div>

                </div>

                <!-- Habitaciones Seleccionadas -->
                <label>Habitaciones Seleccionadas</label>
                <div class="flex justify-between space-x-4 h-52">

                    <div class="container_tablas">
                        <table border="1" cellpadding="5">
                            <tbody id="tabla-seleccionadas">
                                <!-- Habitaciones seleccionadas -->
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center">
                        <button type="submit" class="btn-secciones">Guardar</button>
                    </div>

                </div>

            </form>
        </div>


        <!-- Sección Derecha: Secciones Existentes -->

        <div class="w-1/2 bg-white p-6 rounded-lg shadow-md text-center" id="bloque-formulario">

            <h2 class="text-xl font-semibold mb-4">Secciones Existentes</h2>

            <div class="top section" id="buscador-bloque">
                <input type="text" id="buscar-seccion" name="buscar-seccion" placeholder="Buscar por ...">
                <button type="button" id="btn-buscar-seccion">Buscar</button>
            </div><br>

            <div class="container_tablas">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th style="width: 60%;">Sección</th>
                            <th style="width: 40%;"></th>
                        </tr>
                    </thead>

                    <tbody id="tabla-secciones-body">
                        @foreach ($secciones as $seccion)
                        <tr>
                            <td>{{ $seccion->Secciones }}</td>
                            <td class="celda-estado" style="text-align: center; vertical-align: middle;">

                                <button class="boton-icono borra-edita btn-editar" data-id="{{ $seccion->Secciones }}">
                                    <img src="{{ asset('images/modules/bcp/iconos/edit.svg') }}" alt="Editar">
                                </button>

                                <button class="boton-icono borra-edita btn-eliminar" data-id="{{ $seccion->Secciones }}">
                                    <img src="{{ asset('images/modules/bcp/iconos/delete.svg') }}" alt="Eliminar">
                                </button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

<!-- Modal para editar -->

<div id="modalEditar" class="modal" style="display:none;">
    <div class="modal-content botones-dobles">
        <form method="POST" id="formEditar" action="">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 10px;">

                <input type="hidden" name="habitacionesSeleccionadas" id="habitacionesSeleccionadas">
                <input type="hidden" name="habitacionesEliminadas" id="habitacionesEliminadas" value="[]">

                <label>Nombre de la Sección
                    <input type="text" name="Secciones" id="inputNombreSeccion" required>
                </label>

                <label>Habitaciones seleccionadas</label>
                <div class="container_tablas">
                    <table border="1" cellpadding="5" id="tabla-hab-modal">
                        <tbody id="tabla-hab-modal">
                            <!-- Habitaciones con checkbox aparecerán aquí -->
                        </tbody>
                    </table>
                </div>

            </div>

            <p>Guarde más habitaciones usando el mismo nombre de la Sección</p>

            <div style="margin-top: 20px; display: flex; justify-content: space-between;">
                <button type="button" id="cerrarModalEditar">Cerrar</button>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para eliminar -->

<div id="modalEliminar" class="modal" style="display:none;">
    <div class="modal-content botones-dobles">
        <p></p>
        <button id="btn-cerrar-eliminar">Cerrar</button>
        <button id="btn-eliminar" class="btn-eliminar-confirm">Eliminar</button>
    </div>
</div>

@endsection