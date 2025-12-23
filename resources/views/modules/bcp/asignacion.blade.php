@extends('layouts.app')

@section('title', 'Asignacion')

@vite([
    'resources/css/menu.css',
    'resources/css/asignacion.css',
])

@section('content')
<div class="asignacion-container">
    <div class="titulo">ASIGNACION</div><br>

    <div class="filtros-superiores">
        <input type="text" class="dropdown input-camarista" placeholder="Selecciona una camarista">

        <select class="dropdown">
            <option disabled selected>Selecciona una sección</option>
            <option value="A">Sección A</option>
            <option value="B">Sección B</option>
            <option value="C">Sección C</option>
            <option value="D">Sección D</option>
        </select>

        <label for="limite-creditos">Límite de Créditos:</label>
        <input type="number" id="limite-creditos" name="limite_creditos" min="0" step="1" />


        <button class="btn">Asignar</button>
        <a href="{{ url('historial') }}" class="btn">Historial</a>
    </div>

    <div class="paneles-asignacion">
        <div class="panel">
            <div class="panel-encabezado">No. Habitación. | Tipo Hab. | S.T. A | Cred.</div>
            <div class="panel-cuerpo"></div>
        </div>

        <div class="panel-2">
            <div class="panel-encabezado">Sal/Pre | N. Hab. | T. Hab. | Piso | S.T. A | T.H | AD | MN | Cred. | Titular</div>
            <div class="panel-cuerpo"></div>
        </div>
    </div>

    <div class="acciones-inferiores">
        <label for="total-creditos">Total de créditos:</label>
        <input type="number" id="total-creditos" name="total_creditos" min="0" step="1" />
        <button class="btn">Exportar</button>
        <button class="btn">Guardar</button>
    </div>
</div>
@endsection