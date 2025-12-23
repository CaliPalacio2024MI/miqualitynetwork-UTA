@extends('layouts.app')
@section('title', 'Status')
@section('content')
@vite(['resources/js/bcp/status.js'])

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

    <div class="flex justify-between">
        <h2>STATUS</h2>
    </div>

    <div class="flex space-x-6 justify-between mx-auto">

        <!-- Sección Izquierda: Camarista -->

        <div class="w-[35%] bg-white p-6 rounded-lg shadow-md">

            <!-- Tabla -->
            <div class="container_tablas" style="height: 500px;">
                <table id="tabla-asignacion-seleccionada" class="table table-bordered" style="font-size: 11px;">

                    <thead>
                        <tr>
                            <th style="width: 45%;">Nombre</th>
                            <th style="width: 15%;">Cred. Total</th>
                            <th style="width: 15%;">Cred. Comp.</th>
                            <th style="width: 15%;">Cred. Pend.</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- El JS insertará aquí los datos-->
                    </tbody>

                </table>
            </div>

        </div>


        <!-- Sección Derecha: Habitaciones por Sección -->

        <div class="flex-1 bg-white p-6 rounded-lg shadow-md" id="bloque-formulario">

            <div class="container_tablas" style="height: 500px;">
                <table id="tabla-asignacion-todo" class="table table-bordered" style="font-size: 11px;">

                    <thead>
                        <tr>
                            <th style="width: 8%;">Sal/Pre</th>
                            <th style="width: 8%;">N. Hab.</th>
                            <th style="width: 8%;">T. Hab.</th>
                            <th style="width: 8%;">Piso</th>
                            <th style="width: 8%;">T.H.</th>
                            <th style="width: 8%;">AD</th>
                            <th style="width: 8%;">MN</th>
                            <th style="width: 8%;">Cred.</th>
                            <th style="width: 28%;">Titular</th>
                            <th style="width: 8%;">S.T. A</th>
                        </tr>
                    </thead>

                    <tbody id="">
                        <!-- El JS insertará aquí los datos-->
                    </tbody>

                </table>
            </div>
            <br>

            <div class="flex justify-center space-x-4">

                <div>
                    <button type="button" id="btnCambiarStatus">Guardar Cambios</button>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection

<!-- Modal de éxito -->
<div id="modal-exito" class="modal" style="display:none;">
    <div class="modal-content">
        <p>¡Status actualizado con éxito!</p>
        <button onclick="document.getElementById('modal-exito').style.display = 'none'"
            class="btn-modal">
            Cerrar
        </button>
    </div>
</div>