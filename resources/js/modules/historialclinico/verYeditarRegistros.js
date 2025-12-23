
// Función para mostrar el modal
function mostrarRegistro(idEmpleado) {
    fetch('/empleado/' + idEmpleado)
        .then(response => response.json())
        .then(data => {
            // Llenar Ficha de Identificacion
            document.getElementById('nombre').textContent = data.nombre;
            document.getElementById('edad').textContent = data.edad;
            document.getElementById('genero').textContent = data.genero;
            document.getElementById('estadoCivil').textContent = data.estado_civil;
            document.getElementById('fechaNacimiento').textContent = data.fecha_nacimiento;
            document.getElementById('direccion').textContent = data.direccion;
            document.getElementById('telefono').textContent = data.telefono;
            document.getElementById('escolaridad').textContent = data.escolaridad;
            document.getElementById('razonSocial').textContent = data.razon_social;
            //Llenar Antecedentes Laborales
            document.getElementById('edadLabores').textContent = data.edad_inicio_labores;
            document.getElementById('empresa').textContent = data.empresas_laborado;
            document.getElementById('puesto').textContent = data.puestos_ocupados;
            document.getElementById('tiempo').textContent = data.tiempo_laborado;
            document.getElementById('agentes').textContent = data.agentes;
            //Heredo Familiares
            document.getElementById('fimicos').textContent = data.fimicos;
            document.getElementById('lueticos').textContent = data.luéticos;
            document.getElementById('diabeticos').textContent = data.diabéticos;
            document.getElementById('cardiopatas').textContent = data.cardiópatas;
            document.getElementById('epilepticos').textContent = data.epilépticos;
            document.getElementById('oncologicos').textContent = data.oncologicos;
            document.getElementById('malfCongen').textContent = data.malf_congen;
            document.getElementById('atopocos').textContent = data.atópicos;
            document.getElementById('otro').textContent = data.otro;
            // Personales Patológicos
            document.getElementById('fimicosPersonales').textContent = data.fimicos_personales;
            document.getElementById('lueticosPersonales').textContent = data.lueticos_personales;
            document.getElementById('diabeticosPersonales').textContent = data.diabeticos_personales;
            document.getElementById('renales').textContent = data.renales;
            document.getElementById('cardiacos').textContent = data.cardiacos;
            document.getElementById('hipertensos').textContent = data.hipertensos;
            document.getElementById('atopicosPersonales').textContent = data.atopicos_personales;
            document.getElementById('lumbalgias').textContent = data.lumbalgias;
            document.getElementById('traumaticos').textContent = data.traumaticos;
            document.getElementById('oncologicosPersonales').textContent = data.oncologicos_personales;
            document.getElementById('epilepticosPersonales').textContent = data.epilepticos_personales;
            document.getElementById('quirurgicos').textContent = data.quirurgicos;
            document.getElementById('otroPersonales').textContent = data.otro_personales;
            // Personales No Patológicos
            document.getElementById('tabaquismo').textContent = data.no_patologicos_tabaquismo;
            document.getElementById('especificaTabaquismo').textContent = data.no_patologicos_tabaquismo_especifica;
            document.getElementById('alcoholismo').textContent = data.no_patologicos_alcoholismo;
            document.getElementById('especificaAlcoholismo').textContent = data.no_patologicos_alcoholismo_especifica;
            document.getElementById('toxicomanias').textContent = data.no_patologicos_toxicomania;
            document.getElementById('especificaToxicomanias').textContent = data.no_patologicos_toxicomania_especifica;
            document.getElementById('menarquia').textContent = data.no_patologicos_menarquia;
            document.getElementById('ritmo').textContent = data.no_patologicos_ritmo;
            document.getElementById('fum').textContent = data.no_patologicos_fum;
            document.getElementById('disminorrea').textContent = data.no_patologicos_disminorrea;
            document.getElementById('ivsa').textContent = data.no_patologicos_ivsa;
            document.getElementById('fup').textContent = data.no_patologicos_fup;
            // Riesgos de Trabajo
            document.getElementById('riesgoTrabajo').textContent = data.riesgo_trabajo;
            document.getElementById('riesgoEvaluacion').textContent = data.riesgo_evaluacion;
            // Riesgos de Enfermedad
            document.getElementById('riesgoEnfermedad').textContent = data.riesgo_enfermedad;
            document.getElementById('enfermedadEvaluacion').textContent = data.enfermedad_evaluacion;
            // Padece Enfermedad
            document.getElementById('padeceEnfermedad').textContent = data.padece_enfermedad;
            document.getElementById('especifiqueEnfermedad').textContent = data.especifique_enfermedad;
            document.getElementById('manoDominante').textContent = data.mano_dominante;
            const firmaPath = data.firma ? `/storage/firma/${data.firma}` : '';
            document.getElementById('firmaImg').src = firmaPath;
            // Datos físicos
            document.getElementById('fisico_peso').textContent = data.fisico_peso;
            document.getElementById('fisico_talla').textContent = data.fisico_talla;
            document.getElementById('fisico_ta').textContent = data.fisico_ta;
            document.getElementById('fisico_fc').textContent = data.fisico_fc;
            document.getElementById('fisico_fr').textContent = data.fisico_fr;
            document.getElementById('fisico_imc').textContent = data.fisico_imc;
            // Cráneo
            document.getElementById('craneo_forma').textContent = data.craneo_forma;
            document.getElementById('craneo_tamano').textContent = data.craneo_tamano;
            document.getElementById('craneo_pelo').textContent = data.craneo_pelo;
            document.getElementById('craneo_cara').textContent = data.craneo_cara;                  
            // CUELLO
            document.getElementById('cuello_ganglios').textContent = data.cuello_ganglios;
            document.getElementById('cuello_movilidad').textContent = data.cuello_movilidad;
            document.getElementById('cuello_tiroides').textContent = data.cuello_tiroides;
            document.getElementById('cuello_pulsos').textContent = data.cuello_pulsos;
            // BOCA
            document.getElementById('boca_mucosas').textContent = data.boca_mucosas;
            document.getElementById('boca_dentadura').textContent = data.boca_dentadura;
            document.getElementById('boca_lengua').textContent = data.boca_lengua;
            document.getElementById('boca_encias').textContent = data.boca_encias;
            document.getElementById('boca_faringe').textContent = data.boca_faringe;
            document.getElementById('boca_amigdalas').textContent = data.boca_amigdalas;
            // OJOS
            document.getElementById('ojos_conjuntivas').textContent = data.ojos_conjuntivas;
            document.getElementById('ojos_pupilas').textContent = data.ojos_pupilas;
            document.getElementById('ojos_parpados').textContent = data.ojos_parpados;
            document.getElementById('ojos_reflejos').textContent = data.ojos_reflejos;
            // NARIZ
            document.getElementById('nariz_tabique').textContent = data.nariz_tabique;
            document.getElementById('nariz_mucosas').textContent = data.nariz_mucosas;
            // OIDOS
            document.getElementById('oido_pabellon').textContent = data.oido_pabellon;
            document.getElementById('oido_cae').textContent = data.oido_cae;
            document.getElementById('oido_timpanos').textContent = data.oido_timpanos;
            // AGUDEZA VISUAL
            document.getElementById('visual_sl').textContent = data.visual_sl;
            document.getElementById('visual_cl').textContent = data.visual_cl;
            // ABDOMEN
            document.getElementById('abdomen_megalias').textContent = data.abdomen_megalias;
            document.getElementById('abdomen_hernias').textContent = data.abdomen_hernias;
            // TORAX
            document.getElementById('torax_forma').textContent = data.torax_forma;
            document.getElementById('torax_ritmos').textContent = data.torax_ritmos;
            document.getElementById('torax_campos').textContent = data.torax_campos;
            document.getElementById('torax_mamas').textContent = data.torax_mamas;
            // PIEL
            document.getElementById('piel_nevos').textContent = data.piel_nevos;
            document.getElementById('piel_cicatrices').textContent = data.piel_cicatrices;
            document.getElementById('piel_varices').textContent = data.piel_varices;
            document.getElementById('piel_edemas').textContent = data.piel_edemas;
            document.getElementById('piel_micosis').textContent = data.piel_micosis;
            // GENITALES
            document.getElementById('genitales_fimosis').textContent = data.genitales_fimosis;
            document.getElementById('genitales_varicocele').textContent = data.genitales_varicocele;
            document.getElementById('genitales_hernias').textContent = data.genitales_hernias;
            document.getElementById('genitales_criptorquidias').textContent = data.genitales_criptorquidias;
            // MIEMBROS TORÁCICOS
            document.getElementById('miembro_integridad').textContent = data.miembro_integridad;
            document.getElementById('miembro_integridad_obs').textContent = data.miembro_integridad_obs;
            document.getElementById('miembro_forma').textContent = data.miembro_forma;
            document.getElementById('miembro_forma_obs').textContent = data.miembro_forma_obs;
            document.getElementById('miembro_articulaciones').textContent = data.miembro_articulaciones;
            document.getElementById('miembro_articulaciones_obs').textContent = data.miembro_articulaciones_obs;
            document.getElementById('miembro_tono').textContent = data.miembro_tono;
            document.getElementById('miembro_tono_obs').textContent = data.miembro_tono_obs;
            document.getElementById('miembro_reflejos').textContent = data.miembro_reflejos;
            document.getElementById('miembro_reflejos_obs').textContent = data.miembro_reflejos_obs;
            document.getElementById('miembro_sensibilidad').textContent = data.miembro_sensibilidad;
            document.getElementById('miembro_sensibilidad_obs').textContent = data.miembro_sensibilidad_obs;
            // Exploración Miembros Pélvicos
            document.getElementById('integridad').textContent = data.integridad;
            document.getElementById('integridadObs').textContent = data.integridadObs;
            document.getElementById('forma').textContent = data.forma;
            document.getElementById('formaObs').textContent = data.formaObs;
            document.getElementById('articulaciones').textContent = data.articulaciones;
            document.getElementById('articulacionesObs').textContent = data.articulacionesObs;
            document.getElementById('tonoMuscular').textContent = data.tonoMuscular;
            document.getElementById('tonoMuscularObs').textContent = data.tonoMuscularObs;
            document.getElementById('reflejos').textContent = data.reflejos;
            document.getElementById('reflejosObs').textContent = data.reflejosObs;
            // Llenar Exploración Cervical
            document.getElementById('cervical_integridad').textContent = data.cervical_integridad;
            document.getElementById('cervical_integridad_observacion').textContent = data.cervical_integridad_observacion;
            document.getElementById('cervical_forma').textContent = data.cervical_forma;
            document.getElementById('cervical_forma_observacion').textContent = data.cervical_forma_observacion;
            document.getElementById('cervical_movimientos').textContent = data.cervical_movimientos;
            document.getElementById('cervical_movimientos_observacion').textContent = data.cervical_movimientos_observacion;
            document.getElementById('cervical_fuerza').textContent = data.cervical_fuerza;
            document.getElementById('cervical_fuerza_observacion').textContent = data.cervical_fuerza_observacion;
            // Llenar Exploración Dorsal
            document.getElementById('dorsal_integridad').textContent = data.dorsal_integridad;
            document.getElementById('dorsal_integridad_observacion').textContent = data.dorsal_integridad_observacion;
            document.getElementById('dorsal_forma').textContent = data.dorsal_forma;
            document.getElementById('dorsal_forma_observacion').textContent = data.dorsal_forma_observacion;
            document.getElementById('dorsal_movimientos').textContent = data.dorsal_movimientos;
            document.getElementById('dorsal_movimientos_observacion').textContent = data.dorsal_movimientos_observacion;
            document.getElementById('dorsal_fuerza').textContent = data.dorsal_fuerza;
            document.getElementById('dorsal_fuerza_observacion').textContent = data.dorsal_fuerza_observacion;
            // Llenar Exploración Columna Lumbar
            document.getElementById('lumbar_integridad').textContent = data.lumbar_integridad;
            document.getElementById('lumbar_integridad_observacion').textContent = data.lumbar_integridad_observacion;
            document.getElementById('lumbar_forma').textContent = data.lumbar_forma;
            document.getElementById('lumbar_forma_observacion').textContent = data.lumbar_forma_observacion;
            document.getElementById('lumbar_movimientos').textContent = data.lumbar_movimientos;
            document.getElementById('lumbar_movimientos_observacion').textContent = data.lumbar_movimientos_observacion;
            document.getElementById('lumbar_fuerza').textContent = data.lumbar_fuerza;
            document.getElementById('lumbar_fuerza_observacion').textContent = data.lumbar_fuerza_observacion;
            // Llenar Exploración Columna Vertebral
            document.getElementById('vertebral_escoleosis').textContent = data.vertebral_escoleosis;
            document.getElementById('vertebral_evaluacion_escoleosis').textContent = data.vertebral_evaluacion_escoleosis;
            document.getElementById('vertebral_cifosis').textContent = data.vertebral_cifosis;
            document.getElementById('vertebral_evaluacion_cifosis').textContent = data.vertebral_evaluacion_cifosis;
            document.getElementById('vertebral_lordosis').textContent = data.vertebral_lordosis;
            document.getElementById('vertebral_evaluacion_lordosis').textContent = data.vertebral_evaluacion_lordosis;
            // Auxiliares Diagnóstico
            document.getElementById('radiografias').textContent = data.radiografias;
            document.getElementById('torax').textContent = data.torax;
            document.getElementById('colLumbar').textContent = data.col_lumbar;
            document.getElementById('laboratorio').textContent = data.laboratorio;
            document.getElementById('audiometria').textContent = data.audiometria;
            document.getElementById('otros').textContent = data.otros;
            // Observaciones
            document.getElementById('diagnosticos').textContent = data.diagnosticos;
            document.getElementById('recomendaciones').textContent = data.recomendaciones;
            document.getElementById('evaluacion').textContent = data.evaluacion_satisfactoria;
            document.getElementById('fechaFormulario').textContent = data.fecha_formulario;
            const firmaConclusion = data.firma_formulario ? `/storage/firma/${data.firma_formulario}` : '';
            document.getElementById('firma').src = firmaConclusion;


            // Mostrar el modal
            document.getElementById('registroModal').style.display = 'block';
        })
        .catch(error => {
            
        });
        
}
    window.mostrarRegistro = mostrarRegistro;

// Función para cerrar el modal
function cerrarModal() {
    document.getElementById('registroModal').style.display = 'none';
}
    window.cerrarModal = cerrarModal;


function editRegister(idEmpleado) {
    fetch('/formEdit/' + idEmpleado)
        .then(response => {
            if (!response.ok) {
                throw new Error('No se pudo cargar el formulario');
            }
            return response.text(); // HTML parcial
        })
        .then(html => {
            const container = document.getElementById('reportContent');
            container.innerHTML = html;

            // Mostrar el modal
            document.getElementById('editModal').style.display = 'block';

            // Evento para cerrar el modal con el botón (X)
            document.querySelector('.close').onclick = function() {
                document.getElementById('editModal').style.display = 'none';
            };

            // Cerrar al hacer clic fuera del contenido
            window.onclick = function(event) {
                const modal = document.getElementById('editModal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };
        })
        .catch(error => {
            console.error('Error al cargar el formulario:', error);
            alert('Ocurrió un error al intentar editar.');
        });
}
        window.editRegister = editRegister;

function cerrarModals() {
    document.getElementById('registroModal').style.display = 'none';
}
        window.cerrarModals = cerrarModals;
