{{-- resources/views/modules/residuos/layouts/appresiduos.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') – Control de Residuos</title>

  {{-- Tipografías e iconos --}}
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-…"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  {{-- tu CSS/JS --}}
  @vite(['resources/css/modules/residuos/app.css', 'resources/js/modules/residuos/app.js'])
  @stack('styles')

</head>
<body class="font-[Poppins]">

  {{-- BARRA SUPERIOR --}}
  <header class="top-bar">
    <nav>
      <a href="{{ route('entradas.index') }}"
         class="nav-link {{ Request::routeIs('entradas.*') ? 'active' : '' }}">
        <i class="fas fa-sign-in-alt"></i> Entradas
      </a>
      <a href="{{ route('salidas.create') }}"
         class="nav-link {{ Request::routeIs('salidas.*') ? 'active' : '' }}">
        <i class="fas fa-sign-out-alt"></i> Salidas
      </a>
      <a href="{{ route('configuracion.compras.index') }}"
         class="nav-link {{ Request::routeIs('configuracion.compras.*') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i> Compras
      </a>
      <a href="{{ route('configuracion.poblacion.index') }}"
         class="nav-link {{ Request::routeIs('configuracion.poblacion.*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Población
      </a>
    </nav>

    <div class="ml-auto section-title">
      @yield('title')
    </div>
  </header>

  {{-- CONTENIDO --}}
    @yield('content')

  @stack('scripts')
</body>
</html>
