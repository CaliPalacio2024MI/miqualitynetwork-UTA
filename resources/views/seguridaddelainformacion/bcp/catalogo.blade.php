@extends('layouts.app')
@section('title', 'Catálogo')
@section('content')
@vite(['resources/js/bcp/catalogo.js'])

@vite(['resources/css/bcp/app.css', 'resources/js/bcp/app.js'])
@include('seguridaddelainformacion.bcp.layouts.barra')

@if(session('success'))
<div id="modalSuccess" class="modal">
    <div class="modal-content">
        <p>{{ session('success') }}</p>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

@if(session('error'))
<div id="modalError" class="modal">
    <div class="modal-content">
        <p>{{ session('error') }}</p>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

@if ($errors->any())
<div id="modalError" class="modal">
    <div class="modal-content">
        <ul>
            @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

<div class="container_entero">
    <h2>CATÁLOGO</h2>

    <div class="flex space-x-6 justify-between w-[70%] mx-auto">

        <!-- Sección Izquierda: Crear Habitación -->

        <div class="w-[400px] bg-white p-6 rounded-lg shadow-md text-center">
            <h2 class="text-xl font-semibold mb-4">Crear Habitación</h2>

            <form id="cuentaForm" method="POST" action="{{ route('catalogo.store') }}" class="space-y-4 text-left">
                @csrf

                <!-- Número de habitación -->
                <div>
                    <label for="num_habitacion">Número de la Habitación</label> <!--class="block text-sm mb-1"-->
                    <input type="number" name="N_Hab" value="{{ old('N_Hab') }}" required>
                </div>

                <!-- Tipo de habitación -->
                <div>
                    <label>Tipo de Habitación</label>
                    <select name="Tp_Hab" required>
                        <option value="">Seleccionar </option>
                        <option value="HDOA">HNDCAP DBL INT (HDOA)</option>
                        <option value="HKOA">HNDCAP KING INT (HKOA)</option>
                        <option value="IKOA">IMP KING INT (IKOA)</option>
                        <option value="JDOA">JR DBL INTERIOR (JDOA)</option>
                        <option value="JDUA">JR DBL EXTERIOR (JDUA)</option>
                        <option value="JKOA">JR KING INTERIO (JKOA)</option>
                        <option value="JKUA">JR KING EXTERIO (JKUA)</option>
                        <option value="MKOA">MSTR KING INTER (MKOA)</option>
                        <option value="MKUA">MSTR KING EXTER (MKUA)</option>
                        <option value="PDOA">PH DBL INTERIOR (PDOA)</option>
                        <option value="PKOA">PH KING EXT (PKOA)</option>
                        <option value="PKUA">PH KING INT (PKUA)</option>
                        <option value="SDUA">SUP DBL EXT (SDUA)</option>
                        <option value="SKUA">SUP KING EXT (SKUA)</option>
                        <option value="TDOA">CLUB 89 DBL INT (TDOA)</option>
                        <option value="TDUA">CLUB 89 DBL EXT (TDUA)</option>
                        <option value="TKOA">CLUB 89 KING INT (TKOA)</option>
                        <option value="TKUA">CLUB 89 KING EXT (TKUA)</option>
                        <option value="WKOA">OWN KING INT (WKOA)</option>
                        <option value="XDOA">DLX DBL INT (XDOA)</option>
                        <option value="XKOA">DLX KING INT (XKOA)</option>
                    </select>
                </div>

                <!-- Edificio -->
                <div>
                    <label>Edificio de la Habitación</label>
                    <select name="Edificio" required> <!--class="w-full border border-gray-300 rounded px-3 py-2"-->
                        <option value="">Seleccionar </option>
                        <option value="A">A </option>
                        <option value="B">B </option>
                        <option value="C">C </option>
                        <option value="D">D </option>
                    </select>
                </div>

                <!-- Piso -->
                <div>
                    <label for="piso_habitacion">Piso de la Habitación</label>
                    <input type="number" name="Piso" value="{{ old('Piso') }}" required>
                </div>

                <!-- Créditos -->
                <div class="flex justify-between space-x-4">
                    <div class="w-1/2">
                        <label>Créditos en Pasajes</label>
                        <input type="number" name="Cred_Pasaje" placeholder="0" value="{{ old('Cred_Pasaje') }}" required>
                    </div>
                    <div class="w-1/2">
                        <label>Créditos en Salidas</label>
                        <input type="number" name="Cred_Salida" placeholder="0" value="{{ old('Cred_Salida') }}" required>
                    </div>
                </div>

                <!-- Botón -->
                <div class="text-center pt-2">
                    <button type="submit">
                        Guardar
                    </button>
                </div>
            </form>
        </div>


        <!-- Sección Derecha: Habitaciones Existentes -->

        <div class="flex-1 bg-white p-6 rounded-lg shadow-md text-center" id="bloque-formulario">

            <h2 class="text-xl font-semibold mb-4">Habitaciones Existentes</h2>

            <div class="top section" id="buscador-bloque">
                <input type="text" id="buscar-habitacion" name="buscar-habitacion" placeholder="Buscar por ...">
                <button type="button" id="btn-buscar-habitacion">Buscar</button>
            </div><br>

            <div class="container_tablas">

                <table id="tabla-mesas" class="table table-bordered">

                    <thead>
                        <tr>
                            <th style="width: 15%;">N. Hab.</th>
                            <th style="width: 15%;">T. Hab.</th>
                            <th style="width: 12%;">Edif.</th>
                            <th style="width: 12%;">Piso</th>
                            <th style="width: 15%;">Cred. Pasaje</th>
                            <th style="width: 15%;">Cred. Salida</th>
                            <th style="width: 16%;"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($habitaciones as $habitacion)
                        <tr>
                            <td>{{ $habitacion->N_Hab }}</td>
                            <td>{{ $habitacion->Tp_Hab }}</td>
                            <td>{{ $habitacion->Edificio }}</td>
                            <td>{{ $habitacion->Piso }}</td>
                            <td>{{ $habitacion->Cred_Pasaje }}</td>
                            <td>{{ $habitacion->Cred_Salida }}</td>
                            <td class="celda-estado" style="text-align: center; vertical-align: middle;">
                                <button class="boton-icono borra-edita btn-editar" data-id="{{ $habitacion->N_Hab }}">
                                    <img src="{{ asset('images/modules/bcp/iconos/edit.svg') }}" alt="Editar">
                                </button>
                                <button class="boton-icono borra-edita btn-eliminar" data-id="{{ $habitacion->N_Hab }}">
                                    <img src="{{ asset('images/modules/bcp/iconos/delete.svg') }}" alt="Eliminar">
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

