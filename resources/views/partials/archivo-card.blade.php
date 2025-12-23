@php
    // Obtener la extensión del archivo
    $extension = pathinfo($archivo->nombre_archivo, PATHINFO_EXTENSION);

    // Iconos por tipo de archivo
    $iconos = [
        'pdf' => ['icon' => 'heroicon-o-document', 'color' => 'text-red-500'],
        'doc' => ['icon' => 'heroicon-o-document-text', 'color' => 'text-blue-500'],
        'docx' => ['icon' => 'heroicon-o-document-text', 'color' => 'text-blue-500'],
        'xls' => ['icon' => 'heroicon-o-document-chart-bar', 'color' => 'text-green-500'],
        'xlsx' => ['icon' => 'heroicon-o-document-chart-bar', 'color' => 'text-green-500'],
        'ppt' => ['icon' => 'heroicon-o-presentation-chart-bar', 'color' => 'text-yellow-500'],
        'pptx' => ['icon' => 'heroicon-o-presentation-chart-bar', 'color' => 'text-yellow-500'],
        'txt' => ['icon' => 'heroicon-o-document-text', 'color' => 'text-gray-500'],
        'png' => ['icon' => 'heroicon-o-photo', 'color' => 'text-purple-400'],
        'jpg' => ['icon' => 'heroicon-o-photo', 'color' => 'text-purple-400'],
        'jpeg' => ['icon' => 'heroicon-o-photo', 'color' => 'text-purple-400'],
        'gif' => ['icon' => 'heroicon-o-photo', 'color' => 'text-purple-400'],
    ];

    $icono = $iconos[strtolower($extension)] ?? ['icon' => 'heroicon-o-document', 'color' => 'text-gray-500'];
@endphp

<style>
    .file-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .file-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="w-48 h-70 p-2 file-card" data-name="{{ strtolower($archivo->nombre_archivo) }}"
    data-type="{{ strtolower($extension) }}">
    <div class="block overflow-hidden transition-all duration-300 bg-white rounded-lg shadow-lg hover:shadow-xl">
        <!-- Se mantiene la información del archivo -->
        <div class="flex flex-col items-center justify-center h-40 p-4 cursor-pointer relative">
            <x-dynamic-component :component="$icono['icon']" class="w-12 h-12 {{ $icono['color'] }}" />
            <h6 class="w-full px-2 mt-3 text-sm font-semibold text-center break-words"
                title="{{ $archivo->nombre_archivo }}">
                {{ $archivo->nombre_archivo }}
            </h6>
            <!-- Botón de estado de firma: color de fondo se actualizará en función de la firma -->
            <button type="button" onclick="openStatusModal('modal-status-{{ $archivo->id_archivo }}')"
                class="absolute top-2 right-2 w-4 h-4 bg-gray-500 rounded-full">
            </button>
        </div>
        <div class="px-4 py-2 text-center bg-gray-100">
            <a href="{{ route('archivos.download', ['id' => $archivo->id_archivo]) }}"
                class="block w-full px-4 py-2 text-sm font-medium text-white transition-all bg-blue-500 rounded-md hover:bg-blue-600">
                📥 Descargar
            </a>
        </div>
        <div class="bg-gray-100 px-4 py-2 text-center">
            <a href="#" onclick="openSignModal('modal-{{ $archivo->id_archivo }}', '{{ $archivo->tipo_proceso }}')"
                class="block w-full text-white bg-yellow-500 hover:bg-yellow-700 px-4 py-2 rounded-md text-sm font-medium transition-all">
                Firmar
            </a>
        </div>
    </div>
</div>

<!-- Modal para firmar el archivo -->
<div id="modal-{{ $archivo->id_archivo }}"
    class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50 z-50">
    <div class="bg-white p-4 rounded shadow-lg w-96">
        <h3 class="text-lg font-bold mb-2">Firmar Archivo</h3>
        <!-- Formulario que contendrá la lista de responsables -->
        <form id="formSign-{{ $archivo->id_archivo }}">
            <div id="responsables-container-{{ $archivo->id_archivo }}" class="mb-4">
                <label for="responsable-select-{{ $archivo->id_archivo }}" class="block mb-1 font-medium">Seleccione
                    Responsable</label>
                <select name="responsable" id="responsable-select-{{ $archivo->id_archivo }}"
                    class="w-full border rounded px-2 py-1">
                    <option value="">Cargando responsables...</option>
                </select>
                <p id="error-message-{{ $archivo->id_archivo }}" class="mt-2 text-red-500 text-sm hidden">Error al
                    cargar datos.</p>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('modal-{{ $archivo->id_archivo }}')"
                    class="px-4 py-2 bg-blue-500 text-white rounded">Cerrar</button>
                <button type="button" onclick="signDocument('{{ $archivo->id_archivo }}')"
                    class="px-4 py-2 bg-green-500 text-white rounded">Firmar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para estado de firma -->
