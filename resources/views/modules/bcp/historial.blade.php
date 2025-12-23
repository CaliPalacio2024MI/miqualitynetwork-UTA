@extends('layouts.app')

@section('title', 'Historial')

@vite([
    'resources/css/menu.css',
    'resources/css/asignacion.css',
])

@section('content')
<div class="asignacion-container">
    <div class="titulo">Historial de Asignaciones</div><br>

    <div class="filtros-superiores">
        <label for="fecha_inicio">Fecha inicio:</label><input type="date" class="btn-fecha" name="fecha_inicio">
        <label for="fecha_inicio">Fecha fin:</label><input type="date" class="btn-fecha" name="fecha_fin">
        <input type="text" class="dropdown" placeholder="Buscar por nombre">
    </div>

    <div class="paneles-asignacion">
        <!-- Panel Izquierdo -->
        <div class="panel">
            <div class="panel-encabezado">
                Nombre | Cred. Total | Cred. Comp. | Cred. Pend. | Fecha
            </div>
            <div class="panel-cuerpo">
                <!-- Aquí irán los registros de historial (lado izquierdo) -->
            </div>
        </div>

        <!-- Panel Derecho -->
        <div class="panel-2">
            <div class="panel-encabezado">
                Sal/Pre | N. Hab. | T. Hab. | Piso | T.H. | AD | MN | Cred. | Titular | S.T. A
            </div>
            <div class="panel-cuerpo">
                <!-- Aquí irán los registros de historial (lado derecho) -->
            </div>
        </div>
    </div>

    <div class="acciones-inferiores">
        <button class="btn">Exportar</button>
    </div>
</div>
@endsection
