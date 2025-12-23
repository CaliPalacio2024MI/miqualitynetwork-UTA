@extends('layouts.dashboard')
<!-- ESTA ES LA PAGINA PARA CREAR Y  MODIFICAR ANFITRIONES DE LA PLATOFORMA-->
@section('title', 'crearuser')

@section('content')
    @vite(['resources/css/edicionAnfitriones.css', 'resources/js/secciones.js', 'resources/js/crearuser.js', 'resources/js/mostrar_privilegios.js', 'resources/js/privilegios_registro_usuarios.js', 'resources/js/alerta_administracion.js'])
    <div>
        <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
            Editar anfitriones
        </h2>
    </div>
    <div class="contenedor-alerta-modificar-anfitrion">
        <h1 class="titulo-alerta-anfitrion-modificar">Modificación</h1>
        <h1>¿Esta seguro de modificar los datos del anfitrion?</h1>
        <div class = "contenedor-aceptar-cancelar">
            <button class ="btn-aceptar-anfitrion-modificacion">Aceptar</button>
            <button class ="btn-cancelar-modificacion-anfitrion-alerta">Cancelar</button>
        </div>
    </div>
    <div class="formularios">
        <div>

            <!-- SECCION PARA LA MODIFCIACION Y ELIMINACION de anfitriones  ESTE DIV SE LLAMARA EL MODIFICADOR-->
            <div class="formulario-edicion">
                <div class="contenedor-titulo-editar-anfitrion">
                    <form action="{{ route('dashboard.crearuser') }}">
                        <input type="submit"value="&#x1F814;" class="btn-recargar-regresar">
                    </form>

                    <h1 class="text-2xl font-bold titulo-modificar">Actualización de Información de Anfitriones</h1>
                </div>

                <div class="padding-modificador">
                    @if ($usuariodefinido)


                        <form action="{{ route('modificar.user') }}" method="POST" class="formulario">
                            @csrf
                            <input type="hidden" name="id" value="{{ $usuariodefinido->id }}">

                            <div class="form-group-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nombre:</label>
                                    <input class="form-input" type="text" name="name"
                                        value="{{ $usuariodefinido->name }}" required id="name">
                                </div>
                                <div class="form-group">
                                    <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
                                    <input class="form-input" type="text" name="apellido_paterno"
                                        value="{{ $usuariodefinido->apellido_paterno }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="rfc" class="form-label">RFC:</label>
                                    <input class="form-input" type="text" name="rfc"
                                        value="{{ $usuariodefinido->rfc }}" required>
                                </div>
                            </div>
                            <div class="form-group-row">
                                <div class="form-group">
                                    <label for="password" class="form-label">Nueva Contraseña:</label>
                                    <input class="form-input" type="password" name="password" placeholder="Nueva contraseña"
                                        maxlength="13">
                                </div>
                                <div class="form-group">
                                    <label for="departamento" class="form-label">Departamento:</label>
                                    <input class="form-input" type="text" name="departamento"
                                        value="{{ $usuariodefinido->departamento }}" required>

                                </div>

                                <div class="form-group">
                                    @if($propiedad_pertenece_anfitrion)
                                        <label for="propiedad_id">Propiedad</label>
                                        <select id="propiedad_id" name="propiedad_id" class="input-text" required>
                                        <option value="" disabled selected>{{ $propiedad_pertenece_anfitrion }}</option>
                                    @endif
                                        @foreach ($propiedad as $propiedades)
                                            <option value="{{ $propiedades->id_propiedad }}">{{ $propiedades->nombre_propiedad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Accesos a Secciones principales -->
                            <div class="actualizar-privilegios" id="{{ $usuariodefinido->id }}">
                                <fieldset class="campo">
                                    <legend>Accesos a secciones</legend>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="calidad"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_calidad ? 'checked' : '' }} />
                                        Calidad
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="ambiental"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_seguridadambiental ? 'checked' : '' }} />
                                        Seguridad Ambiental
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="salud"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_seguridadysalud ? 'checked' : '' }} />
                                        Seguridad y Salud
                                    </label>
                                    <label>

                                        <input type="checkbox" name="privilegios[]" value="informacion"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_seguridadinformacion ? 'checked' : '' }} />
                                        Seguridad de la Información
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="alimentaria"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_seguridadalimentaria ? 'checked' : '' }} />
                                        Seguridad Alimentaria
                                    </label>
                                </fieldset>

                                <!-- Accesos sub-secciones calidad -->
                                <fieldset class="campo">
                                    <legend>Accesos a Sub-Secciones CALIDAD</legend>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="contextoorg"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_contextoorg ? 'checked' : '' }} />
                                        Contexto de la organizacion
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="liderazgo"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_liderazgo ? 'checked' : '' }} />
                                        Liderazgo
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="planificacion"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_planificacion ? 'checked' : '' }} />
                                        Planificacion
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="apoyo"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_apoyo ? 'checked' : '' }} />
                                        Apoyo
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="documentacionmi"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_documentacionmi ? 'checked' : '' }} />
                                        Documentacion MI
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="cafeteriadeanfitriones"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_cafeteriadeanfitriones ? 'checked' : '' }} />
                                        Café Kali
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="mireservaciondeeventos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_mireservaciondeeventos ? 'checked' : '' }} />
                                        Mi reservacion de eventos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="controldocumental"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_controldocumental ? 'checked' : '' }} />
                                        Control documental
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="documentaciondelaoperacion"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_documentaciondelaoperacion ? 'checked' : '' }} />
                                        Operacion
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="procesosoperativos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_procesosoperativos ? 'checked' : '' }} />
                                        Procesos Operativos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="procesosdeapoyo"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_procesosdeapoyo ? 'checked' : '' }} />
                                        Procesos de Apoyo
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="evaldesempeño"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_evaldesempeño ? 'checked' : '' }} />
                                        Evaluacion del desempeño
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="revenuereports"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_revenuereports ? 'checked' : '' }} />
                                        Revenue Reports
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="balancescorecard"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_balancescorecard ? 'checked' : '' }} />
                                        Balance Score Card
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="mejora"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_mejora ? 'checked' : '' }} />
                                        Mejora
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="controlplanesdeaccion"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_controlplanesdeaccion ? 'checked' : '' }} />
                                        Control de planes de acción
                                    </label>

                                </fieldset>

                                <!-- Accesos sub-secciones Seguridad ambiental -->
                                <fieldset class="campo">
                                    <legend>Accesos a Sub-Secciones SEGURIDAD AMBIENTAL</legend>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="residuos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_residuos ? 'checked' : '' }} />
                                        Residuos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="controlderesiduos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_controlderesiduos ? 'checked' : '' }} />
                                        Control de residuos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="reportederesiduos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_reportederesiduos ? 'checked' : '' }} />
                                        Reporte de residuos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="energia"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_energia ? 'checked' : '' }} />
                                        Energía
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="controldeenergia"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_controldeenergia ? 'checked' : '' }} />
                                        Control de energia
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="informaciondeenergia"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_informaciondeenergia ? 'checked' : '' }} />
                                        Informacion de energia
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="agua"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_agua ? 'checked' : '' }} />
                                        Agua
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="controldeagua"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_controldeagua ? 'checked' : '' }} />
                                        Control de agua
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="informaciondeagua"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_informaciondeagua ? 'checked' : '' }} />
                                        Informacion de agua
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="aire"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_aire ? 'checked' : '' }} />
                                        Aire
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="controldeaire"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_controldeaire ? 'checked' : '' }} />
                                        Control de aire
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="informaciondeaire"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_informaciondeaire ? 'checked' : '' }} />
                                        Informacion de aire
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="comunidad"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_comunidad ? 'checked' : '' }} />
                                        Comunidad
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="ruido"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_ruido ? 'checked' : '' }} />
                                        Ruido
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="suelo"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_suelo ? 'checked' : '' }} />
                                        Suelo
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="recursosnaturales"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_recursosnaturales ? 'checked' : '' }} />
                                        Recursos Naturales
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="reportecontroldeenergeticos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_reportecontroldeenergeticos ? 'checked' : '' }} />
                                        Reporte de control de energeticos
                                    </label>
                                </fieldset>

                                <!-- Accesos sub-secciones Seguridad y salud -->
                                <fieldset class="campo">
                                    <legend>Accesos a Sub-Secciones SEGURIDAD Y SALUD</legend>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="gestion"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_gestion ? 'checked' : '' }} />
                                        Gestión
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="atencionaemergencias"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_atencionaemergencias ? 'checked' : '' }} />
                                        Atención a emergencias
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="higiene"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_higiene ? 'checked' : '' }} />
                                        Higiene
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]"
                                            value="identificacionycontrolderiesgos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_identificacionycontrolderiesgos ? 'checked' : '' }} />
                                        Identificación y control de riesgos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]"
                                            value="prevencionentrabajospeligrosos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_prevencionentrabajospeligrosos ? 'checked' : '' }} />
                                        Prevención en trabajos peligrosos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="perservaciondelasalud"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_perservaciondelasalud ? 'checked' : '' }} />
                                        Preservación de la salud
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="historialclinico"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_historialclinico ? 'checked' : '' }} />
                                        Historial clinico
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]"
                                         value="accidentes_enfermedades"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_accidentes_enfermedades ? 'checked' : '' }} />
                                        Accidentes y Enfermedades del trabajo
                                    </label>
                                </fieldset>

                                <!-- Accesos sub-secciones Seguridad de la informacion -->
                                <fieldset class="campo">
                                    <legend>Accesos a Sub-Secciones SEGURIDAD DE LA INFORMACION</legend>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="drp"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_drp ? 'checked' : '' }} />
                                        DRP
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="controles"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_controles ? 'checked' : '' }} />
                                        Controles
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="riesgotecnologico"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_riesgotecnologico ? 'checked' : '' }} />
                                        Riesgo tecnologico

                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="mantenimiento"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_mantenimiento ? 'checked' : '' }} />
                                        Mantenimiento
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="bcp"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_bcp ? 'checked' : '' }} />
                                        BCP
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="circulares"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_circulares ? 'checked' : '' }} />
                                        Circulares
                                    </label>
                                </fieldset>
                                <!-- Accesos sub-secciones Seguridad Alimentaria -->
                                <fieldset class="campo">
                                    <legend>Accesos a Sub-Secciones SEGURIDAD ALIMENTARIA</legend>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="cadenaalimentaria"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_cadenaalimentaria ? 'checked' : '' }} />
                                        Cadena Alimentaria
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="riesgosalimentarios"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_riesgosalimentarios ? 'checked' : '' }} />
                                        Riesgos Alimentarios
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="manipulaciondealimentos"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_manipulaciondealimentos ? 'checked' : '' }} />
                                        Manipulación de
                                        Alimentos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="medicion"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_medicion ? 'checked' : '' }} />
                                        Medición
                                    </label>
                                    <label>
                                        <input type="checkbox" name="privilegios[]" value="inocuidad"
                                            {{ $usuariodefinido->privilegios && $usuariodefinido->privilegios->acceso_inocuidad ? 'checked' : '' }} />
                                        Inocuidad
                                    </label>
                                </fieldset>
                                <!-- Selección de Carpetas a las que el usuario tendrá acceso -->
                                <div class="mt-6 mb-4">
                                    <label class="block text-sm font-medium text-gray-700">
                                        📁 Seleccionar Carpetas a las que el usuario <strong>tendrá acceso</strong>
                                    </label>

                                    <!-- Barra de búsqueda -->
                                    <input type="text" id="buscador-carpetas" placeholder="🔍 Buscar carpeta..."
                                        class="w-full px-3 py-2 mt-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">

                                    <!-- Botón para seleccionar/deseleccionar todas -->
                                    <div class="flex justify-center mt-2">
                                        <button type="button" id="btn-toggle-todas"
                                            class="px-4 py-1 text-sm text-gray-700 transition-all bg-gray-200 rounded-full hover:bg-gray-300">
                                            Deseleccionar Todas
                                        </button>
                                    </div>

                                    <!-- Lista de carpetas -->
                                    <div class="h-40 p-3 mt-2 overflow-y-auto bg-white border rounded-md shadow-sm"
                                        id="lista-carpetas">
                                        @if (isset($carpetas) && count($carpetas) > 0)
                                            @foreach ($carpetas as $carpeta)
                                                <label class="flex items-center py-1 space-x-2 carpeta-item">
                                                    <input type="checkbox" name="carpetas_acceso[]"
                                                        value="{{ $carpeta->id }}" class="carpeta-checkbox"
                                                        {{ in_array($carpeta->id, $carpetasAcceso) ? 'checked' : '' }}>
                                                    <span class="text-gray-700">{{ $carpeta->nombre_carpeta }}</span>
                                                </label>
                                            @endforeach
                                        @else
                                            <p class="text-gray-500">No hay carpetas disponibles.</p>
                                        @endif
                                    </div>
                                </div>

                                <small class="block mt-2 text-gray-500">
                                    Por defecto, el usuario <strong>TIENE ACCESO A TODAS LAS CARPETAS</strong>.<br>
                                    <strong>DESMARCA</strong> las carpetas a las que NO podrá acceder.
                                </small>
                            </div>
                </div>


                <button type="submit" class="btn-modificar">Confirmar Cambios</button>
                </form>
                <button type="submit" class="btn-privilegios" id="{{ $usuariodefinido->id }}">Mostrar/Ocultar
                    Privilegios</button>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
