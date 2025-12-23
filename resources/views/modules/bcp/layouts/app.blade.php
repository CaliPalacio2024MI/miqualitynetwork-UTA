<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mundo Imperial')</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="sidebar">    
        <div class="menu"> 
            <a href="{{ url('bcp/rackhabitaciones') }}" class="menu-item">
                <img src="{{ asset('images/estatushabitacion.svg') }}" alt="Estatus de habitación">
                <span>Rack de habitaciones</span>
            </a>
            <a href="{{ url('bcp/llegadas') }}" class="menu-item">
                <img src="{{ asset('images/llegadas.svg') }}" alt="Llegadas">
                <span>Llegadas</span>
            </a>
            <div class="menu-item dropdown">
                <button class="dropbtn">
                    <img src="{{ asset('images/centroconsumo.svg') }}" alt="Centro de consumo">
                    <span>Centro consumo</span>
                </button>
                <div class="dropdown-content">
                    <a href="{{ url('bcp/centroconsumopalacio') }}">Palacio Mundo Imperial</a>
                    <a href="{{ url('bcp/centroconsumopierre') }}">Pierre Mundo Imperial</a>
                    <a href="{{ url('bcp/centroconsumoprincess') }}">Princess Mundo Imperial</a>
                </div>
            </div>
            <div class="menu-item dropdown">
                <button class="dropbtn">
                    <img src="{{ asset('images/llave.svg') }}" alt="Ama de llaves">
                    <span>Ama de llaves</span>
                </button>
                <div class="dropdown-content">
                    <a href="{{ url('asignacion') }}">Asignación</a>
                    <a href="{{ url('status') }}">Status habitaciones</a>
                </div>
            </div>
            <a href="{{ url('bcp/estadodecuenta') }}" class="menu-item">
                <img src="{{ asset('images/estadodecuenta.svg') }}" alt="Estado de cuenta">
                <span>Estado de cuenta</span>
            </a>
            <div class="menu-item dropdown">
                <button class="dropbtn">
                    <img src="{{ asset('images/administracioncuentas.svg') }}" alt="Administración">
                    <span>Administración</span>
                </button>
                <div class="dropdown-content">
                    <a href="{{ url('administracionsecciones') }}">Secciones</a>
                    <a href="{{ url('administracioncreditos') }}">Límite de Créditos</a>
                </div>
            </div>
        </div>
    </div>

    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>
