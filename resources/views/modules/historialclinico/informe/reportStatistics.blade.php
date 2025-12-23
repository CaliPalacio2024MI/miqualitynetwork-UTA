<div id="mainContent">      
        @vite(['resources/css/modules/historialclinico/reportStatistics.css'])
    <div class="titulo">Estadísticos</div>

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
                @php
                    $enfermedades_fijas = [
                        // Heredofamiliares
                        'fimicos', 'luéticos', 'diabéticos', 'cardiópatas', 'epilépticos', 'oncologicos', 'malf_congen', 'atópicos',
                        // Personales Patológicos
                        'renales', 'cardiacos', 'hipertensos', 'lumbalgias', 'traumaticos', 'quirurgicos',
                        // Personales No Patológicos
                        'tabaquismo', 'alcoholismo', 'toxicomania', 'menarquia', 'ritmo', 'fum', 'disminorrea', 'ivsa', 'fup', 'doc', 'pf', 'g', 'p', 'c', 'a',
                    ];
                @endphp

            <div>
                <label for="opcion-input">Condición:</label>
                <input class="filtro-Enfermedad" list="opciones" name="opcion" id="opcion-input" placeholder="Busca una opción">
                <datalist id="opciones">
                    @foreach ($enfermedades_fijas as $enfermedad)
                        <option value="{{ ucfirst(str_replace('_', ' ', $enfermedad)) }}">
                    @endforeach
                    <!-- Los valores dinámicos se inyectarán por JS -->
                </datalist>
            </div>
            </div>
            <button onclick="filtrarTabla()">Filtrar</button>
            <button onclick="descargarGrafica()">Exportar</button>
        </div>
        <div class="botones">
                <div class="boton">
                <label>Total de Registros:</label>
                    <strong id="totalRegistros">{{ App\Modules\Historial_clinico\Models\Empleado::count() }}</strong>
                </div>
                <div class="boton">
                    <label>Incapacidades:</label>
                    Riesgo por Trabajo (RT): <strong id="rt">{{ App\Modules\Historial_clinico\Models\RiesgoTrabajo::where('riesgo', 'Si')->count() }}</strong><br>
                    Riesgo por Enfermedad (RE): <strong id="ec">{{ App\Modules\Historial_clinico\Models\RiesgoEnfermedad::where('enfermedad', 'Si')->count() }}</strong>
                </div>
                <div class="boton">
                    <label>Mas Enfermedades:</label>
                    <div id="prevalencia">
                    </div>
                </div>
                <div class="boton">
                    <label>Heredofamiliares:</label>
                    <div id="heredoTop" class="estadistica-card"></div>
                </div>
                <div class="boton">
                    <label>Semáforo Patologías:</label>
                    <div id="semaforo" style="width: 50px; height: 20px; background-color: green; margin: 5px auto;"></div>
                    <strong id="porcentajePatologia">0%</strong>
                </div>
        </div>

        <div class="contenedores">
            <div class="contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Genero</th>
                            <th>Propiedad</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Realizado</th>
                            <th>Actualizado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nombre = $nombre ?? null;
                            $genero = $genero ?? null;
                            $propiedad = $razon_social ?? null;
                            $departamento = $departamento ?? null;
                            $puesto = $puesto_aspirante ?? null;
                            $realizado = $created_at ?? null;
                            $actualizado = $updated_at ?? null;

                            $query = App\Modules\Historial_clinico\Models\Empleado::query();
                            if ($nombre) $query->where('nombre', $nombre);
                            if ($genero) $query->where('genero', $genero);
                            if ($propiedad) $query->where('razon_social', $razon_social);
                            if ($departamento) $query->where('departamento', $departamento);
                            if ($puesto) $query->where('puesto_aspirante', $puesto_aspirante);
                            if ($realizado) $query->where('created_at', $created_at);
                            if ($actualizado) $query->where('updated_at', $updated_at);
                            $personas = $query->get();
                        @endphp

                        @if ($personas->count() > 0)
                        @foreach ($personas as $persona)
                            <tr>
                                <td>{{ $persona->nombre }}</td>
                                <td>{{ $persona->genero }}</td>
                                <td>{{ $persona->razon_social }}</td>
                                <td>{{ $persona->departamento }}</td>
                                <td>{{ $persona->puesto_aspirante }}</td>
                                <td>{{ $persona->created_at }}</td>
                                <td>{{ $persona->updated_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="4">No se encontraron personas con los criterios especificados.</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="grafica-box">
                <div class="grafica-contenedor">
                    <canvas id="graficaCanvas"></canvas>
                </div>
            </div>
        </div>
    <script>

    </script>
    </body>
    </html> 
</div>  