@vite(['resources/css/modules/historialclinico/formulario.css']) {{-- Solo CSS aquí --}}
@extends('layouts.app')
@section('content')
@include('seguridadysalud.partials.top_navigation_formulario')
<div id="mainContent" data-view="formulario">
    <div class='encabezado'>
        <button class='button-regresar' onclick="loadView('homeContent')" hidden>Regresar</button>
        <button id="btnImprimir" type="button" onclick="imprimirFormulario()" class='button-regresar' hidden>Imprimir Registro</button>
    </div>

    <div id='form-container'>
        <form action="{{ route('formulario.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- DATOS GENERALES DEL ACCIDENTE O INCIDENTE -->
            <table class="table-container mt-6">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        DATOS GENERALES DEL ACCIDENTE O INCIDENTE
                    </th>
                </tr>
                <tr>
                    <td>
                        Evento a investigar:<br>
                        <select name="evento" class="line-input" style="background-color: #e0e0e0;">
                            <option value="">-- Selecciona --</option>
                            <option value="accidente">Accidente</option>
                            <option value="incidente">Incidente</option>
                            <option value="enfermedad">Enfermedad</option>
                        </select>
                    </td>
                    <!-- NUEVO SELECT IMSS -->
                    <td>
                        Tiempo:<br>
                        <select name="imss" class="line-input" style="background-color: #e0e0e0;">
                            <option value="">-- Selecciona --</option>
                            <option value="trayecto">Trayecto</option>
                            <option value="interno">Interno</option>
                            <option value="trabajo">Trabajo</option>
                        </select>
                    </td>


                    <!-- ► Select dinámico de Áreas (Propiedades) -->
                    <td>
                        Propiedad:
                        <select
                            id="selectPropiedadEvento"
                            name="propiedad_id"
                            class="line-input"
                            style="background-color: #e0e0e0;">
                            <option value="">-- Cargando áreas --</option>
                        </select>
                    </td>
                    <!-- ► Select dinámico de Departamento asociado -->
                    <td>
                        Departamento:
                        <select
                            id="selectDepartamentoEvento"
                            name="departamento_evento"
                            class="line-input"
                            style="background-color: #e0e0e0;"
                            disabled>
                            <option value="">-- Primero elige un área --</option>
                        </select>
                    </td>

                    <!-- MODIFICACION DE PUESTO -->
                    <td>
                        <label for="selectPuesto">Puesto:</label>
                        <select id="selectPuesto" name="puesto_id"
                            class="line-input" style="background-color: #e0e0e0;" disabled>
                            <option value="">-- Primero elige un departamento --</option>
                        </select>
                    </td>
                    <!-- ll////////-/----------------------------------------------------------------------------------------l -->

                    <!-- <td>Fecha: <input type="date" class="line-input" name="fecha_evento" style="background-color: #e0e0e0;"></td>
                    <td>Hora: <input type="time" class="line-input" name="hora_evento" style="background-color: #e0e0e0;"></td> -->
                </tr>
                <tr>
                    <td colspan="3" style="background-color: #031227; color: white;">
                        Fecha del reporte:
                        <input type="date" class="line-input" name="fecha_reporte" style="background-color: #e0e0e0; color: black;">
                    </td>
                    <td colspan="3" style="background-color: #031227; color: white;">
                        Número del caso:
                        <input type="text" class="line-input" name="numero_caso" style="background-color: #e0e0e0; color: black;">
                    </td>
                </tr>
            </table>

            <!-- DATOS DEL LESIONADO O INVOLUCRADO -->
            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        DATOS DEL LESIONADO O EL INVOLUCRADO
                    </th>
                </tr>
                <tr>
                    <td>Nombre: <input type="text" class="line-input" name="nombre_lesionado" style="background-color: #e0e0e0;"></td>
                    <td>Número: <input type="text" class="line-input" name="numero_lesionado" style="background-color: #e0e0e0;"></td>
                    <td>Edad: <input type="number" class="line-input" name="edad_lesionado" style="background-color: #e0e0e0;"></td>
                    <td>Género:
                        <select class="line-input" name="genero_lesionado" style="background-color: #e0e0e0;">
                            <option value="">--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </td>
                    <td>Turno: <input type="text" class="line-input" name="turno_lesionado" style="background-color: #e0e0e0;"></td>
                </tr>
                <tr>
                    <td>Teléfono particular:
                        <input type="text" class="line-input" name="telefono_lesionado" style="background-color: #e0e0e0;">
                    </td>
                    <td>Puesto actual:
                        <input type="text" class="line-input" name="puesto_actual" style="background-color: #e0e0e0;">
                    </td>
                    <td>Antigüedad en la empresa:
                        <input type="text" class="line-input" name="antiguedad_empresa" style="background-color: #e0e0e0;">
                    </td>
                    <td>Antigüedad en el puesto:
                        <input type="text" class="line-input" name="antiguedad_puesto" style="background-color: #e0e0e0;">
                    </td>
                    <td>Tiempo de función al momento del accidente:
                        <input type="text" class="line-input" name="tiempo_funcion" style="background-color: #e0e0e0;">
                    </td>
                </tr>
                <tr>
                    <td colspan="5">Dirección particular:
                        <input type="text" class="line-input" name="direccion_particular" style="background-color: #e0e0e0;">
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: #031227; color: white;">
                        Actividad que realizaba al momento del accidente:
                        <input type="text" class="line-input" name="actividad_accidente" style="background-color: #e0e0e0; color: black;">
                    </td>
                </tr>
            </table>

            <!-- TRATAMIENTO PROVISTO AL LESIONADO (ACCIDENTE) -->
            <table class="table-container mt-6">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        TRATAMIENTO PROVISTO AL LESIONADO (ACCIDENTE)
                    </th>
                </tr>

                <tr>
                    <td colspan="2">
                        <strong>Primeros auxilios:</strong><br>
                        <label><input type="radio" name="auxilios" value="si"> Sí</label>
                        <label><input type="radio" name="auxilios" value="no"> No</label>
                    </td>
                    <td colspan="2">
                        <strong>Prescripción médica:</strong><br>
                        <label><input type="radio" name="prescripcion" value="si"> Sí</label>
                        <label><input type="radio" name="prescripcion" value="no"> No</label>
                    </td>
                    <td colspan="2">
                        <strong>Requirió incapacidad:</strong><br>
                        <label><input type="radio" name="incapacidad" value="si"> Sí</label>
                        <label><input type="radio" name="incapacidad" value="no"> No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <strong>Atención médica:</strong><br>
                        <label><input type="radio" name="atencion" value="si"> Sí</label>
                        <label><input type="radio" name="atencion" value="no"> No</label>
                    </td>
                    <td colspan="2">
                        <strong>Se retiró a su domicilio:</strong><br>
                        <label><input type="radio" name="retiro" value="si"> Sí</label>
                        <label><input type="radio" name="retiro" value="no"> No</label>
                    </td>
                    <td colspan="2">
                        <strong>El caso es registrable:</strong><br>
                        <label><input type="radio" name="registrable" value="si"> Sí</label>
                        <label><input type="radio" name="registrable" value="no"> No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <strong>Se envió a laboratorio:</strong><br>
                        <label><input type="radio" name="laboratorio" value="si"> Sí</label>
                        <label><input type="radio" name="laboratorio" value="no"> No</label>
                    </td>
                    <td colspan="2">
                        <strong>Se saturó o vendó:</strong><br>
                        <label><input type="radio" name="vendaje" value="si"> Sí</label>
                        <label><input type="radio" name="vendaje" value="no"> No</label>
                    </td>
                    <td colspan="2">
                        <strong>Restricción por el médico:</strong><br>
                        <label><input type="radio" name="restriccion" value="si"> Sí</label>
                        <label><input type="radio" name="restriccion" value="no"> No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <strong>En caso de haber incapacidad, tipo:</strong><br>
                        <textarea name="tipo_incapacidad" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                    <td colspan="4">
                        <strong>Especificar atención médica:</strong><br>
                        <textarea name="especificar_atencion" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <label for="selectLesion">Lesión:</label>
                        <select id="selectLesion" name="lesion" class="line-input" style="background-color: #e0e0e0;">
                            <option value="">Selecciona una lesión</option>
                            @foreach($lesiones as $lesion)
                            <option value="{{ $lesion->id }}">{{ $lesion->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="2">
                        <strong>Total de días de incapacidad:</strong><br>
                        <input type="number" class="line-input" name="dias_incapacidad" style="background-color: #e0e0e0;" min="0">
                    </td>

                </tr>
            </table>

            <!-- 1) Tu HTML para el body map y el overlay -->
            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        PARTES DEL CUERPO AFECTADA
                        <div style="text-align: center; margin-top: 12px;">
                            <button
                                id="toggleView"
                                type="button"
                                class="button-regresar">
                                Mostrar vista posterior
                            </button>
                        </div>
                    </th>
                </tr>
                <tr>
                    <!-- ... resto ... -->

                    <td colspan="6" style="padding:0; vertical-align:top;">
                        <div id="bodyMapWrapper"
                            style="display: flex; justify-content: space-between; align-items: flex-start;">

                            <!-- IZQUIERDA: posterior -->
                            <div id="selectedLeft"
                                style="width: 200px; font-family: sans-serif;">
                                <strong>Posterior:</strong>
                            </div>

                            <!-- CENTRO: mapa + botón -->
                            <div style="text-align: center;">
                                <div id="bodyMapContainer"
                                    style="width:320px; height:430px; margin:auto;"></div>
                            </div>

                            <!-- DERECHA: frontal -->
                            <div id="selectedRight"
                                style="width: 200px; font-family: sans-serif;">
                                <strong>Frontal:</strong>
                            </div>


                        </div>

                        <!-- ⬇️ Aquí va tu input oculto -->
                        <input type="hidden" name="partes_afectadas" id="partes_afectadas">
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="background-color: #031227; color: white; text-align: left;">
                        OTRO ESPECIFIQUE:
                        <textarea name="otra_parte"
                            class="line-input"
                            style="width:100%; height:60px; background-color:#e0e0e0; color:black; border-radius:4px;"></textarea>
                    </td>
                </tr>
            </table>

            <!-- Overlay de lupa (zoom) -->
            <div id="zoomOverlay"
                style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
                background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:1000;">
                <div id="zoomBox"
                    style="background:#fff; padding:16px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.3);">
                    <div id="zoomBoxCanvas" style="width:150px; height:150px;"></div>
                </div>
            </div>


            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        DATOS PRELIMINARES
                    </th>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="selectAccidente">Accidente:</label>
                        <select id="selectAccidente" name="accidente" class="line-input" style="background-color: #e0e0e0;">
                            <option value="">Selecciona un accidente</option>
                            @foreach($accidentes as $accidente)
                            <option value="{{ $accidente->id }}">{{ $accidente->nombre }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td colspan="3">
                        Agente del accidente:
                        <input type="text" class="line-input" name="agente_accidente" style="background-color: #e0e0e0;">
                    </td>
                </tr>
                <tr>
                    <td>
                        ¿Requiere EPP?<br>
                        <label><input type="radio" name="requiere_epp" value="si"> Sí</label>
                        <label><input type="radio" name="requiere_epp" value="no"> No</label>
                    </td>
                    <td>
                        ¿Usaba EPP?<br>
                        <label><input type="radio" name="usaba_epp" value="si"> Sí</label>
                        <label><input type="radio" name="usaba_epp" value="no"> No</label>
                    </td>
                    <td>
                        ¿Se le proporcionó EPP?<br>
                        <label><input type="radio" name="proporcion_epp" value="si"> Sí</label>
                        <label><input type="radio" name="proporcion_epp" value="no"> No</label>
                    </td>
                    <td>
                        ¿Estaba trabajando?<br>
                        <label><input type="radio" name="anfitrion_trabajando" value="si"> Sí</label>
                        <label><input type="radio" name="anfitrion_trabajando" value="no"> No</label>
                    </td>
                    <td>
                        ¿Capacitado en el puesto?<br>
                        <label><input type="radio" name="capacitacion_puesto" value="si"> Sí</label>
                        <label><input type="radio" name="capacitacion_puesto" value="no"> No</label>
                    </td>
                    <td>
                        ¿Conocimiento del puesto?<br>
                        <label><input type="radio" name="conocimiento_puesto" value="si"> Sí</label>
                        <label><input type="radio" name="conocimiento_puesto" value="no"> No</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Postura del anfitrión:
                        <input type="text" class="line-input" name="postura_anfitrion" style="background-color: #e0e0e0;">
                    </td>
                    <td colspan="2">Supervisión:
                        <input type="text" class="line-input" name="supervision" style="background-color: #e0e0e0;">
                    </td>
                    <td colspan="2">¿Accidentes previos?
                        <input type="text" class="line-input" name="accidentes_previos" style="background-color: #e0e0e0;">
                    </td>
                </tr>
            </table>


            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        DAÑOS A LA PROPIEDAD O AL MEDIO AMBIENTE
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        Descripción del daño:
                        <textarea name="descripcion_dano" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                    <td colspan="3">
                        Parte de la propiedad que recibió el daño:
                        <textarea name="parte_afectada" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Costo estimado:
                        <input type="text" class="line-input" name="costo_estimado" style="background-color: #e0e0e0;">
                    </td>
                    <td colspan="3">
                        Costo real:
                        <input type="text" class="line-input" name="costo_real" style="background-color: #e0e0e0;">
                    </td>
                </tr>
            </table>



            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        DESCRIPCIÓN DEL ACCIDENTE / INCIDENTE
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        Describa cómo ocurrió el accidente/incidente:
                        <textarea name="descripcion_accidente" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                    <td colspan="3">
                        Observaciones:
                        <textarea name="observaciones" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                </tr>
            </table>


            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        DESCRIPCIÓN DE LA ESCENA
                    </th>
                </tr>
                <tr>
                    <td colspan="6">
                        Describa la escena al momento que ocurrió el accidente:
                        <textarea name="descripcion_escena" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                </tr>
            </table>


            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        INVESTIGACIÓN Y ANÁLISIS
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        Área de trabajo (limpieza, libre acceso, etc.):
                        <textarea name="area_trabajo" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                    <td colspan="3">
                        Equipos, materiales y herramientas usados:
                        <textarea name="equipos_usados" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Objetos encontrados:
                        <textarea name="objetos_encontrados" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                    <td colspan="2">
                        <label for="selectCausa">Causa:</label>
                        <select id="selectCausa" name="causa" class="line-input" style="background-color: #e0e0e0;">
                            <option value="">Selecciona una causa</option>
                            @foreach($causas as $causa)
                            <option value="{{ $causa->id }}">{{ $causa->nombre }}</option>
                            @endforeach
                        </select>
                    </td>

                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 60px; margin-top: 1rem;">
                            <div>
                                <strong>Acto Inseguro:</strong><br>
                                <label><input type="radio" name="acto_inseguro" value="si"> Sí</label>
                                <label><input type="radio" name="acto_inseguro" value="no"> No</label>
                            </div>
                            <div>
                                <strong>Condiciones Inseguras:</strong><br>
                                <label><input type="radio" name="condiciones_inseguras" value="si"> Sí</label>
                                <label><input type="radio" name="condiciones_inseguras" value="no"> No</label>
                            </div>
                            <div>
                                <strong>Ambas:</strong><br>
                                <label><input type="radio" name="ambas" value="si"> Sí</label>
                                <label><input type="radio" name="ambas" value="no"> No</label>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>


            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #3989b5; color: white;">
                        Tipo de incapacidad o consecuencia:
                    </th>
                </tr>
                <tr>
                    <td>
                        Temporal <input type="checkbox" name="incapacidad_temporal">
                    </td>
                    <td>
                        Parcialmente <input type="checkbox" name="incapacidad_parcial">
                    </td>
                    <td>
                        Muerte <input type="checkbox" name="incapacidad_muerte">
                    </td>
                    <td>
                        Sin incapacidad <input type="checkbox" name="sin_incapacidad">
                    </td>
                    <td colspan="2">
                        No especificada <input type="checkbox" name="no_especificada">
                    </td>
                </tr>

                <tr>
                    <th colspan="4" style="background-color: #031227; color: white;">Recomendaciones/Acciones:</th>
                    <th style="background-color: #031227; color: white;">Responsable:</th>
                    <th style="background-color: #031227; color: white;">Fecha:</th>
                </tr>
                <tr>
                    <td colspan="4">
                        <textarea name="recomendaciones" class="line-input" style="background-color: #e0e0e0;"></textarea>
                    </td>
                    <td>
                        <input type="text" class="line-input" name="responsable_recomendacion" style="background-color: #e0e0e0;">
                    </td>
                    <td>
                        <input type="date" class="line-input" name="fecha_recomendacion" style="background-color: #e0e0e0;">
                    </td>
                </tr>
            </table>
            <table class="table-container mt-4">
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #031227; color: white;">
                        Avalan
                    </th>
                </tr>

                {{-- Anfitrión --}}
                <tr>
                    <td colspan="2">El Anfitrión:</td>
                    <td colspan="2">
                        <input type="text" class="line-input" name="aval_anfitrion" style="background-color: #e0e0e0;">
                    </td>
                    <td>Firma electrónica:</td>
                    <td>
                        <canvas id="signaturePadAnfitrion" class="signature-pad" width="300" height="100" style="border:1px solid #ccc;"></canvas>
                        <p>
                            <button type="button" class="clear-button" data-target="signaturePadAnfitrion">Limpiar</button>
                            <button type="button" class="submit-button" data-target="signaturePadAnfitrion">Guardar</button>
                        </p>
                    </td>
                </tr>

                {{-- Supervisor --}}
                <tr>
                    <td colspan="2">El jefe inmediato o Supervisor:</td>
                    <td colspan="2">
                        <input type="text" class="line-input" name="aval_supervisor" style="background-color: #e0e0e0;">
                    </td>
                    <td>Firma electrónica:</td>
                    <td>
                        <canvas id="signaturePadSupervisor" class="signature-pad" width="300" height="100" style="border:1px solid #ccc;"></canvas>
                        <p>
                            <button type="button" class="clear-button" data-target="signaturePadSupervisor">Limpiar</button>
                            <button type="button" class="submit-button" data-target="signaturePadSupervisor">Guardar</button>
                        </p>
                    </td>
                </tr>

                {{-- Patrón --}}
                <tr>
                    <td colspan="2">Investigado por (Patrón):</td>
                    <td colspan="2">
                        <input type="text" class="line-input" name="aval_patron" style="background-color: #e0e0e0;">
                    </td>
                    <td>Firma electrónica:</td>
                    <td>
                        <canvas id="signaturePadPatron" class="signature-pad" width="300" height="100" style="border:1px solid #ccc;"></canvas>
                        <p>
                            <button type="button" class="clear-button" data-target="signaturePadPatron">Limpiar</button>
                            <button type="button" class="submit-button" data-target="signaturePadPatron">Guardar</button>
                        </p>
                    </td>
                </tr>

                {{-- Trabajador --}}
                <tr>
                    <td colspan="2">Investigado por (Trabajadores):</td>
                    <td colspan="2">
                        <input type="text" class="line-input" name="aval_trabajadores" style="background-color: #e0e0e0;">
                    </td>
                    <td>Firma electrónica:</td>
                    <td>
                        <canvas id="signaturePadTrabajador" class="signature-pad" width="300" height="100" style="border:1px solid #ccc;"></canvas>
                        <p>
                            <button type="button" class="clear-button" data-target="signaturePadTrabajador">Limpiar</button>
                            <button type="button" class="submit-button" data-target="signaturePadTrabajador">Guardar</button>
                        </p>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th colspan="6" class="section-title" style="background-color: #031227; color: white;">
                        Memoria fotográfica (opcional)
                    </th>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        <div style="position: relative; display: inline-block;">
                            <label style="
                                        background-color: #265ba4;
                                        color: white;
                                        padding: 12px 24px;
                                        border: none;
                                        border-radius: 8px;
                                        font-size: 16px;
                                        font-weight: 500;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 8px;
                                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                                    ">
                                <i class="fas fa-camera" style="font-size: 18px;"></i>
                                Subir imagen
                            </label>
                            <input
                                type="file"
                                name="memoria_fotografica"
                                accept="image/*"
                                style="
                                        position: absolute;
                                        left: 0;
                                        top: 0;
                                        opacity: 0;
                                        width: 100%;
                                        height: 100%;
                                        cursor: pointer;
                                    "
                                onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'Ningún archivo seleccionado'">
                        </div>
                        <div id="file-name" style="margin-top: 8px; font-size: 14px; color: #666;">
                            Ningún archivo seleccionado
                        </div>
                    </td>
                </tr>
            </table>
            <!-- -------------- FIN FIRMA ELECTRÓNICA -------------- -->

            <!-- Hidden inputs para capturar base64 de cada firma -->
            <input type="hidden" name="signaturePadAnfitrion_data">
            <input type="hidden" name="signaturePadSupervisor_data">
            <input type="hidden" name="signaturePadPatron_data">
            <input type="hidden" name="signaturePadTrabajador_data">

            <!-- Botón enviar formulario -->
            <div style="text-align: center; margin-top: 2rem;">
                <button type="submit" style="background-color: #265ba4; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px;">
                    Enviar Formulario
                </button>
            </div>
        </form>

        <!-- 1) Incluye SignaturePad desde CDN -->
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
        {{-- Konva --}}
        <script src="https://cdn.jsdelivr.net/npm/konva@9.3.0/konva.min.js"></script>
        <!-- 2) Inicializa los signature pads -->
        <!-- <script>
                document.addEventListener('DOMContentLoaded', () => {
                    if (typeof initSignaturePads === 'function') {
                        initSignaturePads();
                    } else {
                        console.warn('initSignaturePads no está definida');
                    }
                });
            </script> -->

    </div>
</div>
@endsection
@push('scripts')
@vite('resources/js/modules/historialclinico/formulario.js')
@endpush