<!-- Modal para eliminar -->

<div id="modalEliminar" class="modal" style="display:none;">
    <div class="modal-content botones-dobles">
        <p></p>
        <button id="btn-cerrar-eliminar">Cerrar</button>
        <button id="btn-eliminar" class="btn-eliminar-confirm">Eliminar</button>
    </div>
</div>

<!-- Modal para editar -->

<div id="modalEditar" class="modal">
    <div class="modal-content botones-dobles">
        <form method="POST" id="formEditar" action="{{ route('catalogo.update', ['catalogo' => 'N_Hab']) }}">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <p id="textoHabitacion">Editar Habitación:</p>

                <label>Tipo de Habitación</label>
                <select name="Tp_Hab" required>
                    <option value="">Seleccionar </option>
                    <option value="HDOA">HNDCAP DBL INT (HDOA)</option>
                    <option value="HKOA">HNDCAP KING INT (HKOA)</option>
                    <option value="IKOA">IMP KING INT (IKOA)</option>
                    <option value="JDOA">JR DBL INTERIOR (JDOA)</option>
                    <option value="JDUA">JR DBL EXTERIOR (JDUA)</option>
                    <option value="JKOA">JR KING INTERIO (JKOA)</option>
                    <option value="JKUA">JR KING EXTERIO (JKUA)</option>
                    <option value="MKOA">MSTR KING INTER (MKOA)</option>
                    <option value="MKUA">MSTR KING EXTER (MKUA)</option>
                    <option value="PDOA">PH DBL INTERIOR (PDOA)</option>
                    <option value="PKOA">PH KING EXT (PKOA)</option>
                    <option value="PKUA">PH KING INT (PKUA)</option>
                    <option value="SDUA">SUP DBL EXT (SDUA)</option>
                    <option value="SKUA">SUP KING EXT (SKUA)</option>
                    <option value="TDOA">CLUB 89 DBL INT (TDOA)</option>
                    <option value="TDUA">CLUB 89 DBL EXT (TDUA)</option>
                    <option value="TKOA">CLUB 89 KING INT (TKOA)</option>
                    <option value="TKUA">CLUB 89 KING EXT (TKUA)</option>
                    <option value="WKOA">OWN KING INT (WKOA)</option>
                    <option value="XDOA">DLX DBL INT (XDOA)</option>
                    <option value="XKOA">DLX KING INT (XKOA)</option>
                </select>

                <label>Edificio de la Habitación</label>
                <select name="Edificio" required> <!--class="w-full border border-gray-300 rounded px-3 py-2"-->
                    <option value="">Seleccionar </option>
                    <option value="A">A </option>
                    <option value="B">B </option>
                    <option value="C">C </option>
                    <option value="D">D </option>
                </select>

                <label>Piso
                    <input type="number" name="Piso" id="pisoInputEditar" required>
                </label>

                <label>Créditos en Pasaje
                    <input type="number" name="Cred_Pasaje" id="pasajeInputEditar" required>
                </label>

                <label>Créditos en Salida
                    <input type="number" name="Cred_Salida" id="salidaInputEditar" required>
                </label>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: space-between;">
                <button type="button" id="cerrarModalEditar">Cerrar</button>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>



@endsection