@extends('layouts.dashboard')

@section('title', 'Control planes de accion')

@section('content')
<!--Barra superior-->
@include('modules/controlplan/layouts/topbar')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes de acción</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @vite('resources/css/modules/controlplan/topbar.css')
    @vite('resources/css/modules/controlplan/create.css')
    @vite('resources/js/modules/controlplan/create.js')
</head>
<body>
    <!--Modal de la vista previa-->

    @include('modules/controlplan/layouts/modal_preview')

    <!--Imagen de la propiedad-->
    <div>
        <!--img class="form-img" src="{{ asset('resources/images/mundo-imperial.png') }}" alt="princess"><br-->
    </div>

    <!--Formulario-->

    @if(Session::get('success'))
        <div id="success-msg" class="alert alert-success form-alert" role="alert">
            <p class="text-success text-alert">{{ Session::get('success') }}</p>
        </div>
    @endif

    @if(Session::get('error'))
        <div class="alert alert-danger form-alert" role="alert">
            <p class="text-danger text-alert">{{ Session::get('error') }}</p>
        </div>
    @endif

    <div class="form">
        <form name="actionsform" id="actform">
            <div>
                <table>
                    <tr>
                        <td>
                        <label class="left" for="source">Origen</label><br>
                            <select class="left form-box-size" name="source" id="origen">
                            <option value="Clima Laboral">Clima Laboral</option>
                            <option value="Evaluación de desempeño">Evaluación de desempeño</option>
                            <option value="Satisfacción del cliente">Satisfacción del cliente</option>
                            <option value="Auditoría externa">Auditoría externa</option>
                            <option value="Auditoría Interna">Auditoría Interna</option>
                            <option value="Verificación">Verificación</option>
                            <option value="Control de indicadores (Balance Score Card)">Control de indicadores (Balance Score Card)</option>
                            <option value="MI Customer Service">MI Customer Service</option>
                            <option value="Control de energéticos">Control de energéticos</option>
                            <option value="Gestión ambiental">Gestión ambiental</option>
                            <option value="Índice de Seguridad y Salud">Índice de Seguridad y Salud</option>
                            </select>
                            <!--span class="left" style="color:red">@error('source'){{ $message }} @enderror</span-->
                        </td>

                        <td>
                            <label class="right" for="solution">Tipo de solución</label><br>
                            <select class="right form-box-size" name="solution" id="solucion">
                            <option value="Acción correctiva">Acción correctiva</option>
                            <option value="Acción de mejora">Acción de mejora</option>
                            <option value="Corrección">Corrección</option>
                            </select>
                            <!--span class="right" style="color:red">@error('solution'){{ $message }} @enderror</span-->
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="left" for="property">Propiedad</label><br>
                            <select class="left form-box-size" name="property" id="propiedad">
                            <option value="Princess Mundo Imperial">Princess Mundo Imperial</option>
                            <option value="Palacio Mundo Imperial">Palacio Mundo Imperial</option>
                            <option value="Pierre Mundo Imperial">Pierre Mundo Imperial</option>
                            </select>
                            <!--span class="left" style="color:red">@error('property'){{ $message }} @enderror</span-->
                        </td>

                        <td>
                            <p class="right">Descripción de la solución</p>
                            <textarea class="right form-box-size" name="description" id="descripcion" rows="2" value="{{ old('description') }}"></textarea>
                            <!--span class="right" style="color:red">@error('description'){{ $message }} @enderror</span-->
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <p class="left">Proceso</p>
                            <input class="left form-box-size" type="text" name="process" id="proceso" value="{{ old('process') }}">
                            <!--span class="left" style="color:red">@error('process'){{ $message }} @enderror</span-->
                        </td>

                        <td>
                            <p class="right">Costo de la acción</p>
                            <input class="right form-box-size" type="text" name="cost" id="costo" placeholder="$" value="{{ old('cost') }}">
                            <!--span class="right"style="color:red">@error('cost'){{ $message }} @enderror</span-->
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p class="left">Oportunidad de mejora</p>
                            <input class="left form-box-size" type="text" name="opportunity" id="oportunidad" value="{{ old('opportunity') }}"><br>
                            <!--span class="left" style="color:red">@error('opportunity'){{ $message }} @enderror</span-->
                        </td>

                        <td>
                            <p class="right">Responsable(s)</p>
                            <input class="right form-box-size" type="text" name="responsible" id="responsable" value="{{ old('responsible') }}">
                            <!--span class="right" style="color:red">@error('responsible'){{ $message }} @enderror</span-->
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="left" for="concept">Criterio</label><br>
                            <select class="left form-box-size" name="concept" id="criterio">
                            <option value="Mayor">Mayor</option>
                            <option value="Menor">Menor</option>
                            <option value="O.M.">O.M.</option>
                            </select>
                            <!--span class="left" style="color:red">@error('concept'){{ $message }} @enderror</span-->
                        </td>

                        <td>
                            <p class="right">Fecha de inicio</p>
                            <input class="right form-box-size" type="date" name="begin" id="inicio"><br>
                            <!--span class="right" style="color:red">@error('begin'){{ $message }} @enderror</span-->
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p class="left">Causa raiz</p>
                            <textarea class="left form-box-size" name="cause" id="causa" rows="2" value="{{ old('cause') }}"></textarea><br>
                            <!--span class="left" style="color:red">@error('cause'){{ $message }} @enderror</span-->
                        </td>

                        <td>
                            <p class="right">Fecha de cumplimiento</p>
                            <input class="right form-box-size" type="date" name="end" id="fin"><br>
                            <!--span class="right" style="color:red">@error('end'){{ $message }} @enderror</span-->
                        </td>
                    </tr>
                </table>
            </div>

            <p class="comment">Observaciones</p>
            <textarea class="comment" name="comment" id="observaciones" rows="5" value="{{ old('comment') }}"></textarea><br>
            <!--span class="comment" style="color:red">@error('comment'){{ $message }} @enderror</span-->

            <!--input id="submit-btn" class="form-button" type="button" value="Guardar" onclick="saveActions();"-->
            <button id="saveactions" class="form-button">Guardar</button>

        </form>
    </div>

    <div class="table-section">
        <table id="actionstable" class="actions">
            <thead>
                <th>Origen</th>
                <th>Proceso</th>
                <th>Oportunidad de mejora</th>
                <th>Descripción de la solución</th>
                <th>Responsable</th>
                <th>Fecha de cumplimiento</th>    
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <button class="next-btn" id="modal-btn">Firmar</button>
   
</body>
@endsection