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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite('resources/css/modules/controlplan/topbar.css')
    @vite('resources/css/modules/controlplan/update copy.css')
    @vite('resources/js/modules/controlplan/update.js')
</head>
<body>


    <!--Modal del plan-->

    @include('modules/controlplan/layouts/modal_item')

    <!--Muestra la información-->
    <div class="table-search-pos">
        <!--div class="search-pos">
            <form action="search" method="get">
                <select class="border" name="status">
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                </select>

                <input class="border search-bar"name="name" type="text" placeholder="Buscar" value="{{ @$search }}">

                <button class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
                <a class="btn-close close-search" href="{{ url('update') }}"></a>

                <a class="btn btn-info" href="{{ url('print') }}" target="_blank">Imprimir</a>
            </form>
        </div-->

        <!--Seccion para la tabla-->
        <div class="table-content">
            <table class="data-table">
                <thead>
                    <th>No.</th>
                    <th>Origen</th>
                    <th>Propiedad</th>
                    <th>Responsable</th>    
                </thead>
                <tbody>
                
                @foreach($list as $item)
                <tr>
                    <td>{{ $item->no }}</td>
                    <td>{{ $item->origen }}</td>
                    <td>{{ $item->propiedad }}</td>
                    <td>{{ $item->responsable }}</td>
                    <td>

                    </td>
                    

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        

        

        

        


    </div>
</body>
@endsection