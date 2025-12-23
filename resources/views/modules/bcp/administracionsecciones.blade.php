@extends('layouts.app')

@section('title', 'Secciones')

@vite([
    'resources/css/menu.css',
    'resources/css/administracionsecciones.css',
])

@section('content')

<div class="secciones-container">
    <div class="titulo">SECCIONES</div><br>
    <div class="paneles-secciones">
        {{-- CREAR SECCIÓN --}}
        <div class="formulario-seccion">
            <h3 class="subtitulo">CREAR SECCIÓN</h3>

            <form>
                <label>Nombre de la Sección</label>
                <input type="text" class="input-estilo" placeholder="Ingrese el nombre">

                <label>Edificio</label>
                <select class="input-estilo">
                    <option selected disabled>Seleccione el edificio</option>
                </select>

                <label>Piso</label>
                <select class="input-estilo">
                    <option selected disabled>Seleccione el piso</option>
                </select>

                <label>Habitaciones</label>
                <textarea class="textarea-estilo"></textarea>
                <button type="button" class="btn-azul">Seleccionar</button>

                <label>Habitaciones seleccionadas</label>
                <textarea class="textarea-estilo"></textarea>
                <button type="submit" class="btn-azul">Guardar</button>
            </form>
        </div>

        {{-- HABITACIONES EXISTENTES --}}
        <div class="tabla-secciones">
            <h3 class="subtitulo">SECCIONES EXISTENTES</h3>

            <div class="busqueda">
                <input type="text" class="input-busqueda" placeholder="Buscar por...">
                <button class="btn-azul">Buscar</button>
            </div>

            <table class="tabla">
                <thead>
                    <tr>
                        <th class="encabezado-tabla">Sección</th>
                        <th class="encabezado-tabla">Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