<div id="modal-status-{{ $archivo->id_archivo }}"
    class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50 z-50">
    <div class="bg-white p-4 rounded shadow-lg w-96">
        <h3 class="text-lg font-bold mb-2">Estado de Firma</h3>
        <!-- Sección que mostrará el estado de firma -->
        <div id="signature-status-{{ $archivo->id_archivo }}">
            <p>(0/{{ '{total}' }}) responsables han firmado</p>
            <table class="min-w-full text-xs text-left border mt-2" id="signature-table-{{ $archivo->id_archivo }}">
                <thead>
                    <tr>
                        <th class="px-2 py-1 border-b">Responsable</th>
                        <th class="px-2 py-1 border-b">Estado</th>
                        <th class="px-2 py-1 border-b">Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se llenará dinámicamente -->
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModal('modal-status-{{ $archivo->id_archivo }}')"
                class="px-4 py-2 bg-blue-500 text-white rounded">Cerrar</button>
        </div>
    </div>
</div>

<script>
    // Abre el modal para firmar e inicia la carga de responsables según el tipo de proceso
    function openSignModal(modalId, tipoProceso) {
        openModal(modalId);
        fetchResponsables(modalId, tipoProceso);
    }

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    // Función para cargar los responsables vía AJAX (endpoint a definir)
    function fetchResponsables(modalId, tipoProceso) {

        var archivoId = modalId.split('-')[1];
        var selectId = "responsable-select-" + archivoId;
        var errorId = "error-message-" + archivoId;

        fetch('/archivos/' + archivoId + '/responsables')
            .then(response => response.json())
            .then(data => {
                var select = document.getElementById(selectId);
                select.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(function (item) {
                        var option = document.createElement('option');
                        option.value = item;
                        option.text = item;
                        select.appendChild(option);
                    });
                } else {
                    var option = document.createElement('option');
                    option.value = "";
                    option.text = "No hay responsables disponibles";
                    select.appendChild(option);
                }
            })
            .catch(err => {
                document.getElementById(errorId).classList.remove('hidden');
            });
    }

    // Función provisional para el click en "Firmar" del formulario.
    // Por ahora solo imprime en consola; espera tus próximas órdenes para definir la acción.

    function signDocument(id) {
        var select = document.getElementById("responsable-select-" + id);
        var responsable = select.value;
        if (!responsable) {
            alert("Seleccione un responsable.");
            return;
        }

        fetch('/archivos/' + id + '/firmar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ responsable: responsable })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Documento firmado correctamente.");
                    closeModal('modal-' + id);
                    // Aquí puedes actualizar el estado de la firma en la UI si lo deseas
                } else {
                    alert(data.message || "Error al firmar.");
                }
            })
            .catch(() => {
                alert("Error al firmar.");
            });
    }


    // Función para abrir el modal de estado de firma.
    function openStatusModal(modalId) {
        openModal(modalId);
        var archivoId = modalId.split('-')[2];
        var signatureStatus = document.getElementById("signature-status-" + archivoId);
        var signatureTable = document.getElementById("signature-table-" + archivoId).getElementsByTagName('tbody')[0];

        fetch('/archivos/' + archivoId + '/estado-firmas')
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    signatureStatus.querySelector('p').innerText = "Error al cargar estado de firmas";
                    return;
                }

                let countFirmados = data.firmados;
                let totalResponsables = data.total;

                signatureStatus.querySelector('p').innerText = `(${countFirmados}/${totalResponsables}) responsables han firmado`;

                // Limpiar la tabla
                signatureTable.innerHTML = '';

                data.firmas.forEach(function (firma) {
                    var row = document.createElement('tr');

                    // Responsable
                    var tdNombre = document.createElement('td');
                    tdNombre.className = "px-2 py-1 border-b";
                    tdNombre.innerText = firma.nombre;
                    row.appendChild(tdNombre);

                    // Estado
                    var tdEstado = document.createElement('td');
                    tdEstado.className = "px-2 py-1 border-b font-semibold";
                    if (firma.firmado) {
                        tdEstado.innerHTML = '<span class="text-green-600">Firmado</span>';
                    } else {
                        tdEstado.innerHTML = '<span class="text-gray-500">Pendiente</span>';
                    }
                    row.appendChild(tdEstado);

                    // Fecha y Hora
                    var tdFecha = document.createElement('td');
                    tdFecha.className = "px-2 py-1 border-b";
                    tdFecha.innerText = firma.fecha ? firma.fecha : '-';
                    row.appendChild(tdFecha);

                    signatureTable.appendChild(row);
                });

                // Cambia el color de la bolita
                var dotButton = document.querySelector("button[onclick*=\"modal-status-" + archivoId + "\"]");
                if (countFirmados === 0) {
                    dotButton.classList.remove('bg-orange-500', 'bg-green-500');
                    dotButton.classList.add('bg-gray-500');
                } else if (countFirmados < totalResponsables) {
                    dotButton.classList.remove('bg-gray-500', 'bg-green-500');
                    dotButton.classList.add('bg-orange-500');
                } else {
                    dotButton.classList.remove('bg-gray-500', 'bg-orange-500');
                    dotButton.classList.add('bg-green-500');
                }
            })
            .catch(() => {
                signatureStatus.querySelector('p').innerText = "Error al cargar estado de firmas";
            });
    }
</script>