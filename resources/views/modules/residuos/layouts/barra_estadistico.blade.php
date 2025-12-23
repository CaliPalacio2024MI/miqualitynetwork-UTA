{{-- resources/views/modules/residuos/layouts/barra_estadistico.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') – Estadístico</title>

  {{-- Tipografía Poppins y FontAwesome --}}
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  >
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  {{-- CSS principal del módulo --}}
  @vite(['resources/css/modules/residuos/app.css'])

  {{-- CSS específico de la barra superior --}}
  @vite('resources/css/modules/residuos/estadistico_barra.css')

  {{-- Otros estilos que se inyecten desde las vistas --}}
  @stack('styles')
</head>
<body class="font-[Poppins]">

  {{-- Contenido del módulo --}}
  <main id="main-content" style="margin-top: -15px; padding: 1rem;">
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>
