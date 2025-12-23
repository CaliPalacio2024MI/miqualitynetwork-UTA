@extends('layouts.dashboard')

@section('title', 'Rack de Habitaciones')
@vite([
    'resources/css/modules/bcp/menu.css',
    'resources/css/modules/bcp/rackhabitaciones.css',
    'resources/js/modules/bcp/rackhabitaciones.js'
])
@section('content')
@include('modules.bcp.layouts.app')

<div class="main-content">
    <div class="container_rack">
        <div class="titulo">RACK DE HABITACIONES</div>

        <input type="text" id="busquedaHabitacion" placeholder="Buscar habitación" class="input-busqueda" maxlength="4" pattern="\d{4}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        <button id="btnBuscar" class="button">Buscar</button>
        <button class="button" onclick="window.location.href='{{ route('bcp.checkin') }}'">Check In</button> 
        

        <div class="tabla-scroll">
            <table id="tablaHabitaciones">
                <thead>
                    <tr id="encabezadoPrincipal">
                        <th>Estatus</th>
                        <th>Tipo</th>
                        <th>Habitación</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

