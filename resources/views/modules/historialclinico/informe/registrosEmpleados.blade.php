
<!-- Modal personalizado para mostrar el registro -->
<div id="registroModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class='text-header'>Registro del Empleado</label>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- FICHA DE IDENTIFICACION -->
                <div class="info-row"><span class="labelTitulo">FICHA DE IDENTIFICACIÓN</span></div>
                <div class="info-row"><span class="label">Nombre:</span> <span class="value" id="nombre"></span></div>
                <div class="info-row"><span class="label">Edad:</span> <span class="value" id="edad"></span></div>
                <div class="info-row"><span class="label">Género:</span> <span class="value" id="genero"></span></div>
                <div class="info-row"><span class="label">Estado Civil:</span> <span class="value" id="estadoCivil"></span></div>
                <div class="info-row"><span class="label">Fecha de Nacimiento:</span> <span class="value" id="fechaNacimiento"></span></div>
                <div class="info-row"><span class="label">Dirección:</span> <span class="value" id="direccion"></span></div>
                <div class="info-row"><span class="label">Teléfono:</span> <span class="value" id="telefono"></span></div>
                <div class="info-row"><span class="label">Escolaridad:</span> <span class="value" id="escolaridad"></span></div>
                <div class="info-row"><span class="label">Razón Social:</span> <span class="value" id="razonSocial"></span></div>

                <!-- ANTECEDENTES LABORALES -->
                <div class="info-row"><span class="labelTitulo">ANTECEDENTES LABORALES</span></div>
                <div class="info-row"><span class="label">Edad de Inicio de Labores:</span> <span class="value" id="edadLabores"></span></div>
                <div class="info-row"><span class="label">Empresa:</span> <span class="value" id="empresa"></span></div>
                <div class="info-row"><span class="label">Puesto:</span> <span class="value" id="puesto"></span></div>
                <div class="info-row"><span class="label">Tiempo:</span> <span class="value" id="tiempo"></span></div>
                <div class="info-row"><span class="label">Agentes:</span> <span class="value" id="agentes"></span></div>

                 <!-- HEREDO FAMILIARES -->
                 <div class="info-row"><span class="labelTitulo">HISTORIAL HEREDOFAMILIAR</span></div>
                <div class="info-row"><span class="label">Fímicos:</span> <span class="value" id="fimicos"></span></div>
                <div class="info-row"><span class="label">Luéticos:</span> <span class="value" id="lueticos"></span></div>
                <div class="info-row"><span class="label">Diabéticos:</span> <span class="value" id="diabeticos"></span></div>
                <div class="info-row"><span class="label">Cardiópatas:</span> <span class="value" id="cardiopatas"></span></div>
                <div class="info-row"><span class="label">Epilepticos:</span> <span class="value" id="epilepticos"></span></div>
                <div class="info-row"><span class="label">Oncológicos:</span> <span class="value" id="oncologicos"></span></div>
                <div class="info-row"><span class="label">Malf. Congén.:</span> <span class="value" id="malfCongen"></span></div>
                <div class="info-row"><span class="label">Atópicos:</span> <span class="value" id="atopocos"></span></div>
                <div class="info-row"><span class="label">Otro:</span> <span class="value" id="otro"></span></div>
                
                <!-- PERSONALES PATOLÓGICOS -->
                <div class="info-row"><span class="labelTitulo">ANTECEDENTES PERSONALES PATOLÓGICOS</span></div>
                <div class="info-row"><span class="label">Fímicos:</span> <span class="value" id="fimicosPersonales"></span></div>
                <div class="info-row"><span class="label">Luéticos:</span> <span class="value" id="lueticosPersonales"></span></div>
                <div class="info-row"><span class="label">Diabéticos:</span> <span class="value" id="diabeticosPersonales"></span></div>
                <div class="info-row"><span class="label">Renales:</span> <span class="value" id="renales"></span></div>
                <div class="info-row"><span class="label">Cardiacos:</span> <span class="value" id="cardiacos"></span></div>
                <div class="info-row"><span class="label">Hipertensos:</span> <span class="value" id="hipertensos"></span></div>
                <div class="info-row"><span class="label">Atópicos:</span> <span class="value" id="atopicosPersonales"></span></div>
                <div class="info-row"><span class="label">Lumbalgias:</span> <span class="value" id="lumbalgias"></span></div>
                <div class="info-row"><span class="label">Traumáticos:</span> <span class="value" id="traumaticos"></span></div>
                <div class="info-row"><span class="label">Oncológicos:</span> <span class="value" id="oncologicosPersonales"></span></div>
                <div class="info-row"><span class="label">Epilépticos:</span> <span class="value" id="epilepticosPersonales"></span></div>
                <div class="info-row"><span class="label">Quirúrgicos:</span> <span class="value" id="quirurgicos"></span></div>
                <div class="info-row"><span class="label">Otro:</span> <span class="value" id="otroPersonales"></span></div>

                <!-- PERSONALES NO PATOLOGICOS -->
                <div class="info-row"><span class="labelTitulo">ANTECEDENTES PERSONALES NO PATOLÓGICOS</span></div>
                <div class="info-row"><span class="label">Tabaquismo:</span> <span class="value" id="tabaquismo"></span></div>
                <div class="info-row"><span class="label">Especifica Tabaquismo:</span> <span class="value" id="especificaTabaquismo"></span></div>
                <div class="info-row"><span class="label">Alcoholismo:</span> <span class="value" id="alcoholismo"></span></div>
                <div class="info-row"><span class="label">Especifica Alcoholismo:</span> <span class="value" id="especificaAlcoholismo"></span></div>
                <div class="info-row"><span class="label">Toxicomanías:</span> <span class="value" id="toxicomanias"></span></div>
                <div class="info-row"><span class="label">Especifica Toxicomanías:</span> <span class="value" id="especificaToxicomanias"></span></div>
                <div class="info-row"><span class="label">Menarquia:</span> <span class="value" id="menarquia"></span></div>
                <div class="info-row"><span class="label">Ritmo:</span> <span class="value" id="ritmo"></span></div>
                <div class="info-row"><span class="label">FUM:</span> <span class="value" id="fum"></span></div>
                <div class="info-row"><span class="label">Disminorrea:</span> <span class="value" id="disminorrea"></span></div>
                <div class="info-row"><span class="label">IVSA:</span> <span class="value" id="ivsa"></span></div>
                <div class="info-row"><span class="label">FUP:</span> <span class="value" id="fup"></span></div>
                <!-- RIESGOS DE TRABAJO -->
                <div class="info-row"><span class="labelTitulo">RIESGOS DE TRABAJO</span></div>
                <div class="info-row"><span class="label">Riesgo:</span> <span class="value" id="riesgoTrabajo"></span></div>
                <div class="info-row"><span class="label">Evaluación:</span> <span class="value" id="riesgoEvaluacion"></span></div>

                <!-- RIESGOS DE ENFERMEDAD -->
                <div class="info-row"><span class="labelTitulo">RIESGOS DE ENFERMEDAD</span></div>
                <div class="info-row"><span class="label">Enfermedad:</span> <span class="value" id="riesgoEnfermedad"></span></div>
                <div class="info-row"><span class="label">Evaluación:</span> <span class="value" id="enfermedadEvaluacion"></span></div>
                <!-- PADECE ENFERMEDAD -->
                <div class="info-row"><span class="labelTitulo">CONDICIÓN MÉDICA ACTUAL</span></div>
                <div class="info-row"><span class="label">¿Padece alguna enfermedad?:</span> <span class="value" id="padeceEnfermedad"></span></div>
                <div class="info-row"><span class="label">Especifique:</span> <span class="value" id="especifiqueEnfermedad"></span></div>
                <div class="info-row"><span class="label">Mano dominante:</span> <span class="value" id="manoDominante"></span></div>
                <div class="info-row">
                    <span class="label">Firma:</span>
                    <img id="firmaImg" src="" alt="Sin Firma Registrada" style="max-width: 200px; display: block;" />
                </div>
                <!-- EXPLORACIÓN FÍSICA - DATOS FÍSICOS -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - DATOS FÍSICOS</span></div>
                <div class="info-row"><span class="label">Peso:</span> <span class="value" id="fisico_peso"></span></div>
                <div class="info-row"><span class="label">Talla:</span> <span class="value" id="fisico_talla"></span></div>
                <div class="info-row"><span class="label">T/A:</span> <span class="value" id="fisico_ta"></span></div>
                <div class="info-row"><span class="label">F.C.:</span> <span class="value" id="fisico_fc"></span></div>
                <div class="info-row"><span class="label">F.R.:</span> <span class="value" id="fisico_fr"></span></div>
                <div class="info-row"><span class="label">IMC:</span> <span class="value" id="fisico_imc"></span></div>
                <!-- EXPLORACIÓN FÍSICA - CRÁNEO -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - CRÁNEO</span></div>
                <div class="info-row"><span class="label">Forma:</span> <span class="value" id="craneo_forma"></span></div>
                <div class="info-row"><span class="label">Tamaño:</span> <span class="value" id="craneo_tamano"></span></div>
                <div class="info-row"><span class="label">Pelo:</span> <span class="value" id="craneo_pelo"></span></div>
                <div class="info-row"><span class="label">Cara:</span> <span class="value" id="craneo_cara"></span></div>
                <!-- EXPLORACIÓN FÍSICA - CUELLO -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - CUELLO</span></div>
                <div class="info-row"><span class="label">Ganglios:</span> <span class="value" id="cuello_ganglios"></span></div>
                <div class="info-row"><span class="label">Movilidad:</span> <span class="value" id="cuello_movilidad"></span></div>
                <div class="info-row"><span class="label">Tiroides:</span> <span class="value" id="cuello_tiroides"></span></div>
                <div class="info-row"><span class="label">Pulsos:</span> <span class="value" id="cuello_pulsos"></span></div>
                <!-- EXPLORACIÓN FÍSICA - BOCA -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - BOCA</span></div>
                <div class="info-row"><span class="label">Mucosas:</span> <span class="value" id="boca_mucosas"></span></div>
                <div class="info-row"><span class="label">Dentadura:</span> <span class="value" id="boca_dentadura"></span></div>
                <div class="info-row"><span class="label">Lengua:</span> <span class="value" id="boca_lengua"></span></div>
                <div class="info-row"><span class="label">Encías:</span> <span class="value" id="boca_encias"></span></div>
                <div class="info-row"><span class="label">Faringe:</span> <span class="value" id="boca_faringe"></span></div>
                <div class="info-row"><span class="label">Amígdalas:</span> <span class="value" id="boca_amigdalas"></span></div>
                <!-- EXPLORACIÓN FÍSICA - OJOS -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - OJOS</span></div>
                <div class="info-row"><span class="label">Conjuntivas:</span> <span class="value" id="ojos_conjuntivas"></span></div>
                <div class="info-row"><span class="label">Pupilas:</span> <span class="value" id="ojos_pupilas"></span></div>
                <div class="info-row"><span class="label">Párpados:</span> <span class="value" id="ojos_parpados"></span></div>
                <div class="info-row"><span class="label">Reflejos:</span> <span class="value" id="ojos_reflejos"></span></div>
                <!-- EXPLORACIÓN FÍSICA - NARIZ -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - NARIZ</span></div>
                <div class="info-row"><span class="label">Tabique:</span> <span class="value" id="nariz_tabique"></span></div>
                <div class="info-row"><span class="label">Mucosas:</span> <span class="value" id="nariz_mucosas"></span></div>
                <!-- EXPLORACIÓN FÍSICA - OÍDOS -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - OÍDOS</span></div>
                <div class="info-row"><span class="label">Pabellón:</span> <span class="value" id="oido_pabellon"></span></div>
                <div class="info-row"><span class="label">CAE:</span> <span class="value" id="oido_cae"></span></div>
                <div class="info-row"><span class="label">Tímpanos:</span> <span class="value" id="oido_timpanos"></span></div>
                <!-- EXPLORACIÓN FÍSICA - AGUDEZA VISUAL -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - AGUDEZA VISUAL</span></div>
                <div class="info-row"><span class="label">Sin Lentes (SL):</span> <span class="value" id="visual_sl"></span></div>
                <div class="info-row"><span class="label">Con Lentes (CL):</span> <span class="value" id="visual_cl"></span></div>
                <!-- EXPLORACIÓN FÍSICA - ABDOMEN -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - ABDOMEN</span></div>
                <div class="info-row"><span class="label">Megalias:</span> <span class="value" id="abdomen_megalias"></span></div>
                <div class="info-row"><span class="label">Hernias:</span> <span class="value" id="abdomen_hernias"></span></div>
                <!-- EXPLORACIÓN FÍSICA - TÓRAX -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - TÓRAX</span></div>
                <div class="info-row"><span class="label">Forma:</span> <span class="value" id="torax_forma"></span></div>
                <div class="info-row"><span class="label">Ritmos Cardiacos:</span> <span class="value" id="torax_ritmos"></span></div>
                <div class="info-row"><span class="label">Campos Pulmonares:</span> <span class="value" id="torax_campos"></span></div>
                <div class="info-row"><span class="label">Mamas:</span> <span class="value" id="torax_mamas"></span></div>
                <!-- EXPLORACIÓN FÍSICA - PIEL Y ANEXOS -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - PIEL Y ANEXOS</span></div>
                <div class="info-row"><span class="label">Nevos:</span> <span class="value" id="piel_nevos"></span></div>
                <div class="info-row"><span class="label">Cicatrices:</span> <span class="value" id="piel_cicatrices"></span></div>
                <div class="info-row"><span class="label">Varices:</span> <span class="value" id="piel_varices"></span></div>
                <div class="info-row"><span class="label">Edemas:</span> <span class="value" id="piel_edemas"></span></div>
                <div class="info-row"><span class="label">Micosis:</span> <span class="value" id="piel_micosis"></span></div>
                <!-- EXPLORACIÓN FÍSICA - GENITALES -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - GENITALES</span></div>
                <div class="info-row"><span class="label">Fimosis:</span> <span class="value" id="genitales_fimosis"></span></div>
                <div class="info-row"><span class="label">Varicocele:</span> <span class="value" id="genitales_varicocele"></span></div>
                <div class="info-row"><span class="label">Hernias:</span> <span class="value" id="genitales_hernias"></span></div>
                <div class="info-row"><span class="label">Criptorquidias:</span> <span class="value" id="genitales_criptorquidias"></span></div>
                <!-- EXPLORACIÓN FÍSICA - MIEMBROS TORÁCICOS -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN FÍSICA - MIEMBROS TORÁCICOS</span></div>
                <div class="info-row"><span class="label">Integridad:</span> <span class="value" id="miembro_integridad"></span></div>
                <div class="info-row"><span class="label">Observación:</span> <span class="value" id="miembro_integridad_obs"></span></div>
                <div class="info-row"><span class="label">Forma:</span> <span class="value" id="miembro_forma"></span></div>
                <div class="info-row"><span class="label">Observación:</span> <span class="value" id="miembro_forma_obs"></span></div>
                <div class="info-row"><span class="label">Articulaciones:</span> <span class="value" id="miembro_articulaciones"></span></div>
                <div class="info-row"><span class="label">Observación:</span> <span class="value" id="miembro_articulaciones_obs"></span></div>
                <div class="info-row"><span class="label">Tono Muscular:</span> <span class="value" id="miembro_tono"></span></div>
                <div class="info-row"><span class="label">Observación:</span> <span class="value" id="miembro_tono_obs"></span></div>
                <div class="info-row"><span class="label">Reflejos:</span> <span class="value" id="miembro_reflejos"></span></div>
                <div class="info-row"><span class="label">Observación:</span> <span class="value" id="miembro_reflejos_obs"></span></div>
                <div class="info-row"><span class="label">Sensibilidad:</span> <span class="value" id="miembro_sensibilidad"></span></div>
                <div class="info-row"><span class="label">Observación:</span> <span class="value" id="miembro_sensibilidad_obs"></span></div>
                <!-- EXPLORACIÓN MIEMBROS PÉLVICOS -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN MIEMBROS PÉLVICOS</span></div>
                <div class="info-row"><span class="label">Integridad:</span> <span class="value" id="integridad"></span></div>
                <div class="info-row"><span class="label">Observaciones Integridad:</span> <span class="value" id="integridadObs"></span></div>
                <div class="info-row"><span class="label">Forma:</span> <span class="value" id="forma"></span></div>
                <div class="info-row"><span class="label">Observaciones Forma:</span> <span class="value" id="formaObs"></span></div>
                <div class="info-row"><span class="label">Articulaciones:</span> <span class="value" id="articulaciones"></span></div>
                <div class="info-row"><span class="label">Observaciones Articulaciones:</span> <span class="value" id="articulacionesObs"></span></div>
                <div class="info-row"><span class="label">Tono Muscular:</span> <span class="value" id="tonoMuscular"></span></div>
                <div class="info-row"><span class="label">Observaciones Tono Muscular:</span> <span class="value" id="tonoMuscularObs"></span></div>
                <div class="info-row"><span class="label">Reflejos:</span> <span class="value" id="reflejos"></span></div>
                <div class="info-row"><span class="label">Observaciones Reflejos:</span> <span class="value" id="reflejosObs"></span></div>
                <!-- EXPLORACIÓN CERVICAL -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN CERVICAL</span></div>
                <div class="info-row"><span class="label">Integridad:</span> <span class="value" id="cervical_integridad"></span></div>
                <div class="info-row"><span class="label">Observación Integridad:</span> <span class="value" id="cervical_integridad_observacion"></span></div>
                <div class="info-row"><span class="label">Forma:</span> <span class="value" id="cervical_forma"></span></div>
                <div class="info-row"><span class="label">Observación Forma:</span> <span class="value" id="cervical_forma_observacion"></span></div>
                <div class="info-row"><span class="label">Movimientos:</span> <span class="value" id="cervical_movimientos"></span></div>
                <div class="info-row"><span class="label">Observación Movimientos:</span> <span class="value" id="cervical_movimientos_observacion"></span></div>
                <div class="info-row"><span class="label">Fuerza:</span> <span class="value" id="cervical_fuerza"></span></div>
                <div class="info-row"><span class="label">Observación Fuerza:</span> <span class="value" id="cervical_fuerza_observacion"></span></div>
                <!-- EXPLORACIÓN DORSAL -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN DORSAL</span></div>
                <div class="info-row"><span class="label">Integridad:</span> <span class="value" id="dorsal_integridad"></span></div>
                <div class="info-row"><span class="label">Observación Integridad:</span> <span class="value" id="dorsal_integridad_observacion"></span></div>
                <div class="info-row"><span class="label">Forma:</span> <span class="value" id="dorsal_forma"></span></div>
                <div class="info-row"><span class="label">Observación Forma:</span> <span class="value" id="dorsal_forma_observacion"></span></div>
                <div class="info-row"><span class="label">Movimientos:</span> <span class="value" id="dorsal_movimientos"></span></div>
                <div class="info-row"><span class="label">Observación Movimientos:</span> <span class="value" id="dorsal_movimientos_observacion"></span></div>
                <div class="info-row"><span class="label">Fuerza:</span> <span class="value" id="dorsal_fuerza"></span></div>
                <div class="info-row"><span class="label">Observación Fuerza:</span> <span class="value" id="dorsal_fuerza_observacion"></span></div>
                <!-- EXPLORACIÓN COLUMNA LUMBAR -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN COLUMNA LUMBAR</span></div>
                <div class="info-row"><span class="label">Integridad:</span> <span class="value" id="lumbar_integridad"></span></div>
                <div class="info-row"><span class="label">Observación Integridad:</span> <span class="value" id="lumbar_integridad_observacion"></span></div>
                <div class="info-row"><span class="label">Forma:</span> <span class="value" id="lumbar_forma"></span></div>
                <div class="info-row"><span class="label">Observación Forma:</span> <span class="value" id="lumbar_forma_observacion"></span></div>
                <div class="info-row"><span class="label">Movimientos:</span> <span class="value" id="lumbar_movimientos"></span></div>
                <div class="info-row"><span class="label">Observación Movimientos:</span> <span class="value" id="lumbar_movimientos_observacion"></span></div>
                <div class="info-row"><span class="label">Fuerza:</span> <span class="value" id="lumbar_fuerza"></span></div>
                <div class="info-row"><span class="label">Observación Fuerza:</span> <span class="value" id="lumbar_fuerza_observacion"></span></div>
                <!-- EXPLORACIÓN COLUMNA VERTEBRAL -->
                <div class="info-row"><span class="labelTitulo">EXPLORACIÓN COLUMNA VERTEBRAL</span></div>
                <div class="info-row"><span class="label">Escoleosis:</span> <span class="value" id="vertebral_escoleosis"></span></div>
                <div class="info-row"><span class="label">Evaluación Escoleosis:</span> <span class="value" id="vertebral_evaluacion_escoleosis"></span></div>
                <div class="info-row"><span class="label">Cifosis:</span> <span class="value" id="vertebral_cifosis"></span></div>
                <div class="info-row"><span class="label">Evaluación Cifosis:</span> <span class="value" id="vertebral_evaluacion_cifosis"></span></div>
                <div class="info-row"><span class="label">Lordosis:</span> <span class="value" id="vertebral_lordosis"></span></div>
                <div class="info-row"><span class="label">Evaluación Lordosis:</span> <span class="value" id="vertebral_evaluacion_lordosis"></span></div>
                <!-- AUXILIARES DE DIAGNÓSTICO -->
                <div class="info-row"><span class="labelTitulo">AUXILIARES DE DIAGNÓSTICO</span></div>
                <div class="info-row"><span class="label">Radiografías:</span> <span class="value" id="radiografias"></span></div>
                <div class="info-row"><span class="label">Tórax:</span> <span class="value" id="torax"></span></div>
                <div class="info-row"><span class="label">Columna Lumbar:</span> <span class="value" id="colLumbar"></span></div>
                <div class="info-row"><span class="label">Laboratorio:</span> <span class="value" id="laboratorio"></span></div>
                <div class="info-row"><span class="label">Audiometría:</span> <span class="value" id="audiometria"></span></div>
                <div class="info-row"><span class="label">Otros:</span> <span class="value" id="otros"></span></div>
                <!-- OBSERVACIONES -->
                <div class="info-row"><span class="labelTitulo">OBSERVACIONES</span></div>
                <div class="info-row"><span class="label">Diagnósticos:</span> <span class="value" id="diagnosticos"></span></div>
                <div class="info-row"><span class="label">Recomendaciones:</span> <span class="value" id="recomendaciones"></span></div>
                <div class="info-row"><span class="label">Evaluación Satisfactoria:</span> <span class="value" id="evaluacion"></span></div>
                <div class="info-row"><span class="label">Fecha del Formulario:</span> <span class="value" id="fechaFormulario"></span></div>
                <div class="info-row">
                    <span class="label">Firma:</span>
                    <img id="firma" src="" alt="Sin Firma Registrada" style="max-width: 200px; display: block;" />
                </div>
            </div>
        </div>
    </div>
    <div class="boton-fuera-modal">
        <button class="btn-cerrar" onclick="cerrarModal()">Cerrar</button>
    </div>
</div>
