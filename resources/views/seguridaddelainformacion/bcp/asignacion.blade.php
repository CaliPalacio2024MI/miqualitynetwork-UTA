@extends('layouts.app')
@section('title', 'Asignación')
@section('content')
@vite(['resources/js/bcp/asignacion.js'])

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
        <h2>ASIGNACIÓN</h2>
        <!--<button class="button">Historial</button>-->
    </div>

    <div class="flex space-x-6 justify-between mx-auto">

        <!-- Sección Izquierda: Camarista -->

        <div class="w-[35%] bg-white p-6 rounded-lg shadow-md">

            <form id="asignadasForm" method="POST" action="{{ route('asignadas.guardar') }}" class="space-y-4 text-left">
                @csrf

                <!-- Camarista -->
                <div>
                    <select id="buscar-camarista" name="buscar-camarista" required>

                        <option value="">Selecciona una Camarista</option>
                        <option value="Andrea Pérez">Andrea Pérez</option>
                        <option value="Guadalupe López">Guadalupe López</option>
                        <option value="Luna Martínez">Luna Martínez</option>

                    </select>
                </div>

                <!-- Tabla -->
                <div class="container_tablas" style="height: 500px;">
                    <table id="tabla-asignacion-seleccionada" class="table table-bordered" style="font-size: 11px;">

                        <thead>
                            <tr>
                                <th style="width: 8%;">N. Hab.</th>
                                <th style="width: 8%;">T. Hab.</th>
                                <th style="width: 18%;">S.T. A</th>
                                <th style="width: 18%;">Cred.</th>
                                <th style="width: 18%;"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- El JS insertará aquí los datos-->
                        </tbody>

                    </table>
                </div>

                <!-- Créditos -->
                <div class="flex justify-between space-x-4">

                    <div class="w-[20%]">
                        <label>Total de <br>Créditos:</label>
                    </div>

                    <div class="w-[20%]">
                        <input type="number" name="Cred_Total" placeholder="0" readonly>
                    </div>

                    <div>
                        <button type="button" id="btnExportar">Exportar</button>
                    </div>

                    <div>
                        <button type="submit">Guardar</button>
                    </div>

                </div>

            </form>
        </div>


        <!-- Sección Derecha: Habitaciones por Sección -->

        <div class="flex-1 bg-white p-6 rounded-lg shadow-md" id="bloque-formulario">

            <div class="top section flex justify-between space-x-4">

                <div class="w-1/4">
                    <select id="buscar-seccion" name="buscar-seccion">

                        <option value="">Selecciona una Sección</option>
                        @foreach($secciones as $seccion)
                        <option value="{{ $seccion }}">{{ $seccion }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="w-1/4"></div>

                <div class="flex">
                    <label>Límite de Créditos:</label>
                </div>

                <div class="w-1/4">
                    <input type="text" id="mostrar-cred" name="mostrar-cred" value="{{ $credito }}" readonly>
                </div>

                <div class="flex">
                    <button type="button" id="asignar-asignacion">Asignar</button>
                </div>

            </div>
            <br>

            <div class="container_tablas" style="height: 500px;">
                <table id="tabla-asignacion-seccion" class="table table-bordered" style="font-size: 11px;">

                    <thead>
                        <tr>
                            <th style="width: 8%;">Sal/Pre</th>
                            <th style="width: 8%;">N. Hab.</th>
                            <th style="width: 8%;">T. Hab.</th>
                            <th style="width: 8%;">Piso</th>
                            <th style="width: 8%;">S.T. A</th>
                            <th style="width: 8%;">T.H.</th>
                            <th style="width: 8%;">AD</th>
                            <th style="width: 8%;">MN</th>
                            <th style="width: 8%;">Cred.</th>
                            <th style="width: 20%;">Titular</th>
                            <th style="width: 8%;"></th>
                        </tr>
                    </thead>

                    <tbody id="">
                        <!-- El JS insertará aquí los datos-->
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- Modal Ojito -->
<div id="modal-detalles" class="modal" style="display:none;">
    <div class="modal-content">
        <h3>Detalles de Habitación</h3>
        <div id="contenido-modal" style="text-align: left; width: 100%;"></div>
        <button type="button" onclick="cerrarModal()">Cerrar</button>
    </div>
</div>



@endsection