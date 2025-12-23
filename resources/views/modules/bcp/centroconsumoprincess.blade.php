@extends('layouts.dashboard')

@section('title', 'Princess Mundo Imperial')
@vite([
    'resources/css/modules/bcp/menu.css',
    'resources/css/modules/bcp/centroconsumos.css',
    'resources/js/modules/bcp/centroconsumos.js'
])
@section('content')
@include('modules.bcp.layouts.app')

    <div class="main-content">
        <div class="categoria-grid">
            @php
                $categorias = [
                    ['Restaurantes', 'restaurantes.svg', [
                        ['chulavista', 'ChulaVista.png', 'Chula Vista'],
                        ['condesa', 'centroconsumo.svg', 'Condesa'],
                        ['tavola', 'Tavola.png', 'Távola'],
                        ['azul', 'centroconsumo.svg', 'Azul'],
                        ['thebeachclub', 'TheBeachClub.png', 'The Beach Club'],
                        ['mestizo', 'centroconsumo.svg', 'Mestizo']
                    ]],
                    ['Bares', 'bares.svg', [
                        ['barlaguna', 'centroconsumo.svg', 'Bar Laguna'],
                        ['barpalapa', 'centroconsumo.svg', 'Bar Palapa'],
                        ['bargrotto', 'centroconsumo.svg', 'Bar Grotto'],
                        ['sushibar', 'centroconsumo.svg', 'Sushi Bar']
                    ]],
                    ['Snack', 'snack.svg', [
                        ['poolbeach', 'centroconsumo.svg', 'Pool & Beach'],
                        ['snackgolf', 'centroconsumo.svg', 'Snack Golf']
                    ]],
                    ['Deli', 'deli.svg', [
                        ['cafelosangeles', 'centroconsumo.svg', 'Café Los Ángeles']
                    ]],
                    ['IRD', 'ird.svg', [
                        ['inroomdiningprincess', 'IRD.png', 'In Room Dining']
                    ]]
                ];
            @endphp

            @foreach ($categorias as [$nombre, $icono, $subcategorias])
                <div class="categoria-item">
                    <button class="categoria-btn{{ $loop->first ? ' active' : '' }}">
                        <img src="{{ asset('images/' . $icono) }}" alt="{{ $nombre }}">
                        <span>{{ $nombre }}</span>
                    </button>
                    <div class="subcategorias" style="{{ $loop->first ? 'display: flex;' : '' }}">
                        @foreach ($subcategorias as [$href, $img, $nombreSub])
                            <a href="{{ url($href) }}"><img src="{{ asset('images/' . $img) }}" alt="">{{ $nombreSub }}</a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
