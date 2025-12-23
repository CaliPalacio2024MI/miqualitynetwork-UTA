<div id="mainContent">      
        @vite(['resources/css/modules/historialclinico/reportContent.css'])
    <div class="titulo">Reporte</div>
        <div class="filtros">
                <div>
                    <label for="propiedad">Propiedad:</label>
                        <select name="propiedad" class="line-input" id="propiedad" required>
                            <option value="">Todos</option>
                                @php
                                    $propiedades = App\Models\Propiedades::all();
                                @endphp
                            @foreach($propiedades as $propiedad)
                                <option value="{{ $propiedad->nombre_propiedad }}">{{ $propiedad->nombre_propiedad }}</option>
                            @endforeach
                        </select>
                </div>
                <div>
                    <label for="departamento">Departamento:</label>
                    <select id="departamento" name="departamento">
                        <option value="">Todos</option>
                    </select>
                </div>
                <div>
                    <label for="puesto">Puesto:</label>
                    <select id="puesto" name="puesto">
                        <option value="">Todos</option>
                    </select>
                </div>
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del empleado">
                </div>
                <button onclick="reporteTabla()">Filtrar</button>
            </div>
        <div class="contenedores">
            <div class="contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Género</th>
                            <th>Propiedad</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Realización</th>
                            <th>Historial de Actualizaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nombre = $nombre ?? null;
                            $puesto_aspirante = $puesto_aspirante ?? null;
                            $departamento = $departamento ?? null;
                            $query = App\Modules\Historial_clinico\Models\Empleado::query();

                            if ($nombre) $query->where('nombre', $nombre);
                            if ($puesto_aspirante) $query->where('puesto_aspirante', $puesto_aspirante);
                            if ($departamento) $query->where('departamento', $departamento);

                            $personas = $query->get();
                        @endphp

                        @if ($personas->count() > 0)
                            @foreach ($personas as $persona)
                                <tr>
                                    <td>{{ $persona->nombre }}</td>
                                    <td>{{ $persona->genero ?? 'N/A' }}</td>
                                    <td>{{ $persona->razon_social ?? 'N/A' }}</td> <!-- Propiedad está relacionado con estado_civil -->
                                    <td>{{ $persona->departamento }}</td>
                                    <td>{{ $persona->puesto_aspirante ?? 'N/A' }}</td>
                                    <td>{{ $persona->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $persona->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button class="btn-editar" onclick="mostrarRegistro({{ $persona->id }})">
                                            <img src="{{ asset('images/ojo.png') }}" alt="ojo-icon" class="iconos">
                                        </button>
                                        <button class="btn-editar" onclick="editRegister({{ $persona->id }})">
                                            <img src="{{ asset('images/editar.png') }}" alt="editar-icon" class="iconos">
                                        </button>
                                        <a class="btn-editar" href="/empleado/pdf/{{ $persona->id }}">
                                            <img src="{{ asset('images/descargar.png') }}" alt="descargar-icon" class="iconos"> 
                                        </a>                                        
                                    </td>   

                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="6">No se encontraron personas con los criterios especificados.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <button class="btn-descargar" onclick="descargarReporte()">
            <label>Descargar Reporte</label>
            <img src="{{ asset('images/descargar.png') }}" alt="descargar-icon" class="iconos"> 
        </button>

        @include('modules.historialclinico.informe.registrosEmpleados')
        <!-- Modal contenedor -->
        <div id="editModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="reportContent"></div> <!-- Aquí se carga el formulario -->
        </div>
    </div>
</div>      
