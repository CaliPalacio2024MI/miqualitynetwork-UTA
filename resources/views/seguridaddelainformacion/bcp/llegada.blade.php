@extends('layouts.app')
@section('title', 'Llegadas')
@section('content')

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

<div class="container_entero">
    <h2 class="mb-4">Llegadas</h2>

    <!-- Subir archivo -->

    <form action="{{ route('llegada.importar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="importar-wrapper">
            <input type="file" class="input_importar_llegadas" name="archivo_csv" accept=".csv" required>
            <button type="submit" class="boton_importar_llegadas">Importar</button>
        </div>
    </form>


    <br>

    <!-- Tabla con todos los datos -->
    <div style="overflow-x: auto;" class="container_tablas">
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Cve_Reserv</th>
                    <th>Nombre</th>
                    <th>C</th>
                    <th>Tpo</th>
                    <th>G</th>
                    <th>Seg</th>
                    <th>THab</th>
                    <th>Hb</th>
                    <th>P</th>
                    <th>NHab</th>
                    <th>Plan</th>
                    <th>TP</th>
                    <th>In</th>
                    <th>#A</th>
                    <th>#N</th>
                    <th>#J</th>
                    <th>#MG</th>
                    <th>#I</th>
                    <th>FechaSal</th>
                    <th>Noc</th>
                    <th>Edo</th>
                    <th>FPgo</th>
                    <th>Tarifa</th>
                    <th>Agencia</th>
                    <th>Grupo</th>
                    <th>Compania</th>
                    <th>MensajesRecepcion</th>
                    <th>Cod_Reserva</th>
                    <th>PreCheckInWeb</th>
                    <th>FechaLlegada</th>
                    <th>Mail</th>
                    <th>Calle_Colonia</th>
                    <th>Municipio_Ciudad</th>
                    <th>Estado</th>
                    <th>CP</th>
                    <th>Telefono</th>
                    <th>Brasalete</th>
                    <th>LateCheckOut</th>
                    <th>Pax</th>
                    <th>CreditoInicial</th>
                    <th>CreditoDisponible</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $dato)
                <tr>
                    <td>{{ $dato->Cve_Reserv }}</td>
                    <td>{{ $dato->Nombre }}</td>
                    <td>{{ $dato->C }}</td>
                    <td>{{ $dato->Tpo }}</td>
                    <td>{{ $dato->G }}</td>
                    <td>{{ $dato->Seg }}</td>
                    <td>{{ $dato->THab }}</td>
                    <td>{{ $dato->Hb }}</td>
                    <td>{{ $dato->P }}</td>
                    <td>{{ $dato->NHab }}</td>
                    <td>{{ $dato->Plan }}</td>
                    <td>{{ $dato->TP }}</td>
                    <td>{{ $dato->In }}</td>
                    <td>{{ $dato->Valor_A }}</td>
                    <td>{{ $dato->Valor_N }}</td>
                    <td>{{ $dato->Valor_J }}</td>
                    <td>{{ $dato->Valor_MG }}</td>
                    <td>{{ $dato->Valor_I }}</td>
                    <td>{{ $dato->FechaSal }}</td>
                    <td>{{ $dato->Noc }}</td>
                    <td>{{ $dato->Edo }}</td>
                    <td>{{ $dato->FPgo }}</td>
                    <td>{{ $dato->Tarifa }}</td>
                    <td>{{ $dato->Agencia }}</td>
                    <td>{{ $dato->Grupo }}</td>
                    <td>{{ $dato->Compania }}</td>
                    <td>{{ $dato->MensajesRecepcion }}</td>
                    <td>{{ $dato->Cod_Reserva }}</td>
                    <td>{{ $dato->PreCheckInWeb }}</td>
                    <td>{{ $dato->FechaLlegada }}</td>
                    <td>{{ $dato->Mail }}</td>
                    <td>{{ $dato->Calle_Colonia }}</td>
                    <td>{{ $dato->Municipio_Ciudad }}</td>
                    <td>{{ $dato->Estado }}</td>
                    <td>{{ $dato->CP }}</td>
                    <td>{{ $dato->Telefono }}</td>
                    <td>{{ $dato->Brasalete }}</td>
                    <td>{{ $dato->LateCheckOut }}</td>
                    <td>{{ $dato->Pax }}</td>
                    <td>{{ $dato->CreditoInicial }}</td>
                    <td>{{ $dato->CreditoDisponible }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection