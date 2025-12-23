<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mi Aplicación')</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @vite([
        'resources/js/modules/bsc/vendor/jquery-3.6.0.min.js', 
    'resources/js/modules/bsc/vendor/bootstrap.min.js', 
    'resources/js/modules/bsc/vendor/jquery.dataTables.min.js', 
    'resources/js/modules/bsc/vendor/dataTables.bootstrap4.min.js', 
        'resources/css/modules/bsc/navbar.css',
        'resources/js/modules/bsc/navbar.js',
    'resources/js/modules/bsc/procesos.js',
    ])
</head>
<body>
    <!-- Barra de navegación superior -->
    <nav class="navbar">
        @include('modules.bsc.layout.navbar')
    </nav>

    <!-- Contenido -->
    <div class="main-content">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>