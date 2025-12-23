@extends('layouts.dashboard')

@section('title', 'Procesos')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Procesos</h1>
            <a href="" class="btn btn-primary">Crear Proceso</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>id_proceso</th>
                        <th>id_propiedad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($procesos as $proceso)
                        <tr>
                            <td>{{ $proceso->id }}</td>
                            <td>{{ $proceso->proceso->nombre_proceso}}</td>
                            <td>{{ $proceso->propiedad->nombre_propiedad}}</td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>id_bsc_proceso_propiedad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($procesoss as $procesos)
                        <tr>
                            <td>{{ $procesos->id }}</td>
                            <td>{{ $procesos->bsc_proceso_propiedad}}</td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>

@endsection