<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'My Quality Network') }}</title>

    <!-- Carga de recursos con Vite -->
    @vite([
    'resources/css/modules/historialclinico/sideBar.css',
    'resources/js/modules/seguridadysalud/estadisticos.js',
    'resources/js/modules/seguridadysalud/reporte.js'
    ])
</head>

<body>
    <!-- Contenedor principal -->
    <div id="app-container">
        <!-- Barra lateral de navegación -->
        <div id="contentCompanies">
            <div class="navigation">

                <!-- Menú Informe -->
                <div class="dropdown">
                    <img src="{{ asset('images/informe.png') }}" alt="informe-icon" class="iconos">
                    <button>Informe ▼</button>
                    <div class="dropdown-content">
                        <a href="{{ route('seguridadysalud.estadisticos') }}">
                            Estadísticos
                        </a>
                        <a href="{{ route('seguridadysalud.reporte') }}">
                            Reporte
                        </a>
                        <a href="{{ route('historialclinico.formulario') }}">
                            formulario
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido dinámico -->
        <main id="dynamicContent">
            @yield('content')
        </main>
    </div>

    <!-- Script de navegación AJAX mejorado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar existencia de elementos requeridos
            const dynamicContent = document.getElementById('dynamicContent');
            if (!dynamicContent) {
                console.error('Error: Elemento #dynamicContent no encontrado');
                return;
            }

            // Función para cargar contenido via AJAX
            async function loadContent(url) {
                dynamicContent.innerHTML = '<div class="loading">Cargando...</div>';
                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    const html = await response.text();
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('dynamicContent');

                    // Si existe el wrapper, inyecta su innerHTML; si no, todo el HTML recibido
                    dynamicContent.innerHTML = newContent ? newContent.innerHTML : html;

                    // Disparar evento de carga completa
                    window.dispatchEvent(new CustomEvent('ajax-content-loaded', {
                        detail: {
                            url
                        }
                    }));

                    // Actualizar la URL en el navegador (sin recargar)
                    window.history.pushState({}, '', url);

                } catch (error) {
                    console.error('Error al cargar contenido:', error);
                    dynamicContent.innerHTML = `<div class="error">Error al cargar la página: ${error.message}</div>`;
                }
            }

            // Manejador de eventos para links AJAX
            function handleLinkClick(event) {
                event.preventDefault();
                loadContent(this.href);
            }

            // Asignar eventos a los links existentes
            document.querySelectorAll('[data-ajax]').forEach(link => {
                link.addEventListener('click', handleLinkClick);
            });

            // Manejar el botón de retroceso/avance del navegador
            window.addEventListener('popstate', function() {
                loadContent(window.location.href);
            });

            // Manejador para contenido cargado dinámicamente
            window.addEventListener('ajax-content-loaded', function(e) {
                const url = e.detail.url;

                // Cargar módulos específicos según la página
                if (url.includes('estadisticos') && typeof window.cargarEstadisticos === 'function') {
                    window.cargarEstadisticos();
                } else if (url.includes('reporte') && typeof window.cargarReporte === 'function') {
                    window.cargarReporte();
                }
            });
        });
    </script>
    <style>
        .loading {
            padding: 2rem;
            text-align: center;
            font-size: 1.2rem;
            color: #666;
        }

        .error {
            padding: 2rem;
            color: #d32f2f;
            background: #ffebee;
            border-radius: 4px;
        }
    </style>
</body>

</html>