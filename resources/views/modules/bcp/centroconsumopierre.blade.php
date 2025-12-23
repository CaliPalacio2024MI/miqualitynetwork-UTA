@extends('layouts.dashboard')

@section('title', 'Pierre Mundo Imperial')
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
                        ['laterraza', 'LaTerraza.png', 'La Terraza'],
                        ['barpierre', 'BarPierre.png', 'Bar Pierre'],
                        ['tabachin', 'Tabachin.png', 'Tabachín']
                    ]],
                    ['Bares', 'bares.svg', [
                        ['amigomiguel', 'AmigoMiguel.png', 'Amigo Miguel']
                    ]],
                    ['Deli', 'deli.svg', [
                        ['pierrescafe', 'centroconsumo.svg', 'Pierre\'s Café & Delicatessen']
                    ]],
                    ['IRD', 'ird.svg', [
                        ['inroomdiningpierre', 'IRD.png', 'In Room Dining']
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
