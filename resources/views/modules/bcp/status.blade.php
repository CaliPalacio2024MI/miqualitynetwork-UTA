@extends('layouts.app')

@section('title', 'Status habitación')

@vite([
    'resources/css/menu.css',
    'resources/css/asignacion.css',
])

@section('content')
<div class="asignacion-container">
    <div class="titulo">STATUS HABITACION</div><br>

    <div class="paneles-asignacion">
        <!-- Panel izquierdo: lista de camaristas -->
        <div class="panel">
            <div class="panel-encabezado">
                Nombre | Cred. Total | Cred. Comp. | Cred. Pend.
            </div>
            <div class="panel-cuerpo">
                {{-- Aquí se insertarán los nombres de camaristas y sus créditos --}}
            </div>
        </div>

        <!-- Panel derecho: habitaciones asignadas -->
        <div class="panel-2">
            <div class="panel-encabezado">
                Sal/Pre | N. Hab. | T. Hab. | Piso | T.H. | AD | MN | Cred. | Titular | S.T. A
            </div>
            <div class="panel-cuerpo">
        
            </div>
        </div>
    </div>

    <div class="acciones-inferiores">
        <button class="btn btn-guardar">Guardar Cambios</button>
    </div>
</div>
@endsection
