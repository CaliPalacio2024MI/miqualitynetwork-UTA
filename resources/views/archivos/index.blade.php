@extends('layouts.dashboard')
@section('content')
    @vite(['resources/js/gestion_archivos.js', 'resources/css/gestiondearchivos.css'])
    <div class="max-h-full px-6 py-8 mx-auto contenedor-global-carpetas">
        <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
            Gestión de Archivos
        </h2>


        @if (session('error'))
            <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- botones para activar los formularios -->
        <div class="flex flex-wrap gap-4 mb-6">
            <button onclick="toggleForm('crearCarpetaForm', this)" class="px-4 py-2 rounded-md btn-seccion">
                📁 Crear Nueva Carpeta
            </button>
            <button onclick="toggleForm('crearSubcarpetaForm', this)" class="px-4 py-2 rounded-md btn-seccion">
                📂 Crear Subcarpeta
            </button>
            <button onclick="toggleForm('subirArchivosForm', this)" class="px-4 py-2 rounded-md btn-seccion">
                📤 Subir Archivos
            </button>
            <button onclick="toggleForm('editarArchivoForm', this)" class="px-4 py-2 rounded-md btn-seccion">
                ✏️ Editar Archivo
            </button>
        </div>


        <div id="crearCarpetaForm" class="hidden p-4 mb-6 bg-white rounded-lg shadow-lg form-container">
            <h4 class="mb-4 text-lg font-semibold">📁 Crear Nueva Carpeta</h4>

            <!-- Preguntar si la carpeta es un proceso -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">¿El nombre de la carpeta es un proceso?</label>
                <div class="flex gap-4">
                    <button type="button"
                        class="px-4 py-2 text-white transition-all scale-95 bg-blue-500 rounded-md btn-proceso hover:bg-blue-600 active"
                        onclick="setProceso(false, this)">No</button>
                    <button type="button"
                        class="px-3 py-1.5 text-white transition-all bg-gray-500 rounded-md btn-proceso hover:bg-gray-600 "
                        onclick="setProceso(true, this)">Sí</button>
                </div>
            </div>

            <form action="{{ route('carpetas.store') }}" method="POST">
                @csrf

                <!-- Campo para seleccionar proceso (Se oculta por defecto) -->
                <div id="campoProceso" class="hidden mb-4">
                    <label class="block text-sm font-medium text-gray-700">Proceso Asociado</label>
                    <select name="proceso_id" id="proceso_id"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">Seleccione un proceso</option>
                        @foreach ($procesos as $proceso)
                            <option value="{{ $proceso->id_proceso }}">{{ $proceso->nombre_proceso }}
                                ({{ ucfirst($proceso->tipo) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <form action="{{ route('carpetas.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="nombre_es_proceso" name="nombre_es_proceso" value="false">

                    <!-- Campo oculto para el proceso_id -->
                    <input type="hidden" id="hidden_proceso_id" name="proceso_id" value="">

                    <!-- Campo para ingresar nombre de la carpeta -->
                    <div id="campoNombreCarpeta" class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nombre de la Carpeta</label>
                        <input type="text" name="nombre_carpeta" id="nombre_carpeta"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <!-- RESPONSABLE(S) DE ALMACENAMIENTO -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Responsables de almacenamiento
    </label>

    <div id="responsables-container">
        <div class="flex gap-2 mb-2 responsable-row">
            <select name="responsables[]" class="block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Seleccione un responsable</option>
                <!-- Aquí puedes insertar opciones dinámicamente desde el controlador -->
                <option value="1">Responsable 1</option>
                <option value="2">Responsable 2</option>
                <option value="3">Responsable 3</option>
            </select>
        </div>
    </div>

    <button type="button"
        onclick="agregarResponsable()"
        class="mt-2 px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
        + Añadir responsable
    </button>
</div>





                    <!-- Sección y Subsección -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Sección</label>
                        <select name="seccion" id="seccionCarpeta"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Seleccione una sección</option>
                            <option value="calidad">Calidad</option>
                            <option value="seguridad_ambiental">Seguridad Ambiental</option>
                            <option value="seguridad_salud">Seguridad y Salud</option>
                            <option value="seguridad_informacion">Seguridad de la Información</option>
                            <option value="seguridad_alimentaria">Seguridad Alimentaria</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Subsección</label>
                        <select name="subseccion" id="subseccionCarpeta"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Seleccione una subsección</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 text-white transition-all bg-blue-600 rounded-md hover:bg-blue-700">
                        📁 Crear Carpeta
                    </button>
                </form>
        </div>

        <div id="crearSubcarpetaForm" class="hidden p-4 mb-6 bg-white rounded-lg shadow-lg form-container">
            <h4 class="mb-4 text-lg font-semibold">📂 Crear Subcarpeta</h4>
            <form action="{{ route('carpetas.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nombre de la Subcarpeta</label>
                    <input type="text" name="nombre_carpeta" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                        required>
                </div>
                <!-- RESPONSABLE(S) DE ALMACENAMIENTO -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Responsables de almacenamiento
    </label>

    <div id="responsables-container2">
        <div class="flex gap-2 mb-2 responsable-row">
            <select name="responsables[]" class="block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Seleccione un responsable</option>
                <!-- Aquí puedes insertar opciones dinámicamente desde el controlador -->
                <option value="1">Responsable 1</option>
                <option value="2">Responsable 2</option>
                <option value="3">Responsable 3</option>
            </select>
        </div>
    </div>

    <button type="button"
        onclick="agregarResponsable2()"
        class="mt-2 px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
        + Añadir responsable
    </button>
</div>


                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Carpeta Principal</label>
                    <select name="parent_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">Selecciona una carpeta principal</option>
                        @foreach ($carpetas as $carpeta)
                            <option value="{{ $carpeta->id }}">{{ $carpeta->nombre_carpeta }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="w-full px-4 py-2 text-white transition-all bg-blue-600 rounded-md hover:bg-blue-700">
                    📂 Crear Subcarpeta
                </button>
            </form>
        </div>

        <div id="subirArchivosForm" class="hidden p-4 mb-6 bg-white rounded-lg shadow-lg form-container">
            <h4 class="mb-4 text-lg font-semibold">📤 Subir Archivos</h4>
            <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Selecciona Archivos</label>
                    <input type="file" name="archivos[]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                        multiple required>
                </div>

                <!-- Selector de Carpeta en el formulario de Subir Archivos -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Selecciona la Carpeta</label>
                        <select name="carpeta_id" id="carpeta_id"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Seleccione una carpeta</option>
                            @foreach ($carpetas as $carpeta)
                                <option value="{{ $carpeta->id }}" data-proceso="{{ $carpeta->proceso_id }}"
                                    data-seccion="{{ $carpeta->seccion }}" data-subseccion="{{ $carpeta->subseccion }}">
                                    {{ $carpeta->nombre_carpeta }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Selecciona la Subcarpeta
                            (Opcional)</label>
                        <select name="subcarpeta_id" id="subcarpeta_id"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione una subcarpeta</option>
                        </select>
                    </div>
                </div>
<!-- RESPONSABLE -->
<div class="mb-4">
    <label for="subseccionArchivo" class="block text-sm font-medium text-gray-700">
        Responsable
    </label>
    <select name="subseccion" id="subseccionArchivo"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            required>
        <option value="">Responsable</option>
        <!-- Aquí se llenan dinámicamente las subsecciones -->
    </select>
</div>

                <!-- Sección y Subsección organizadas en un mismo renglón -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sección</label>
                        <select name="seccion" id="seccionArchivo"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Seleccione una sección</option>
                            <option value="calidad">Calidad</option>
                            <option value="seguridad_ambiental">Seguridad Ambiental</option>
                            <option value="seguridad_salud">Seguridad y Salud</option>
                            <option value="seguridad_informacion">Seguridad de la Información</option>
                            <option value="seguridad_alimentaria">Seguridad Alimentaria</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subsección</label>
                        <select name="subseccion" id="subseccionArchivo"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Seleccione una subsección</option>
                        </select>
                    </div>
                </div>


                <!-- Bloque 2: Datos adicionales (metadatos) -->
                <div class="mb-6">
                    <!-- Primera línea: Procesos, Tipo de Información, Identificación y Medio de Soporte -->
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Procesos</label>
                            <select name="tipo_proceso" id="tipo_proceso"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Seleccione un proceso</option>
                                @foreach ($procesos as $proceso)
                                    <option value="{{ $proceso->nombre_proceso }}">
                                        {{ $proceso->nombre_proceso }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipo de Información Documentada</label>
                            <select name="tipo_documento" id="tipo_documento"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="Externa">Externa</option>
                                <option value="Interna">Interna</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Identificación</label>
                            <select name="identificacion" id="identificacion"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Identificacion</option>
                                <option value="Por Nombre">Por Nombre</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Medio de Soporte</label>
                            <select name="medio_soporte" id="medio_soporte"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Carpeta Electrónica">Carpeta Electrónica</option>
                                <option value="Carpeta Física">Carpeta Física</option>
                            </select>
                        </div>
                    </div>

                    <div class="hidden">
                        <select name="disposicion_final" id="disposicion_final">
                            <option value="Destrucción">Destrucción</option>
                            <option value="Eliminación/Supresión">Eliminación/Supresión</option>
                        </select>
                    </div>

                    <!-- Responsable en renglón completo -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Responsable de Almacenamiento</label>
                        <select name="responsable_almacenamiento" id="responsable_almacenamiento"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Seleccione un responsable</option>

                        </select>
                    </div>

                    <!-- Tercera línea: Tiempo, Fecha, Número de Edición y Estatus Actual en la misma línea -->
                    <div class="grid grid-cols-4 gap-4">
                        <div class="flex gap-2">
                            <div class="w-1/2">
                                <label class="block text-sm font-medium text-gray-700">Tiempo de Conservación</label>
                                <select name="tiempo_numero" id="tiempo_numero"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">N°</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                                <select name="tiempo_unidad" id="tiempo_unidad"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Unidad</option>
                                    <option value="día">Día</option>
                                    <option value="mes">Mes</option>
                                    <option value="año">Año</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha de Emisión</label>
                            <input type="date" name="fecha_emision" id="fecha_emision"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required value="{{ date('Y-d-m') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Número de Edición</label>
                            <select name="edicion" id="edicion"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Seleccione una edición</option>
                                @for ($i = 0; $i <= 50; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">
                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estatus Actual</label>
                            <div class="flex items-center mt-1">
                                <input type="checkbox" name="estatus_actual" id="estatus_actual" value="Vigente"
                                    class="text-blue-600 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200"
                                    checked>
                                <label for="estatus_actual" class="ml-2 text-sm text-gray-700">Vigente</label>
                            </div>
                            <input type="hidden" name="estatus_actual_hidden" value="Obsoleto">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                    📤 Subir Archivos
                </button>
            </form>
        </div>



        <div id="editarArchivoForm" class="hidden p-4 mb-6 bg-white rounded-lg shadow-lg form-container">
            <h4 class="mb-4 text-lg font-semibold">✏️ Editar Archivo</h4>

            <!-- Formulario de edición -->
            <form id="formEdicion" action="{{ route('archivos.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6" id="seleccionarArchivo">
                    <h4 class="mb-4 text-lg font-semibold">📄 Archivos Disponibles</h4>
                    <!-- Buscador de archivo y selector en full width -->
                    <div class="mb-4">
                        <label for="search_archivo" class="block text-sm font-medium text-gray-700">Buscar Archivo</label>
                        <input type="text" id="search_archivo" placeholder="Ingrese nombre del archivo"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <select id="archivo_id" name="archivo_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                        required>
                        <option value="">Seleccione un archivo</option>
                        @foreach ($archivos as $archivo)
                            @if ($archivo->estatus_actual === 'Vigente' && empty($archivo->responsable_eliminacion))
                                <option value="{{ $archivo->id_archivo }}">{{ $archivo->nombre_archivo }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!-- RESPONSABLE -->
<div class="mb-4">
    <label for="subseccionArchivo" class="block text-sm font-medium text-gray-700">
        Responsable
    </label>
    <select name="subseccion" id="subseccionArchivo"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            required>
        <option value="">Responsable</option>
        <!-- Aquí se llenan dinámicamente las subsecciones -->
    </select>
</div>

                <!-- Campo de Cambio realizado in full width -->
                <div class="mb-4">
                    <label for="cambio_realizado" class="block text-sm font-medium text-gray-700">Cambio Realizado</label>
                    <textarea name="cambio_realizado" id="cambio_realizado"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <!-- Nueva Edición, Nueva Fecha de Emisión y Responsable de Cambio in a misma línea -->
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="nueva_edicion" class="block text-sm font-medium text-gray-700">Nueva Edición</label>
                        <select name="nueva_edicion" id="nueva_edicion"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione una edición</option>
                            @for ($i = 0; $i <= 50; $i++) <!-- Puedes ajustar el rango según sea necesario -->
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="nueva_fecha_emision" class="block text-sm font-medium text-gray-700">Nueva Fecha de
                            Emisión</label>
                        <input type="date" name="nueva_fecha_emision" id="nueva_fecha_emision"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" value="{{ date('Y-d-m') }}">
                    </div>
                    <div>
                        <label for="responsable_cambio" class="block text-sm font-medium text-gray-700">Responsable de
                            Cambio</label>
                        <select name="responsable_cambio" id="responsable_cambio"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione un responsable</option>
                            <!-- Opciones se llenan por JS -->
                        </select>
                    </div>
                </div>

                <!-- Subir nuevo archivo in full width -->
                <div class="mb-4">
                    <label for="nuevo_archivo" class="block text-sm font-medium text-gray-700">Subir Nuevo Archivo</label>
                    <input type="file" name="nuevo_archivo" id="nuevo_archivo"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Botón para guardar cambios -->
                <div class="mb-4">
                    <button type="submit" class="w-full px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                        📤 Guardar Cambios
                    </button>
                </div>
            </form>
        </div>

        <script>

    function agregarResponsable() {
        const container = document.getElementById('responsables-container');
        const row = container.querySelector('.responsable-row').cloneNode(true);
        container.appendChild(row);
    }
    function agregarResponsable2() {
        const container = document.getElementById('responsables-container2');
        const row = container.querySelector('.responsable-row').cloneNode(true);
        container.appendChild(row);
    }

            // Buscador tipo "live filter" para el select de archivos
            document.getElementById('search_archivo').addEventListener('input', function () {
                const filter = this.value.toLowerCase();
                const select = document.getElementById('archivo_id');
                let firstVisible = null;
                for (let i = 0; i < select.options.length; i++) {
                    const option = select.options[i];
                    if (i === 0) { // Siempre muestra el placeholder
                        option.style.display = '';
                        continue;
                    }
                    if (option.text.toLowerCase().includes(filter)) {
                        option.style.display = '';
                        if (!firstVisible) firstVisible = i;
                    } else {
                        option.style.display = 'none';
                    }
                }
                // Selecciona automáticamente el primer resultado visible (opcional)
                if (firstVisible) {
                    select.selectedIndex = firstVisible;
                } else {
                    select.selectedIndex = 0;
                }
            });
            // Relaciona proceso_id (de carpetas) con nombre_proceso
            window.procesosList = @json($procesos->pluck('nombre_proceso', 'id_proceso'));

            document.getElementById('search_archivo').addEventListener('keyup', function () {
                var filter = this.value.toLowerCase();
                var select = document.getElementById('archivo_id');
                var options = select.options;
                for (var i = 0; i < options.length; i++) {
                    if (options[i].text.toLowerCase().includes(filter) && options[i].value !== "") {
                        select.selectedIndex = i;
                        break;
                    }
                }
            });

            document.getElementById('proceso_id').addEventListener('change', function () {
                document.getElementById('hidden_proceso_id').value = this.value;
            });


            // Mapeo: id_proceso -> [responsable1, responsable2, responsable3] (filtra nulos)
            window.procesosResponsables = {!! json_encode(
        $procesos->keyBy('id_proceso')
            ->map(function ($p) {
                return array_filter([$p->responsable1, $p->responsable2, $p->responsable3]);
            })
    ) !!};


            document.getElementById('carpeta_id').addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                // Obtener atributos de la carpeta
                const procesoId = selectedOption.getAttribute('data-proceso');
                const seccionValue = selectedOption.getAttribute('data-seccion');
                const subseccionValue = selectedOption.getAttribute('data-subseccion');

                // Actualizar el select de sección de archivo
                if (seccionValue) {
                    document.getElementById('seccionArchivo').value = seccionValue;
                }
                // Actualizar el select de subsección de archivo
                if (subseccionValue) {
                    document.getElementById('subseccionArchivo').value = subseccionValue;
                }

                // Actualizar el select de procesos (tipo_proceso) automáticamente
                if (procesoId && procesosNames[procesoId]) {
                    const processNameDB = procesosNames[procesoId]; // ej. "control_documental"
                    const tipoProcesoSelect = document.getElementById('tipo_proceso');
                    for (let i = 0; i < tipoProcesoSelect.options.length; i++) {
                        // Normaliza el texto de la opción para compararlo
                        if (normalize(tipoProcesoSelect.options[i].text) === processNameDB) {
                            tipoProcesoSelect.selectedIndex = i;
                            break;
                        }
                    }
                }

                // Actualizar el campo oculto de proceso si fuera necesario
                // Por ejemplo, si tienes un hidden para el proceso, actualízalo:
                const hiddenProceso = document.getElementById('hidden_proceso_id');
                if (hiddenProceso) {
                    hiddenProceso.value = procesoId;
                }

            });

            // Actualiza el campo oculto con el valor seleccionado en el select de procesos
            document.getElementById('select_proceso').addEventListener('change', function () {
                var procesoId = this.value;
                document.getElementById('hidden_proceso_id').value = procesoId;
            });
        </script>
        <script>
            // Suponiendo que cada proceso tiene campos: responsable1, responsable2 y responsable3
            const procesosResponsables = {!! json_encode(
        $procesos->keyBy('id_proceso')
            ->map(function ($p) {
                return array_filter([$p->responsable1, $p->responsable2, $p->responsable3]);
            })
    ) !!};

            // Función que actualiza el select de responsables según el proceso asociado a la carpeta seleccionada
            function updateResponsables() {
                const carpetaSelect = document.getElementById('carpeta_id');
                const responsableSelect = document.getElementById('responsable_almacenamiento');

                // Obtén la carpeta seleccionada y su atributo data-proceso
                const selectedOption = carpetaSelect.options[carpetaSelect.selectedIndex];
                const procesoId = selectedOption ? selectedOption.getAttribute('data-proceso') : null;

                // Si hay un proceso asociado, repuebla el select de responsables
                if (procesoId && procesosResponsables[procesoId]) {
                    // Construye las opciones sin borrarlas si ya están presentes,
                    // o bien fuerza su actualización:
                    let html = '<option value="">Seleccione un responsable</option>';
                    procesosResponsables[procesoId].forEach(function (resp) {
                        if (resp) {
                            html += `<option value="${resp}">${resp}</option>`;
                        }
                    });
                    responsableSelect.innerHTML = html;
                } else {
                    // Si no hay proceso, se asegura de tener al menos el placeholder
                    responsableSelect.innerHTML = '<option value="">Seleccione un responsable</option>';
                }
            }

            // Asocia el evento change al select de carpeta para actualizar los responsables
            document.getElementById('carpeta_id').addEventListener('change', function () {
                updateResponsables();
            });

            // En caso de que ya haya una carpeta seleccionada al cargar la página, actualiza los responsables
            document.addEventListener('DOMContentLoaded', function () {
                updateResponsables();
            });

            // Usa el mismo objeto procesosResponsables ya definido
            // Mapea id_proceso => [responsable1, responsable2, responsable3]
            const archivosProcesos = {!! json_encode(
        $archivos->pluck('proceso_id', 'id_archivo')
    ) !!};

            document.getElementById('archivo_id').addEventListener('change', function () {
                const archivoId = this.value;
                const procesoId = archivosProcesos[archivoId];
                const responsables = procesosResponsables[procesoId] || [];
                const responsableCambioSelect = document.getElementById('responsable_cambio');

                let html = '<option value="">Seleccione un responsable</option>';
                responsables.forEach(function (resp) {
                    if (resp) {
                        html += `<option value="${resp}">${resp}</option>`;
                    }
                });
                responsableCambioSelect.innerHTML = html;
            });

            // Si quieres que al cargar la página ya esté seleccionado el responsable si hay archivo seleccionado:
            document.addEventListener('DOMContentLoaded', function () {
                const archivoSelect = document.getElementById('archivo_id');
                if (archivoSelect.value) {
                    archivoSelect.dispatchEvent(new Event('change'));
                }
            });
        </script>

        <!-- Sección para mostrar carpetas creadas -->
        <div class="mt-8 contenedor-carpetas-creadas">
            <h3 class="mb-4 text-xl font-bold">📁 Carpetas Creadas</h3>
            <!-- Barra de búsqueda de carpetas -->
            <div class="mb-4">
                <input type="text" id="busquedaCarpeta" placeholder="Buscar carpeta..."
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div class="flex flex-wrap gap-4 contenido-carpetas">
                @foreach ($carpetas as $carpeta)
                    @if (is_null($carpeta->parent_id))
                        <div class="folder-container" data-nombre="{{ strtolower($carpeta->nombre_carpeta) }}">
                            <a href="{{ route('admin.carpeta', ['seccion' => $carpeta->seccion, 'carpeta_id' => $carpeta->id]) }}"
                                class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200">
                                <img src="{{ asset('images/carpeta.png') }}" alt="Carpeta" class="w-8 h-8 mr-2">
                                <span>{{ $carpeta->nombre_carpeta }}</span>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection