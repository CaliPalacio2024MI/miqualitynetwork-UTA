@can('bsc.propiedad.index')
@extends('layouts.dashboard')

@section('title', 'Panel de Propiedades')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if(isset($formulario))
                    {!! $formulario !!}
                @else
                    <p>No hay formulario disponible.</p>
                @endif
            </div>
            <div class="col-md-6">
                <h3>Detalle de Propiedades existentes</h3>
              
                        @foreach ($propiedades as $propiedad)
                            <nav>

                                <span> {{$propiedad->nombre_propiedad}}</span>
                                if($user->hasProperty('$propiedad->nombre_propiedad' == $propiedad->nombre_propiedad)){
                                    <a href="{{ route('processes.index', $propiedad->id) }}" class="btn btn-primary">Ver Detalle</a>
                                @else
                                    <span> No tienes acceso a esta propiedad</span>
                                
                            </nav>
                        @endforeach
            </div>
        </div>
    </div>
@endsection
@endcan