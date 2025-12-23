<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My quality network') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS y Scripts globales -->
    @vite([
    'resources/css/app.css',
    'resources/css/sidebar.css',
    'resources/js/app.js',
    'resources/js/modules/historialclinico/formulario.js',
    ])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    // Inyectamos las URLs generadas por Laravel para usar en JS
    const URL_EXPORT_PDF   = "{{ route('seguridadysalud.estadisticos.exportarPdf') }}";
    const URL_EXPORT_EXCEL = "{{ route('seguridadysalud.estadisticos.exportarExcel') }}";
</script>

</head>

<body class="font-sans antialiased">
    <!-- Contenedor principal -->
    <div x-data="{ open: localStorage.getItem('sidebar') === 'true' }" class="flex h-screen bg-gray-100">

        <!-- Sidebar (No duplicarlo en otras vistas) -->
        <x-sidebar-menu id="sidebar" class="h-screen transition-all duration-300" />
    </div>
</body>

</html>