@extends('layouts.dashboard')

@section('title', 'Palacio Mundo Imperial')
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
                        ['marche', 'Marche.png', 'Marche'],
                        ['carnivore', 'Carnivore.png', 'Carnivore'],
                        ['mexkalli', 'Mexkalli.png', 'Mexkalli'],
                        ['mizumi', 'Mizumi.png', 'Mizumi'],
                        ['aroma', 'Aroma.png', 'A Roma'],
                        ['caminare', 'Caminare.png', 'Caminare']
                    ]],
                    ['Bares', 'bares.svg', [
                        ['blubar', 'BluBar.png', 'Blu Bar'],
                        ['serenitybar', 'SerenityBar.png', 'Serenity Bar'],
                        ['poolbar', 'PoolBar.png', 'Pool Bar']
                    ]],
                    ['Snacks', 'snack.svg', [
                        ['acua', 'Acua.png', 'Acua'],
                        ['scalaoceanclub', 'ScalaOceanClub.png', 'Scala Ocean Club'],
                        ['alohagrill', 'AlohaGrill.png', 'Aloha Grill']
                    ]],
                    ['Deli', 'deli.svg', [
                        ['deli', 'DeliGourmet.png', 'Deli Gourmet'],
                        ['coffeeetcetera', 'centroconsumo.svg', 'Coffee Etcetera']
                    ]],
                    ['IRD', 'ird.svg', [
                        ['inroomdiningpalacio', 'IRD.png', 'In Room Dining']
                    ]],
                    ['Lounge', 'lounge.svg', [
                        ['club89', 'Club89.png', 'Club 89'],
                        ['#', 'iconolounge.svg', 'Lounge Aeropuerto']
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
    <a href="{{ url('bcp/' . $href) }}">
        <img src="{{ asset('images/' . $img) }}" alt="">{{ $nombreSub }}
    </a>
@endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
