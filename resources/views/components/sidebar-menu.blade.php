<!-- Contenedor Principal con Sidebar Colapsable -->
@vite(entrypoints: ['resources/css/dropdown.css', 'resources/css/dashboard.css', 'resources/css/sidebar.css', 'resources/css/usuario.css','resources/js/alerta_cerrar_sesion.js'])


<div class="contenedor-alerta-cerrar-sesion">
    <h1 class="titulo-alerta-cerrar-sesion">cerrar sesión </h1>
    <h1>¿Quieres cerrar sesión?</h1>
    <div class="contenedor-aceptar-cancelar">
        <button class="btn-cerrar-sesion">Aceptar</button>
        <button class="btn-cerrar-sesion-cancelar">Cancelar</button>
    </div>
</div>
<div x-data="{ open: false }" class="flex w-full h-screen">
    <!-- Sidebar -->

    <aside @mouseover="open = true" @mouseleave="open = false" :class="open ? 'w-64' : 'w-20'"
        class="bg-[#F8F8F8] h-full flex flex-col justify-center shadow-md transition-all duration-300">


        <!-- Menú de Secciones -->
        <nav class="flex flex-col flex-1 space-y-3 fondo-sidebar">

            <!-- Obtener privilegios del usuario -->
            @php
            $privilegios = Auth::user()->privilegios;
            @endphp

            <!-- Encabezado con Botón y Logo  -->
            <div class="flex flex-col items-center w-full pb-10 border-b contenedor-logo">
                <!-- Logo con redirección al Dashboard -->
                <a href="{{ route('dashboard') }}">
                    <img :class="open ? 'w-48 mt-1' : 'w-14 mt-1'" src="{{ asset('images/logoMI.png') }}" alt="Logo"
                        class="transition-all duration-300 logo-imagen">
                </a>
            </div>

            <!-- Bienvenida -->
            <p :class="open ? 'text-lg opacity-100' : 'opacity-0 hidden'"
                class="mt-2 font-semibold text-center text-white transition-all duration-300">
                ¡Bienvenido(a) {{ Auth::user()->name }}!
            </p>


            <!-- CALIDAD -->
            @if ($privilegios && $privilegios->acceso_calidad)
            <ul class="space-y-3">
                <li>
                    <a
                        class="flex items-center px-3 py-3 mx-2 font-semibold text-white bg-blue-600 btn-principal-calidad rounded-2xl hover:bg-blue-700">
                        <img src="{{ asset('images/Calidad.png') }}" alt="Calidad" class="w-6 h-6 icono-sidebar">
                        <span :class="open ? 'ml-3 opacity-100' : 'hidden'"
                            class="transition-all duration-300">Calidad</span>
                    </a>
                    <ul class="dropdown-calidad">
                        @if ($privilegios->acceso_contextoorg)
                        <li><a href="{{ route('contextoorg.index') }}" class="dropdown-btn-letras">Contexto
                                de la Organización</a></li>
                        @endif
                        @if ($privilegios->acceso_liderazgo)
                        <li><a href="{{ route('liderazgo.index') }}" class="dropdown-btn-letras">Liderazgo</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_planificacion)
                        <li><a href="{{ route('planificacion.index') }}"
                                class="dropdown-btn-letras">Planificación</a></li>
                        @endif
                        @if ($privilegios->acceso_apoyo)
                        <li><a href="#" class="dropdown-btn-letras">Apoyo ➤</a>
                            <ul class="dropdown-anidado-calidad">
                                @if ($privilegios->acceso_documentacionmi)
                                <li><a href="{{ route('documentacionmi.index') }}"
                                        class="dropdown-btn-letras">Documentación MI</a></li>
                                @endif
                                <!-- AGREGAR EL MODULO DE CIRCULARES -->
                                @if ($privilegios->acceso_circulares)
                                <li><a href="{{ route('circulares.index') }}" class="dropdown-btn-letras">Circulares</a>
                                </li>
                                @endif
                                @if ($privilegios->acceso_controldocumental)
                                <li><a href="{{ route('controldoc.controldocumental') }}"
                                        class="dropdown-btn-letras">Control documental</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if ($privilegios->acceso_documentaciondelaoperacion)
                        <li>
                            <a href="#" class="dropdown-btn-letras">
                                Operación ➤ <!-- ANTES LLAMADO DOCUMENTACION DE LA OPERACION -->
                            </a>
                            <ul class="dropdown-anidado-calidad">
                                @if ($privilegios->acceso_cafeteriadeanfitriones)
                                <li>
                                    <a href="{{ route('cafeteriadeanfitriones.index') }}"
                                        class="dropdown-btn-letras">
                                        Café Kali
                                    </a>
                                </li>
                                @endif
                                @if ($privilegios->acceso_mireservaciondeeventos)
                                <li><a href="{{ route('mireservaciondeeventos.index') }}"
                                        class="dropdown-btn-letras">Mi Reservación de Eventos</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if ($privilegios->acceso_evaldesempeño)
                        <li><a href="#" class="dropdown-btn-letras">Evaluación del desempeño ➤</a>
                            <ul class="dropdown-anidado-calidad">
                                @if ($privilegios->acceso_revenuereports)
                                <li><a href="{{ route('revenuereports.index') }}"
                                        class="dropdown-btn-letras">Revenue Reports</a></li>
                                @endif
                                @if ($privilegios->acceso_balancescorecard)
                                <li><a href="{{ route('balancescorecard.index') }}"
                                        class="dropdown-btn-letras">Balance Score Card</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if ($privilegios->acceso_mejora)
                        <li><a href="#" class="dropdown-btn-letras">Mejora
                                ➤</a>
                            <ul class="dropdown-anidado-calidad">
                                <li><a href="{{ route('controlplanesdeaccion.index') }}"
                                        class="dropdown-btn-letras">Control Planes de acción</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif

            <!-- SEGURIDAD AMBIENTAL -->
            @if ($privilegios && $privilegios->acceso_seguridadambiental)
            <ul class="space-y-3">
                <li>
                    <a
                        class="flex items-center px-3 py-3 mx-2 font-semibold text-white bg-green-600 btn-principal-ambiental rounded-2xl hover:bg-green-700">
                        <img src="{{ asset('images/Ambiental.png') }}" alt="Seguridad Ambiental"
                            class="w-6 h-6 icono-sidebar">
                        <span :class="open ? 'ml-3 opacity-100' : 'hidden'"
                            class="transition-all duration-300">Seguridad Ambiental</span>
                    </a>
                    <ul class="dropdown-seguridad-ambiental">
                        @if ($privilegios->acceso_residuos)
                        <li><a href="#" class="dropdown-btn-letras">Residuos
                                ➤</a>
                            <ul class="dropdown-anidado-ambiental">
                                @if ($privilegios->acceso_controlderesiduos)
                                <li><a href="{{ route('controlderesiduos.index') }}">Control de
                                        Residuos</a></li>
                                @endif
                                @if ($privilegios->acceso_reportederesiduos)
                                <li><a href="{{ route('residuos.estadistico.index') }}">Reporte de
                                        Residuos</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if ($privilegios->acceso_energia)
                        <li><a href="#" class="dropdown-btn-letras">Energía
                                ➤</a>
                            <ul class="dropdown-anidado-ambiental">
                                @if ($privilegios->acceso_controldeenergia)
                                <li><a href="{{ route('controldeenergia.index') }}">Control de
                                        Energía</a></li>
                                @endif
                                @if ($privilegios->acceso_informaciondeenergia)
                                <li><a href="{{ route('informaciondeenergia.index') }}">Información de
                                        Energía</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if ($privilegios->acceso_agua)
                        <li><a href="#" class="dropdown-btn-letras">Agua ➤</a>
                            <ul class="dropdown-anidado-ambiental">
                                @if ($privilegios->acceso_controldeagua)
                                <li><a href="{{ route('controldeagua.index') }}">Control de Agua</a>
                                </li>
                                @endif
                                @if ($privilegios->acceso_informaciondeagua)
                                <li><a href="{{ route('informaciondeagua.index') }}">Información de
                                        Agua</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if ($privilegios->acceso_aire)
                        <li><a href="#" class="dropdown-btn-letras">Aire ➤</a>
                            <ul class="dropdown-anidado-ambiental">
                                @if ($privilegios->acceso_controldeaire)
                                <li><a href="{{ route('controldeaire.index') }}">Control de Aire</a>
                                </li>
                                @endif
                                @if ($privilegios->acceso_informaciondeaire)
                                <li><a href="{{ route('informaciondeaire.index') }}">Información de
                                        Aire</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if ($privilegios->acceso_comunidad)
                        <li><a href="{{ route('comunidad.index') }}" class="dropdown-btn-letras">Comunidad</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_ruido)
                        <li><a href="{{ route('ruido.index') }}" class="dropdown-btn-letras">Ruido</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_suelo)
                        <li><a href="{{ route('suelo.index') }}" class="dropdown-btn-letras">Suelo</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_recursosnaturales)
                        <li><a href="{{ route('recursosnaturales.index') }}"
                                class="dropdown-btn-letras">Recursos Naturales</a></li>
                        @endif
                        @if ($privilegios->acceso_reportecontroldeenergeticos)
                        <li><a href="{{ route('reportedecontroldeenergeticos.index') }}"
                                class="dropdown-btn-letras">Reporte de control de energeticos</a></li>
                        @endif
                        <!-- AGREGAR EL MODULO DE CIRCULARES -->
                        @if ($privilegios->acceso_circulares)
                        <li><a href="{{ route('circulares.index') }}" class="dropdown-btn-letras">Circulares</a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif

            <!-- SEGURIDAD Y SALUD -->
            @if ($privilegios && $privilegios->acceso_seguridadysalud)
            <ul class="space-y-3">
                <li>
                    <a
                        class="flex items-center px-3 py-3 mx-2 font-semibold text-white bg-orange-600 btn-principal-salud rounded-2xl hover:bg-orange-700">
                        <img src="{{ asset('images/Salud.png') }}" alt="Seguridad y Salud"
                            class="w-6 h-6 icono-sidebar">
                        <span :class="open ? 'ml-3 opacity-100' : 'hidden'"
                            class="transition-all duration-300">Seguridad y Salud</span>
                    </a>
                    <ul class="dropdown-seguridad-salud">
                        @if ($privilegios->acceso_gestion)
                        <li><a href="{{ route('gestion.index') }}" class="dropdown-btn-letras">Gestión</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_atencionaemergencias)
                        <li><a href="{{ route('atencionaemergencias.index') }}"
                                class="dropdown-btn-letras">Atención a Emergencias</a></li>
                        @endif
                        @if ($privilegios->acceso_higiene)
                        <li><a href="{{ route('higiene.index') }}" class="dropdown-btn-letras">Higiene</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_identificacionycontrolderiesgos)
                        <li><a href="{{ route('identificacionycontrolderiesgos.index') }}"
                                class="dropdown-btn-letras">Identificación y Control de Riesgos</a></li>
                        @endif
                        @if ($privilegios->acceso_prevencionentrabajospeligrosos)
                        <li><a href="{{ route('prevencionentrabajospeligrosos.index') }}"
                                class="dropdown-btn-letras">Prevención en Trabajos Peligrosos</a></li>
                        @endif
                        @if ($privilegios->acceso_perservaciondelasalud)
                        <li><a href="#" class="dropdown-btn-letras">Preservación de la Salud ➤</a>
                            <ul class="dropdown-anidado-salud">
                                @if ($privilegios->acceso_historialclinico)
                                <li><a href="{{ route('historialclinico.index') }}">Historial
                                        Clínico</a></li>
                                @endif
                                @if ($privilegios->acceso_accidentes_enfermedades)
                                <li>
                                    <a href="{{ route('historialclinico.formulario') }}">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Accidentes y enfermedades del trabajo
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        <!-- AGREGAR EL MODULO DE-------------------------------------------------------------------------------------------- CIRCULARES -->
                        @if ($privilegios->acceso_circulares)
                        <li><a href="{{ route('circulares.index') }}" class="dropdown-btn-letras">Circulares</a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif

            <!-- SEGURIDAD DE LA INFORMACION -->
            @if ($privilegios && $privilegios->acceso_seguridadinformacion)
            <ul class="space-y-3">
                <li>
                    <a
                        class="flex items-center px-3 py-3 mx-2 font-semibold text-white bg-gray-600 btn-principal-informacion rounded-2xl hover:bg-gray-700">
                        <img src="{{ asset('images/Informacion.png') }}" alt="Seguridad de la Información"
                            class="w-6 h-6 icono-sidebar">
                        <span :class="open ? 'ml-3 opacity-100' : 'hidden'"
                            class="transition-all duration-300">Seguridad de la Información</span>
                    </a>
                    <ul class="dropdown-seguridad-informacion">
                        @if ($privilegios->acceso_drp)
                        <li><a href="{{ route('drp.index') }}" class="dropdown-btn-letras">DRP</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_controles)
                        <li><a href="{{ route('controles.index') }}"
                                class="dropdown-btn-letras">Controles</a></li>
                        @endif
                        @if ($privilegios->acceso_riesgotecnologico)
                        <li><a href="{{ route('riesgotecnologico.index') }}"
                                class="dropdown-btn-letras">Riesgo Tecnológico</a></li>
                        @endif
                        @if ($privilegios->acceso_mantenimiento)
                        <li><a href="{{ route('mantenimiento.index') }}"
                                class="dropdown-btn-letras">Mantenimiento</a></li>
                        @endif
                        @if ($privilegios->acceso_bcp)
                        <li><a href="{{ route('bcp.index') }}" class="dropdown-btn-letras">BCP</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_circulares)
                        <li><a href="{{ route('circulares.index') }}" class="dropdown-btn-letras">Circulares</a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif

            <!-- SEGURIDAD ALIMENTARIA -->
            @if ($privilegios && $privilegios->acceso_seguridadalimentaria)
            <ul class="space-y-3">
                <li>
                    <a
                        class="flex items-center px-3 py-3 mx-2 font-semibold text-white bg-red-700 btn-principal-alimentaria rounded-2xl hover:bg-red-700">
                        <img src="{{ asset('images/Alimentaria.png') }}" alt="Seguridad Alimentaria"
                            class="w-6 h-6 icono-sidebar">
                        <span :class="open ? 'ml-3 opacity-100' : 'hidden'"
                            class="transition-all duration-300">Seguridad Alimentaria</span>
                    </a>
                    <ul class="dropdown-seguridad-alimentaria">
                        @if ($privilegios->acceso_cadenaalimentaria)
                        <li><a href="{{ route('cadenaalimentaria.index') }}"
                                class="dropdown-btn-letras">Cadena Alimentaria</a></li>
                        @endif
                        @if ($privilegios->acceso_riesgosalimentarios)
                        <li><a href="{{ route('riesgosalimentarios.index') }}"
                                class="dropdown-btn-letras">Riesgos Alimentarios</a></li>
                        @endif
                        @if ($privilegios->acceso_manipulaciondealimentos)
                        <li><a href="{{ route('manipulaciondealimentos.index') }}"
                                class="dropdown-btn-letras">Manipulación de Alimentos</a></li>
                        @endif
                        @if ($privilegios->acceso_medicion)
                        <li> <a href="{{ route('medicion.index') }}" class="dropdown-btn-letras">Medición</a>
                        </li>
                        @endif
                        @if ($privilegios->acceso_inocuidad)
                        <li><a href="{{ route('inocuidad.index') }}"
                                class="dropdown-btn-letras">Inocuidad</a></li>
                        @endif
                        @if ($privilegios->acceso_circulares)
                        <li><a href="{{ route('circulares.index') }}" class="dropdown-btn-letras">Circulares</a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif
        </nav>

        <!-- Opciones de Administración y Cerrar Sesión -->
        <div class="flex flex-col items-center py-6 space-y-3 fondo-sidebar">
            <!-- Verificar si el usuario tiene acceso a administrar usuarios -->
            @if ($privilegios && $privilegios->acceso_administrarusuarios)
            <a href="{{ route('dashboard.usuario') }}"
                class="flex items-center justify-center w-5/6 px-3 py-3 font-semibold text-black transition-all duration-300 bg-gray-300 rounded-2xl hover:bg-gray-400">
                <img src="{{ asset('images/Admin.png') }}" alt="Admin" class="w-6 h-6">
                <span :class="open ? 'ml-3 opacity-100' : 'hidden'"
                    class="transition-all duration-300 btn-administrar-sidebar">Administrador</span>
            </a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="flex justify-center w-full cerrar-sesion" id="logout-form">
                @csrf
                <button type="submit"
                    class="flex items-center justify-center w-5/6 px-3 py-3 font-semibold text-black transition-all duration-300 bg-gray-300 rounded-2xl hover:bg-gray-400">
                    <img src="{{ asset('images/Logout.png') }}" alt="Cerrar Sesión" class="w-6 h-6">
                    <span :class="open ? 'ml-3 opacity-100' : 'hidden'" class="transition-all duration-300">Cerrar
                        Sesión</span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div :class="open ? 'text-sm opacity-100' : 'opacity-0 hidden'"
            class="text-center text-white font-bold py-3 bg-[#092034] transition-all duration-300">
            MY QUALITY NETWORK
        </div>
    </aside>

    <!-- Contenido dinámico -->
    <main class="w-full p-6 overflow-scroll">
        @yield('content')
    </main>
</div>
</div>
<!-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('btnAccEnf');
        if (!btn) return;

        btn.addEventListener('click', e => {
            e.preventDefault();

            fetch(btn.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    // Reemplaza el contenido del main
                    document.getElementById('mainContent').innerHTML = html;

                    // Vuelve a inicializar sólo lo que necesites:
                    if (typeof inicializarFormularioDinamico === 'function') inicializarFormularioDinamico();
                    // ...otros init específicos para el formulario...
                })
                .catch(err => console.error('Error cargando formulario:', err));
        });
    });
</script> -->