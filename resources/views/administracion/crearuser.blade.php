@extends('layouts.dashboard')
<!-- ESTA ES LA PAGINA PARA CREAR Y  MODIFICAR ANFITRIONES DE LA PLATOFORMA jajaxd-->
@section('title', 'crearuser')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@section('content')

    @vite(['resources/css/administrarcionAnfitrion.css', 'resources/js/secciones.js', 'resources/js/mostrar_privilegios.js', 'resources/js/crearuser.js', 'resources/js/privilegios_registro_usuarios.js', 'resources/js/alerta_administracion.js'])
    @vite(['resources/js/modules/historialclinico/moduloPuestos.js'])
    <div class="contenedor-alerta-registro-anfitriones">
        <h1 class="titulo-alerta-registrado-anfitriones">Registrado</h1>
        <h1>Anfitrión registrado</h1>
        <img src="{{ asset('images/giftcompletado.gif') }}" class="icono-completado-registro-alerta-anfitriones">
        <button class ="btn-aceptar-anfitriones-registro-alerta">Aceptar</button>
    </div>


    <div class="contenedor-alerta-eliminacion-anfitriones">
        <h1 class="titulo-alerta-anfitriones-eliminado">Eliminar ⚠️</h1>
        <h1>¿Esta seguro de eliminar este Anfitrión?</h1>
        <br>
        <h1>No se podran revertir los cambios</h1>
        <img src="{{ asset('images/advertencia.png') }}" class="icono-completado-eliminiar-alerta-anfitriones">
        <div class = "contenedor-aceptar-cancelar">
            <button class ="btn-borrar-anfitriones-alerta">Aceptar</button>
            <button class ="btn-cancelar-anfitriones-alerta">Cancelar</button>
        </div>
    </div>

    <div>
        <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
            Administracion de anfitriones
        </h2>
    </div>

    <div class="contenedor-anfitriones-rye">

        <div class="contenedor-registro-anfitriones">
            <div class="contenedor-titulo-registro">
                <h1 class="text-2xl font-bold titulo-registro">Registro de Anfitriones</h1>
            </div>

            <div class = "pading-registro-anfitrion">
                <form action="{{ route('dashboard.crearuser.store') }}" method="POST" class="form-registrar-anfitrion">
                    @csrf
                    <!-- Nombre -->
                    <div class="campo">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" class="input-text" required
                            placeholder="Ingrese el nombre" />
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="campo">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="input-text" required
                            placeholder="Ingrese el apellido paterno" />
                    </div>

                    <!-- RFC -->
                    <div class="campo">
                        <label for="rfc">RFC</label>
                        <input type="text" id="rfc" name="rfc" class="input-text" required
                            placeholder="Ingrese el RFC" pattern=".{13,13}"
                            title="El RFC del anfitrion debe tener exactamente 13 caracteres" />
                    </div>

                    <!-- Contraseña -->
                    <div class="campo">
                        <label for="password">Contraseña</label>
                        <input type="text" id="rfc" name="rfc" class="input-text" required
                            placeholder="Ingrese el RFC" />
                    </div>
                    <!-- Propiedad -->
                    <div class="campo">
                        <label for="propiedad_id">Propiedad</label>
                        <select id="propiedad_id" name="propiedad_id" class="input-text" required>
                            <option value="" disabled selected>Seleccione una propiedad</option>
                            @php
                                $propiedades = App\Models\Propiedades::all();
                            @endphp
                            @foreach($propiedades as $propiedad)
                                <option value="{{ $propiedad->id_propiedad }}">{{ $propiedad->nombre_propiedad }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Departamento -->
                    <div>
                        <label for="selectDepartamentoP" class="block font-semibold">Departamento:</label>
                        <select id="selectDepartamentoP" name="departamento_id" class="w-full border rounded p-2" disabled>
                            <option value="">Seleccione un departamento</option>
                        </select>
                    </div>

                    <!-- Puestos -->
                    <div>
                        <label for="selectPuestoP" class="block font-semibold">Puesto:</label>
                        <select id="selectPuestoP" name="puesto_id" class="w-full border rounded p-2" disabled>
                            <option value="">Seleccione un puesto</option>
                        </select>
                    </div>

                    <!-- Accesos a Secciones principales -->
                    <fieldset class="campo">
                        <legend>Accesos a secciones</legend>
                        <label>
                            <input type="checkbox" name="acceso[]" value="calidad" class="ck-calidad" /> Calidad
                        </label>
                        <label>
                            <input type="checkbox" name="acceso[]" value="ambiental" class="ck-ambiental" /> Seguridad
                            Ambiental
                        </label>
                        <label>
                            <input type="checkbox" name="acceso[]" value="salud" class="ck-salud" /> Seguridad y Salud
                        </label>
                        <label>
                            <input type="checkbox" name="acceso[]" value="informacion" class="ck-informacion" />
                            Seguridad de la Información
                        </label>
                        <label>
                            <input type="checkbox" name="acceso[]" value="alimentaria" class="ck-alimentaria" />
                            Seguridad Alimentaria
                        </label>
                    </fieldset>

                    <!-- Accesos sub-secciones calidad -->
                    <fieldset class="campo" id="Calidad">
                        <legend>Accesos a Sub-Secciones CALIDAD</legend>

                        <!-- Contexto de la organizacion (Sin módulos) -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="contextoorg" class="ck-subseccion"
                                data-texto="Módulos de la sub-sección Contexto de la organización" />
                            Contexto de la organización
                        </label>

                        <!-- Liderazgo (Sin módulos) -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="liderazgo" class="ck-subseccion"
                                data-texto="Módulos de la sub-sección Liderazgo" />
                            Liderazgo
                        </label>

                        <!-- Planificacion (Sin módulos) -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="planificacion" class="ck-subseccion"
                                data-texto="Módulos de la sub-sección Planificacion" />
                            Planificacion
                        </label>

                        <!-- Apoyo -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="apoyo" class="ck-subseccion"
                                data-modulos="modulos-apoyo" data-texto="Módulos de la sub-sección Apoyo" />
                            Apoyo
                        </label>
                        <div id="modulos-apoyo" class="modulos" style="display: none;">

                            <label>
                                <input type="checkbox" name="acceso[]" value="procesosdeapoyo" /> Procesos de Apoyo
                            </label>
                            <label>
                                <input type="checkbox" name="acceso[]" value="procesosoperativos" /> Procesos Operativos
                            </label>
                            <label>
                                <input type="checkbox" name="acceso[]" value="controldocumental" /> Control documental
                            </label>
                        </div>

                        <!-- Documentacion de la operacion -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="documentaciondelaoperacion"
                                class="ck-subseccion" data-modulos="modulos-documentacion"
                                data-texto="Módulos de la sub-sección Documentación de la operación" />
                            Operación
                        </label>
                        <div id="modulos-documentacion" class="modulos" style="display: none;">
                            <label>
                                <input type="checkbox" name="acceso[]" value="mireservaciondeeventos" /> Mi reservación
                                de eventos
                            </label>
                            <label>
                                <input type="checkbox" name="acceso[]" value="cafeteriadeanfitriones" />
                                Café Kali
                            </label>
                        </div>

                        <!-- Evaluacion del desempeño -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="evaldesempeño" class="ck-subseccion"
                                data-modulos="modulos-evaluacion"
                                data-texto="Módulos de la sub-sección Evaluación del desempeño" />
                            Evaluacion del desempeño
                        </label>
                        <div id="modulos-evaluacion" class="modulos" style="display: none;">
                            <label>
                                <input type="checkbox" name="acceso[]" value="revenuereports" /> Revenue Reports
                            </label>
                            <label>
                                <input type="checkbox" name="acceso[]" value="balancescorecard" /> Balance Scorecard
                            </label>
                        </div>

                        <!-- Mejora -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="mejora" class="ck-subseccion"
                                data-modulos="modulos-mejora" data-texto="Módulos de la sub-sección Mejora" />
                            Mejora
                        </label>
                        <div id="modulos-mejora" class="modulos" style="display: none;">
                            <label>
                                <input type="checkbox" name="acceso[]" value="controlplanesdeaccion" /> Control planes de
                                accion
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="campo" id="Ambiental">
                        <legend>Accesos a Sub-Secciones SEGURIDAD AMBIENTAL</legend>

                        <!-- Residuos -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="residuos" class="ck-subseccion"
                                data-modulos="modulos-residuos" data-texto="Módulos de la sub-sección Residuos" />
                            Residuos
                        </label>
                        <div id="modulos-residuos" class="modulos" style="display: none;">
                            <label><input type="checkbox" name="acceso[]" value="controlderesiduos" /> Control de
                                Residuos</label>
                            <label><input type="checkbox" name="acceso[]" value="reportederesiduos" /> Reporte de
                                Residuos</label>
                        </div>

                        <!-- Energía -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="energia" class="ck-subseccion"
                                data-modulos="modulos-energia" data-texto="Módulos de la sub-sección Energía" />
                            Energía
                        </label>
                        <div id="modulos-energia" class="modulos" style="display: none;">
                            <label><input type="checkbox" name="acceso[]" value="controldeenergia" /> Control de
                                Energía</label>
                            <label><input type="checkbox" name="acceso[]" value="informaciondeenergia" /> Información
                                de Energía</label>
                        </div>

                        <!-- Agua -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="agua" class="ck-subseccion"
                                data-modulos="modulos-agua" data-texto="Módulos de la sub-sección Agua" />
                            Agua
                        </label>
                        <div id="modulos-agua" class="modulos" style="display: none;">
                            <label><input type="checkbox" name="acceso[]" value="controldeagua" /> Control de
                                Agua</label>
                            <label><input type="checkbox" name="acceso[]" value="informaciondeagua" /> Información de
                                Agua</label>
                        </div>

                        <!-- Aire -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="aire" class="ck-subseccion"
                                data-modulos="modulos-aire" data-texto="Módulos de la sub-sección Aire" />
                            Aire
                        </label>
                        <div id="modulos-aire" class="modulos" style="display: none;">
                            <label><input type="checkbox" name="acceso[]" value="controldeaire" /> Control de
                                Aire</label>
                            <label><input type="checkbox" name="acceso[]" value="informaciondeaire" /> Información de
                                Aire</label>
                        </div>

                        <!-- Sub-secciones sin módulos -->
                        <label><input type="checkbox" name="acceso[]" value="comunidad" class="ck-subseccion"
                                data-texto="Sub-sección Comunidad" /> Comunidad</label>
                        <label><input type="checkbox" name="acceso[]" value="ruido" class="ck-subseccion"
                                data-texto="Sub-sección Ruido" /> Ruido</label>
                        <label><input type="checkbox" name="acceso[]" value="suelo" class="ck-subseccion"
                                data-texto="Sub-sección Suelo" /> Suelo</label>
                        <label><input type="checkbox" name="acceso[]" value="recursosnaturales" class="ck-subseccion"
                                data-texto="Sub-sección Recursos Naturales" /> Recursos
                            Naturales</label>
                        <label><input type="checkbox" name="acceso[]" value="reportecontroldeenergeticos"
                                class="ck-subseccion" data-texto="Sub-sección Reporte de control de energéticos" />
                            Reporte de control de energéticos</label>
                    </fieldset>

                    <!-- Accesos sub-secciones Seguridad y salud -->
                    <fieldset class="campo" id="Salud">
                        <legend>Accesos a Sub-Secciones SEGURIDAD Y SALUD</legend>

                        <!-- Gestión -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="gestion" class="ck-subseccion"
                                data-texto="Sub-sección Gestión" />
                            Gestión
                        </label>

                        <!-- Atención a emergencias -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="atencionaemergencias" class="ck-subseccion"
                                data-texto="Sub-sección Atención a emergencias" />
                            Atención a emergencias
                        </label>

                        <!-- Higiene -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="higiene" class="ck-subseccion"
                                data-texto="Sub-sección Higiene" />
                            Higiene
                        </label>

                        <!-- Identificación y control de riesgos -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="identificacionycontrolderiesgos"
                                class="ck-subseccion" data-texto="Sub-sección Identificación y control de riesgos" />
                            Identificación y control de riesgos
                        </label>

                        <!-- Prevención en trabajos peligrosos -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="prevencionentrabajospeligrosos"
                                class="ck-subseccion" data-texto="Sub-sección Prevención en trabajos peligrosos" />
                            Prevención en trabajos peligrosos
                        </label>

                        <!-- Preservación de la salud -->
                    <label>
                        <input type="checkbox" name="acceso[]" value="perservaciondelasalud" class="ck-subseccion"
                            data-modulos="modulos-salud"
                            data-texto="Módulos de la sub-sección Preservación de la salud" />
                        Preservación de la salud
                    </label>
                    <div id="modulos-salud" class="modulos" style="display: none;">
                        <label><input type="checkbox" name="acceso[]" value="historialclinico" /> Historial
                            clínico</label>
                                <label><input type="checkbox" name="acceso[]" value="accidentes_enfermedades" /> Accidentes y enfermedades de trabajo</label>
                    </div>
                </fieldset>


                    <fieldset class="campo" id="Informacion">
                        <legend>Accesos a Sub-Secciones SEGURIDAD DE LA INFORMACIÓN</legend>

                        <label>
                            <input type="checkbox" name="acceso[]" value="drp" class="ck-subseccion"
                                data-texto="Sub-sección DRP" />
                            DRP
                        </label>

                        <label>
                            <input type="checkbox" name="acceso[]" value="controles" class="ck-subseccion"
                                data-texto="Sub-sección Controles" />
                            Controles
                        </label>

                        <label>
                            <input type="checkbox" name="acceso[]" value="riesgotecnologico" class="ck-subseccion"
                                data-texto="Sub-sección Riesgo tecnológico" />
                            Riesgo tecnológico
                        </label>

                        <label>
                            <input type="checkbox" name="acceso[]" value="mantenimiento" class="ck-subseccion"
                                data-texto="Sub-sección Mantenimiento" />
                            Mantenimiento
                        </label>

                        <label>
                            <input type="checkbox" name="acceso[]" value="bcp" class="ck-subseccion"
                                data-texto="Sub-sección BCP" />
                            BCP
                        </label>
                        <label>
                            <input type="checkbox" name="acceso[]" value="circulares" class="ck-subseccion"
                                data-texto="Sub-sección Circulares" />
                            Circulares
                        </label>
                    </fieldset>


                    <fieldset class="campo" id="Alimentaria">
                        <legend>Accesos a Sub-Secciones SEGURIDAD ALIMENTARIA</legend>

                        <label>
                            <input type="checkbox" name="acceso[]" value="cadenaalimentaria" class="ck-subseccion"
                                data-texto="Sub-sección Cadena Alimentaria" />
                            Cadena Alimentaria
                        </label>

                        <label>
                            <input type="checkbox" name="acceso[]" value="riesgosalimentarios" class="ck-subseccion"
                                data-texto="Sub-sección Riesgos Alimentarios" />
                            Riesgos Alimentarios
                        </label>

                        <label>
                            <input type="checkbox" name="acceso[]" value="manipulaciondealimentos" class="ck-subseccion"
                                data-texto="Sub-sección Manipulación de Alimentos" />
                            Manipulación de Alimentos
                        </label>

                        <!-- Medición con módulos -->
                        <label>
                            <input type="checkbox" name="acceso[]" value="medicion" class="ck-subseccion"
                                data-modulos="modulos-medicion" data-texto="Módulos de la sub-sección Medición" />
                            Medición
                        </label>
                        <label>
                            <input type="checkbox" name="acceso[]" value="inocuidad" class="ck-subseccion"
                                data-texto="Sub-sección Inocuidad" />
                            Inocuidad
                        </label>
                    </fieldset>


                    <!-- Selección de Carpetas a las que el usuario tendrá acceso -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">
                            📁 Seleccionar Carpetas a las que el usuario <strong>tendrá acceso</strong>
                        </label>

                        <!-- Barra de búsqueda -->
                        <input type="text" id="buscador-carpetas" placeholder="🔍 Buscar carpeta..."
                            class="w-full px-3 py-2 mt-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">

                        <!-- Filtro por ruta -->
                        <select id="filtro-ruta"
                            class="w-full px-3 py-2 mt-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Filtrar por seccion (Todas las secciones)</option>


                            <option value="procesos_operativos">Procesos Operativos</option>
                            <option value="procesos_de_apoyo">Procesos de Apoyo</option>
                            <!-- Aqui se agregaran las secciones que contendran carpetas -->
                        </select>

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
                                    <label class="flex items-center py-1 space-x-2 carpeta-item"
                                        data-ruta="{{ $carpeta->ruta }}">
                                        <input type="checkbox" name="carpetas_acceso[]" value="{{ $carpeta->id }}"
                                            class="carpeta-checkbox" checked>
                                        <span class="text-gray-700">{{ $carpeta->nombre_carpeta }}</span>
                                    </label>
                                @endforeach
                            @else
                                <p class="text-gray-500">No hay carpetas disponibles.</p>
                            @endif
                        </div>

                        <small class="block mt-2 text-gray-500">
                            Por defecto, el usuario <strong>TIENE ACCESO A TODAS LAS CARPETAS</strong>.
                            <br> <strong>DESMARCA</strong> las carpetas a las que NO podrá acceder.
                        </small>
                    </div>

                    <!-- Botón de registro -->
                    <div class="campo">
                        <input type="submit" value="Registrar" class="btn-registrar" />
                    </div>
                </form>
            </div>
        </div>



        <!-- SECCION PARA LA MODIFCIACION Y ELIMINACION de anfitriones  ESTE DIVV SE LLAMARA EL MODIFICADOR-->
        <div id="modificador-container" class="contenedor-externo-modificador-anfitriones">
            @include('administracion.modificadorUser')
        </div>

    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('📌 Script dinámico de selects cargado');

    const propiedadSelect = document.getElementById('propiedad_id');
    const departamentoSelect = document.getElementById('selectDepartamentoP');
    const puestoSelect = document.getElementById('selectPuestoP');

    if (!propiedadSelect || !departamentoSelect || !puestoSelect) {
        console.warn('⚠️ No se encontraron todos los selects requeridos');
        return;
    }

    propiedadSelect.addEventListener('change', () => {
        const propiedadId = propiedadSelect.value;
        console.log('🏨 Propiedad seleccionada:', propiedadId);

        if (!propiedadId) {
            departamentoSelect.innerHTML = '<option value="">Seleccione un departamento</option>';
            departamentoSelect.disabled = true;
            puestoSelect.innerHTML = '<option value="">Seleccione un puesto</option>';
            puestoSelect.disabled = true;
            return;
        }

        fetch(`/anfitriones/departamentos/${propiedadId}`)
            .then(response => response.json())
            .then(data => {
                departamentoSelect.innerHTML = '<option value="">Seleccione un departamento</option>';
                data.forEach(dep => {
                    departamentoSelect.innerHTML += `<option value="${dep.id}">${dep.departamento}</option>`;
                });
                departamentoSelect.disabled = false;
                puestoSelect.innerHTML = '<option value="">Seleccione un puesto</option>';
                puestoSelect.disabled = true;
            })
            .catch(error => console.error('❌ Error cargando departamentos:', error));
    });

    departamentoSelect.addEventListener('change', () => {
        const departamentoId = departamentoSelect.value;
        console.log('🏢 Departamento seleccionado:', departamentoId);

        if (!departamentoId) {
            puestoSelect.innerHTML = '<option value="">Seleccione un puesto</option>';
            puestoSelect.disabled = true;
            return;
        }

        fetch(`/anfitriones/puestos/${departamentoId}`)
            .then(response => response.json())
            .then(data => {
                puestoSelect.innerHTML = '<option value="">Seleccione un puesto</option>';
                data.forEach(puesto => {
                    puestoSelect.innerHTML += `<option value="${puesto.id}">${puesto.puesto}</option>`;
                });
                puestoSelect.disabled = false;
            })
            .catch(error => console.error('❌ Error cargando puestos:', error));
    });
});
</script>
@endpush

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
