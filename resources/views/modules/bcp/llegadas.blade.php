@extends('layouts.dashboard')

@section('title', 'Llegadas')
@vite([
    'resources/css/modules/bcp/menu.css',
    'resources/css/modules/bcp/llegadas.css',
    'resources/js/modules/bcp/llegadas.js'
])
@section('content')
@include('modules.bcp.layouts.app')

    <div class="main-content">
        <div class="content">
            <div class="titulo">LLEGADAS</div><br>

            <input type="file" id="fileInput" accept=".csv" class="button">
            <button class="button" onclick="importCSV()">Importar</button>

            <div class="table-container">
                <table class="dataframe table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>Cve. Reserv.</th>
                            <th>Nombre</th>
                            <th>C</th>
                            <th>Tpo</th>
                            <th>G</th>
                            <th>Seg</th>
                            <th>T.Hab.</th>
                            <th>Hb</th>
                            <th>P</th>
                            <th>N. Hab.</th>
                            <th>Plan</th>
                            <th>TP</th>
                            <th>In</th>
                            <th>#A</th>
                            <th>#N</th>
                            <th>#J</th>
                            <th>#MG</th>
                            <th>#I</th>
                            <th>Fecha Sal.</th>
                            <th>Noc</th>
                            <th>Edo</th>
                            <th>F.Pgo</th>
                            <th>Tarifa</th>
                            <th>Agencia</th>
                            <th>Grupo</th>
                            <th>Compañía</th>
                            <th>Mensajes Recepción</th>
                            <th>Cod.Reserva</th>
                            <th>Pre Check In Web</th>
                            <th>Fecha de Llegada</th>
                            <th>Mail</th>
                            <th>Calle # - Colonia</th>
                            <th>Municipio/Ciudad</th>
                            <th>Estado</th>
                            <th>C.P.</th>
                            <th>Telefono</th>
                            <th>Brazalete</th>
                            <th>Late Check Out</th>
                            <th>Pax</th>
                            <th>Crédito Inicial</th>
                            <th>Crédito Disponible</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Aquí se llenarán los datos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


