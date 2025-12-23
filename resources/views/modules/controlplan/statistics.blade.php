@extends('layouts.dashboard')

@section('title', 'Control planes de accion')

@section('content')
<!--Barra superior-->
@include('modules/controlplan/layouts/topbar')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes de acción</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  
    
    @vite('resources/css/modules/controlplan/topbar.css')
    @vite('resources/css/modules/controlplan/statistics.css')
    @vite('resources/js/modules/controlplan/statistics.js')

    <script> var json_array = @json($json_result); </script>

</head>
<body>
    

    <!--Sección para mostrar el total de planes de acción-->
        <div id="total-info" class="total-plan">
            <table>
                <tr>
                    <td><strong class="txt h1">{{ $plan }}</strong></td>
                </tr>
                <tr>
                    <td><p class="txt title h5">Total de planes de acción</p></td>
                </tr>
            </table>
        </div>

        <!--Sección para mostrar el tipo de plan de accion-->
        <div id="plan-type" class="plan-details">
            <table>
                <tr>
                    <td><p class="txt">Acción correctiva: {{ $corrective }}</p></td>
                </tr>
                <tr>
                    <td><p class="txt">Acción de mejora: {{ $improve }}</p></td>
                </tr>
                <tr>
                    <td><p class="txt">Corrección: {{ $correction }}</p></td>
                </tr>
            </table>
        </div>

        <!--Sección para mostrar el total del costo-->
        <div class="total-cost">
        <table>
                <tr>
                    <td><strong class="txt h1">${{ $cost}}</strong></td>
                </tr>
                <tr>
                    <td><p class="txt title h5">Total del costo</p></td>
                </tr>
            </table>
        </div>

        <!--Seccion para las estadisticas-->
        <div class="card stats">
        <div class="card-body">
            <canvas class="bar-chart" id="bar-chart"></canvas>
        </div>
        </div>


</body>
@endsection