@extends('layouts.app')
@section('title', 'Tipos de Status')
@section('content')
@vite(['resources/js/bcp/tipo_status.js'])

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
    <h2>TIPOS DE STATUS</h2>

    <div class="flex space-x-6 justify-between w-[70%] mx-auto">

        <!-- Sección Izquierda: Crear Status -->

        <div class="w-[400px] bg-white p-6 rounded-lg shadow-md text-center">
            <h2 class="text-xl font-semibold mb-4">Crear Status</h2>

            <form id="cuentaForm" action="{{ route('tipo_status.store') }}" method="POST" class="space-y-4 text-left">
                @csrf

                <!-- Nombre del Status -->
                <div>
                    <label for="Nombre">Nombre del Status</label><br> <!--class="block text-sm mb-1"-->
                    <input type="text" name="Nombre" required>
                </div>

                <!-- Código del Status -->
                <div>
                    <label for="Codigo">Código</label><br> <!--class="block text-sm mb-1"-->
                    <input type="text" name="Codigo" required>
                </div>

                <!-- Color -->
                <div>
                    <label for="colorPicker">Color</label><br>
                    <input type="color" id="colorPicker" class="color-full" value="#9999ff">
                    <input type="hidden" id="rgbValue" name="Color">
                </div>

                <!-- Botón -->
                <div class="text-center pt-2">
                    <button type="submit">
                        Guardar
                    </button>
                </div>
            </form>
        </div>


        <!-- Sección Derecha: Status Existentes -->

        <div class="flex-1 bg-white p-6 rounded-lg shadow-md text-center" id="bloque-formulario">

            <h2 class="text-xl font-semibold mb-4">Status Existentes</h2>

            <div class="top section" id="buscador-bloque">
                <input type="text" id="buscar-status" name="buscar-status" placeholder="Buscar por ...">
                <button type="button" id="btn-buscar-status">Buscar</button>
            </div><br>

            <div class="container_tablas">

                <table id="tabla-mesas" class="table table-bordered">

                    <thead>
                        <tr>
                            <th style="width: 40%;">Nombre</th>
                            <th style="width: 20%;">Código</th>
                            <th style="width: 20%;">Color</th>
                            <th style="width: 20%;"></th>
                        </tr>
                    </thead>

                    <tbody id="tabla-status-body">
                        @foreach ($tipos as $tipo)
                        <tr>
                            <td>{{ $tipo->Nombre }}</td>
                            <td>{{ $tipo->Codigo }}</td>
                            <td>
                                <div style="background-color: {{ $tipo->Color }}; width: 40px; height: 25px; border-radius: 16px; margin: 0 auto;"></div>
                            </td>
                            <td class="celda-estado" style="text-align: center; vertical-align: middle;">
                                <button class="boton-icono borra-edita btn-editar" data-id="{{ $tipo->Codigo }}">
                                    <img src="{{ asset('images/modules/bcp/iconos/edit.svg') }}" alt="Editar">
                                </button>
                                <button class="boton-icono borra-edita btn-eliminar" data-id="{{ $tipo->Codigo }}">
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

<!-- Modal para eliminar -->

<div id="modalEliminar" class="modal" style="display:none;">
    <div class="modal-content botones-dobles">
        <p>¿Estás seguro de querer eliminar este Tipo de Status?</p>
        <button id="btn-cerrar-eliminar">Cerrar</button>
        <button id="btn-eliminar" class="btn-eliminar-confirm">Eliminar</button>
    </div>
</div>

<!-- Modal para editar -->

<div id="modalEditar" class="modal">
    <div class="modal-content botones-dobles">
        <form method="POST" id="formEditar" action="">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <p id="textoHabitacion">Editar Tipo de Status:</p>

                <div>
                    <label for="Nombre">Nombre del Status</label><br>
                    <input type="text" name="Nombre" required>
                </div>

                <div>
                    <label for="Codigo">Código</label><br>
                    <input type="text" name="Codigo" required>
                </div>

                <div>
                    <label for="colorPicker">Color</label><br>
                    <input type="color" id="colorPickerEditar" class="color-full" value="#9999ff">
                    <input type="hidden" id="rgbValueEditar" name="Color">
                </div>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: space-between;">
                <button type="button" id="cerrarModalEditar">Cerrar</button>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>

@endsection