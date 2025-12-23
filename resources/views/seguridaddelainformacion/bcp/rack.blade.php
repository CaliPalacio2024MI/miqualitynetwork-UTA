@extends('layouts.app')
@section('title', 'Rack')
@section('content')
@vite(['resources/js/bcp/rack.js'])

@vite(['resources/css/bcp/app.css', 'resources/js/bcp/app.js'])
@include('seguridaddelainformacion.bcp.layouts.barra')

<div class="container_entero">

    <h2>Rack de Habitaciones</h2>
    <!--<label>Número de Habitación:</label>-->
    <input type="number" id="numHabitacion" min="1100" max="5000" placeholder="Buscar habitación...">
    <button type="button" id="buscarHabitacionBtn">Buscar</button>
    <button type="button" id="mostrarTodasBtn">Mostrar todas</button>

    <a href="checkin">
        <button type="button">Check in</button>
    </a>

    <br><br>
    <div class="container_tablas">
        <table id="tablaHabitaciones">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Tipo</th>
                    <th>Número</th>
                    @foreach ($fechas as $fecha)
                    @php
                    $esHoy = \Carbon\Carbon::parse($fecha)->isToday();
                    @endphp
                    <th class="{{ $esHoy ? 'th-hoy' : '' }}">
                        {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
                    </th>
                    @endforeach

                </tr>
            </thead>
            <tbody>
                @foreach ($reservas as $habitacion => $dias)
                <tr>
                    @php
                    $habitacionKey = (string) $habitacion;
                    $datosCatalogo = $catalogo[$habitacionKey] ?? null;
                    @endphp

                    <td>{{ $datosCatalogo?->Status ?? 'NO INFO' }}</td>
                    <td>{{ $datosCatalogo?->Tp_Hab ?? '' }}</td>
                    <td>{{ $habitacion }}</td>

                    @php
                    $nombreAnterior = null;
                    @endphp

                    @foreach ($fechas as $fecha)
                    @php
                    $nombreActual = $dias[$fecha] ?? '';
                    $mostrar = '';

                    if ($nombreActual && $nombreActual !== $nombreAnterior) {
                    $mostrar = $nombreActual;
                    }

                    $nombreAnterior = $nombreActual;
                    @endphp

                    <td class="{{ $nombreActual ? 'reservado' : '' }}">{{ $mostrar }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>
@endsection