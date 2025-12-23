@extends('layouts.app')

@section('title', 'CREDITOS')

@vite([
    'resources/css/menu.css',
    'resources/css/administracioncreditos.css',
])

@section('content')

<div class="creditos-container">
    <div class="titulo">CRÉDITOS</div><br>

    <div class="creditos-card">
        <h3 class="subtitulo">LÍMITE DE CRÉDITOS</h3>

        <form>
            <label for="limite">Créditos x camaristas</label>
            <div class="input-con-icono">
                <input type="number" id="limite" class="input-numero" value="0">
                <i class="fas fa-pen icono-editar"></i>
            </div>

            <button type="submit" class="btn-guardar">Guardar</button>
        </form>
    </div>
</div>
@endsection
