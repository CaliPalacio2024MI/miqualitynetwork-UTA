<?php
namespace App\Modules\Historial_clinico\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Historial_clinico\Models\Empleado;
use App\Modules\Historial_clinico\Models\HistorialLaboral;
use App\Modules\Historial_clinico\Models\HeredoFamiliares;
use App\Modules\Historial_clinico\Models\PersonalesPatologicos;
use App\Modules\Historial_clinico\Models\PersonalesNoPatologicos;
use App\Modules\Historial_clinico\Models\RiesgoTrabajo;
use App\Modules\Historial_clinico\Models\RiesgoEnfermedad;
use App\Modules\Historial_clinico\Models\Padece_Enfermedad;
use App\Modules\Historial_clinico\Models\ExploracionDatosFisicos;
use App\Modules\Historial_clinico\Models\ExploracionFisicaCraneo;
use App\Modules\Historial_clinico\Models\ExploracionFisicaCuello;
use App\Modules\Historial_clinico\Models\ExploracionFisicaBoca;
use App\Modules\Historial_clinico\Models\ExploracionFisicaOjos;
use App\Modules\Historial_clinico\Models\ExploracionFisicaNariz;
use App\Modules\Historial_clinico\Models\ExploracionFisicaOidos;
use App\Modules\Historial_clinico\Models\ExploracionFisicaVisual;
use App\Modules\Historial_clinico\Models\ExploracionFisicaAbdomen;
use App\Modules\Historial_clinico\Models\ExploracionFisicaTorax;
use App\Modules\Historial_clinico\Models\ExploracionFisicaPiel;
use App\Modules\Historial_clinico\Models\ExploracionFisicaGenitales;
use App\Modules\Historial_clinico\Models\ExploracionFisicaMiembroToracico;
use App\Modules\Historial_clinico\Models\ExploracionFisicaMiembroPelvico;
use App\Modules\Historial_clinico\Models\ExploracionFisicaColumnaCervical;
use App\Modules\Historial_clinico\Models\ExploracionFisicaColumnaDorsal;
use App\Modules\Historial_clinico\Models\ExploracionFisicaColumnaLumbar;
use App\Modules\Historial_clinico\Models\ExploracionFisicaColumnaVertebral;
use App\Modules\Historial_clinico\Models\AuxiliarDiagnostico;
use App\Modules\Historial_clinico\Models\Observacion;
use App\Models\Departamento;
use App\Models\Propiedades;
use App\Models\Puestos;  
use App\Modules\Historial_clinico\Models\Agente;  
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class formularioController extends Controller
{
        public function formulario(Request $request)
    {
        $propiedades = Propiedades::all();  
        $agentes = Agente::all();
        return view('modules.historialclinico.Formulario.formulario', compact('propiedades','agentes'));
    }
    public function obtenerDepartamentos($propiedadNombre)
    {
        // propiedad es una columna con el nombre de la propiedad (no el ID)
        $departamentos = Departamento::where('propiedad', $propiedadNombre)->get();
        return response()->json($departamentos);
    }
    public function obtenerPuestos($departamentoId)
    {
        $puestos = Puestos::where('departamento_id', $departamentoId)->get();
        return response()->json($puestos);
    }

    public function store(Request $request)
    {
    // Crear el empleado
    $empleado = Empleado::create([
        'nombre' => $request->input('nombre'),
        'edad' => $request->input('edad'),
        'genero' => $request->input('genero'),
        'estado_civil' => $request->input('estado-civil'),
        'fecha_nacimiento' => $request->input('fecha-nacimiento'),
        'direccion' => $request->input('direccion'),
        'telefono' => $request->input('telefono'),
        'escolaridad' => $request->input('escolaridad'),
        'departamento' => $request->input('departamento'),
        'razon_social' => $request->input('razon-social'),
        'no_zapato' => $request->input('no-zapato'),
        'talla_playera' => $request->input('talla-playera'),
        'talla_pantalon' => $request->input('talla-pantalon'),
        'tel_emergencia' => $request->input('tel-emergencia'),
        'puesto_aspirante' => $request->input('puesto-aspirante'),
    ]);

    // Procesar datos de historial laboral
    $empresas = $request->input('empresa', []);
    $puestos = $request->input('puesto', []);
    $tiempos = $request->input('tiempo', []);
    $agentes = $request->input('agentes', []);
    $tipoAgentes = $request->input('tipo-agente', []);

    $agentesFinal = [];

    // Combinar el agente seleccionado con su campo de texto si es "Otros"
    foreach ($agentes as $index => $agente) {
        if ($agente === 'Otros' && !empty($tipoAgentes[$index])) {
            $agentesFinal[] = $tipoAgentes[$index];
        } else {
            $agentesFinal[] = $agente;
        }
    }

    // Crear el historial laboral
    HistorialLaboral::create([
        'empleados_id' => $empleado->id,
        'edad_inicio_labores' => $request->input('edad-inicio-labores'),
        'empresas_laborado' => implode(', ', $empresas),
        'puestos_ocupados' => implode(', ', $puestos),
        'tiempo_laborado' => implode(', ', $tiempos),
        'agentes' => implode(', ', $agentesFinal),

    ]);

   
    HeredoFamiliares::create([
        'empleados_id' => $empleado->id,
        'fimicos' => $request->input('fimicos-heredofamiliares'),
        'luéticos' => $request->input('lueticos-heredofamiliares'),
        'diabéticos' => $request->input('diabeticos-heredofamiliares'),
        'cardiópatas' => $request->input('cardiopatas-heredofamiliares'),
        'epilépticos' => $request->input('epilepticos-heredofamiliares'),
        'oncologicos' => $request->input('oncologicos-heredofamiliares'),
        'malf_congen' => $request->input('malformaciones-heredofamiliares'),
        'atópicos' => $request->input('atopicos-heredofamiliares'),
        'otro' => $request->input('otro-heredofamiliares'),
    ]);
    //LOS DATOS DE LA IZQUIERDA SON COMO ESTAN DEFINIDOS EN LA BASE DE DATOS
    //LOS DATOS DE LA DERECHA SON COMO ESTAN DEFINIDOS EN EL NAME DEL FORMULARIO
    PersonalesPatologicos::create([
        'empleados_id' => $empleado->id,
        'fimicos' => $request->input('fimicos-personales'),
        'lueticos' => $request->input('lueticos-personales'),
        'diabeticos' => $request->input('diabeticos-personales'),
        'renales' => $request->input('renales-personales'),
        'cardiacos' => $request->input('cardiacos-personales'),
        'hipertensos' => $request->input('hipertensos-personales'),
        'atopicos' => $request->input('atopicos-personales'),
        'lumbalgias' => $request->input('lumbalgias-personales'),
        'traumaticos' => $request->input('traumaticos-personales'),
        'oncologicos' => $request->input('oncologicos-personales'),
        'epilepticos' => $request->input('epilepticos-personales'),
        'quirurgicos' => $request->input('quirurgicos-personales'),
        'otro' => $request->input('otros-personales'),
    ]);

// Crear antecedentes no patológicos
PersonalesNoPatologicos::create([
    'empleados_id' => $empleado->id,
    'no_patologicos_tabaquismo' => $request->tabaquismo,
    'no_patologicos_tabaquismo_especifica' => $request->especifica_tabaquismo,
    'no_patologicos_alcoholismo' => $request->alcoholismo,
    'no_patologicos_alcoholismo_especifica' => $request->especifica_alcoholismo,
    'no_patologicos_toxicomania' => $request->toxicomanias,
    'no_patologicos_toxicomania_especifica' => $request->especifica_toxicomanias,
    'no_patologicos_menarquia' => $request->menarquia,
    'no_patologicos_ritmo' => $request->ritmo,
    'no_patologicos_fum' => $request->fum,
    'no_patologicos_disminorrea' => $request->disminorrea,
    'no_patologicos_ivsa' => $request->ivsa,
    'no_patologicos_fup' => $request->fup,
    'no_patologicos_doc' => $request->doc,
    'no_patologicos_pf' => $request->pf,
    'no_patologicos_g' => $request->g,
    'no_patologicos_p' => $request->p,
    'no_patologicos_c' => $request->c,
    'no_patologicos_a' => $request->a,
]);

RiesgoTrabajo::create([
    'empleados_id' => $empleado->id,
    'riesgo' => $request->input('riesgo-trabajo'),
    'riesgo_evaluacion' => $request->input('especifica-riesgo-trabajo'),
]);

RiesgoEnfermedad::create([  
    'empleados_id' => $empleado->id,
    'enfermedad' => $request->input('riesgo-enfermedad'),
    'enfermedad_evaluacion' => $request->input('especifica-riesgo-enfermedad'),
]);
// Bloque 1: Guardar firma médico
$firmaBase64Medico = $request->input('firma_medico');
$firmaNombreMedico = null;

if ($firmaBase64Medico) {
    // Limpiar prefijo base64 para png o jpeg
    $firmaBase64Medico = preg_replace('/^data:image\/(png|jpeg);base64,/', '', $firmaBase64Medico);

    $firmaDecodificadaMedico = base64_decode($firmaBase64Medico);

    if ($firmaDecodificadaMedico !== false) {
        $firmaNombreMedico = 'firma_medico_' . time() . '.png';

        // Guardar usando Storage en carpeta "public/firma"
        Storage::disk('private')->put('firma/' . $firmaNombreMedico, $firmaDecodificadaMedico);
    } else {
        // Opcional: manejar error decodificación
    }
}
 
 
     Padece_Enfermedad::create([
         'empleados_id' => $empleado->id,
         'padece_enfermedad' => $request->input('padece-enfermedad'),
         'especifique_enfermedad' => $request->input('especifica-padece-enfermedad'),
         'mano_dominante' => $request->input('mano-dominante'),
         'firma' => $firmaNombre ?? null, // Aqui se recupera la variable "firmaNombre" para guardar el nombre
                                          //en la base de datos
     ]);
 //EXPLORACION FISICA (DATOS FISICOS)
 ExploracionDatosFisicos::create([
    'empleados_id' => $empleado->id,
    'fisico_peso' => $request->input('exploracion-fisica-peso'),
    'fisico_talla' => $request->input('exploracion-fisica-talla'),
    'fisico_ta' => $request->input('exploracion-fisica-t/a'),
    'fisico_fc' => $request->input('exploracion-fisica-fc'),
    'fisico_fr' => $request->input('exploracion-fisica-fr'),
    'fisico_imc' => $request->input('exploracion-fisica-imc'),
]);
//EXPLORACION CRANEO
ExploracionFisicaCraneo::create([
    'empleados_id' => $empleado->id,
    'forma' => $request->input('craneo-forma'),
    'tamaño' => $request->input('craneo-tamano'),
    'pelo' => $request->input('craneo-pelo'),
    'cara' => $request->input('craneo-Cara'),
]);
//EXPLORACION CUELLO
ExploracionFisicaCuello::create([
    'empleados_id' => $empleado->id,
    'ganglios' => $request->input('cuello-ganglios'),
    'movilidad' => $request->input('cuello-movilidad'),
    'tiroides' => $request->input('cuello-tiroides'),
    'pulsos' => $request->input('cuello-Pulsos'),
]);   
//EXPLORACION BOCA
ExploracionFisicaBoca::create([
    'empleados_id' => $empleado->id,
    'mucosas' => $request->input('boca-mucosas'),
    'dentadura' => $request->input('boca-dentadura'),
    'lengua' => $request->input('boca-Lengua'),
    'encias' => $request->input('boca-Encias'),
    'faringe' => $request->input('boca-faringe'),
    'amigdalas' => $request->input('boca-amigdalas'),
]);  
//EXPLORACION OJOS
ExploracionFisicaOjos::create([
    'empleados_id' => $empleado->id,
    'conjuntivas' => $request->input('ojos-Conjuntivas'),
    'pupilas' => $request->input('ojos-Pupilas'),
    'parpados' => $request->input('ojos-Parpados'),
    'reflejos' => $request->input('ojos-Reflejos'),
]);      
//EXPLORACION NARIZ    
ExploracionFisicaNariz::create([
    'empleados_id' => $empleado->id,
    'tabique' => $request->input('nariz-Tabique'),
    'mucosas' => $request->input('nariz-Mucosas'),
]);    
//EXPLORACION OIDOS  
ExploracionFisicaOidos::create([
    'empleados_id' => $empleado->id,
    'pabellon' => $request->input('oido-Pabellon'),
    'cae' => $request->input('oido-cae'),
    'timpanos' => $request->input('oido-timpanos'),
]);   
//EXPLORACION AGUDEZA VISUAL   
ExploracionFisicaVisual::create([
    'empleados_id' => $empleado->id,
    'SL' => $request->input('agudeza-visual-sl'),
    'CL' => $request->input('agudeza-visual-cl'),
]);   
//EXPLORACION ABDOMEN
ExploracionFisicaAbdomen::create([
    'empleados_id' => $empleado->id,
    'megalias' => $request->input('abdomen-Megalias'),
    'hernias' => $request->input('abdomen-Hernias'),
]);    
//EXPLORACION TORAX 
ExploracionFisicaTorax::create([
    'empleados_id' => $empleado->id,
    'forma' => $request->input('torax-forma'),
    'ritmos_Cardiacos' => $request->input('torax-rCardiacos'),
    'campos_pulm' => $request->input('torax-cPulm'),
    'mamas' => $request->input('torax-Mamas'),
]);   
//EXPLORACION PIEL Y ANEXOS   
ExploracionFisicaPiel::create([
    'empleados_id' => $empleado->id,
    'nevos' => $request->input('piel-nevos'),
    'cicatrices' => $request->input('piel-Cicatrices'),
    'varices' => $request->input('piel-Varices'),
    'edemas' => $request->input('piel-Edemas'),
    'micosis' => $request->input('piel-Micosis'),
]);  
//EXPLORACION GENITALES   
ExploracionFisicaGenitales::create([
    'empleados_id' => $empleado->id,
    'fimosis' => $request->input('genitales-fimosis'),
    'varicocele' => $request->input('genitales-Varicocele'),
    'hernias' => $request->input('genitales-Hernias'),
    'criptorquidias' => $request->input('genitales-Criptorquidias'),
]);     
//EXPLORACION MIEMBROS TORACIDOS
ExploracionFisicaMiembroToracico::create([
    'empleados_id' => $empleado->id,
    'integridad' => $request->input('miembros-toraxicos-Integridad'),
    'integridad_observacion' => $request->input('especifica-miembro-integridad'),
    'forma' => $request->input('miembros-toraxicos-forma'),
    'forma_observacion' => $request->input('especifica-miembro-forma'),
    'articulaciones' => $request->input('miembros-toraxicos-Articulaciones'),
    'articulaciones_observacion' => $request->input('especifica-miembro-articulaciones'),
    'tono_muscular' => $request->input('miembros-toraxicos-tonoMuscular'),
    'tono_muscular_observacion' => $request->input('especifica-miembro-tonoMuscular'),
    'reflejos' => $request->input('miembros-toraxicos-Reflejos'),
    'reflejos_observacion' => $request->input('especifica-miembro-Reflejos'),
    'sensibilidad' => $request->input('miembros-toraxicos-Sensibilidad'),
    'sensibilidad_observacion' => $request->input('especifica-miembro-Sensibilidad'),
]); 
//EXPLORACION MIEMBROS PELVICOS  
ExploracionFisicaMiembroPelvico::create([
    'empleados_id' => $empleado->id,
    'integridad' => $request->input('miembros-pelvicos-Integridad'),
    'integridad_observacion' => $request->input('especifica-miembro-integridad'),
    'forma' => $request->input('miembros-pelvicos-Forma'),
    'forma_observacion' => $request->input('especifica-miembro-forma'),
    'articulaciones' => $request->input('miembros-pelvicos-Articulaciones'),
    'articulaciones_observacion' => $request->input('especifica-miembro-articulaciones'),
    'tono_muscular' => $request->input('miembros-toraxicos-tonoMuscular'),
    'tono_muscular_observacion' => $request->input('especifica-miembro-tonoMuscular'),
    'reflejos' => $request->input('miembros-pelvicos-Reflejos'),
    'reflejos_observacion' => $request->input('especifica-miembro-Reflejos'),
    'sensibilidad' => $request->input('miembros-pelvicos-Sensibilidad'),
    'sensibilidad_observacion' => $request->input('especifica-miembro-Sensibilidad'),
]);  
//EXPLORACION COLUMNA CERVICAL    
ExploracionFisicaColumnaCervical::create([
    'empleados_id' => $empleado->id,
    'integridad' => $request->input('columna-cervical-integridad'),
    'integridad_observacion' => $request->input('Columna-vertebral-integridad'),
    'forma' => $request->input('columna-cervical-Forma'),
    'forma_observacion' => $request->input('Columna-vertebral-Forma'),
    'movimientos' => $request->input('columna-cervical-Movimientos'),
    'movimientos_observacion' => $request->input('Columna-vertebral-Movimientos'),
    'fuerza' => $request->input('columna-cervical-Fuerza'),
    'fuerza_observacion' => $request->input('Columna-vertebral-Fuerza'),
]);
//EXPLORACION COLUMNA DORSAL      
ExploracionFisicaColumnaDorsal::create([
    'empleados_id' => $empleado->id,
    'integridad' => $request->input('columna-dorsal-integridad'),
    'integridad_observacion' => $request->input('Columna-vertebral-integridad'),
    'forma' => $request->input('columna-dorsal-Forma'),
    'forma_observacion' => $request->input('Columna-vertebral-Forma'),
    'movimientos' => $request->input('columna-dorsal-Movimientos'),
    'movimientos_observacion' => $request->input('Columna-vertebral-Movimientos'),
    'fuerza' => $request->input('columna-dorsal-Fuerza'),
    'fuerza_observacion' => $request->input('Columna-vertebral-Fuerza'),
]);   
//EXPLORACION COLUMNA LUMBAR   
ExploracionFisicaColumnaLumbar::create([
    'empleados_id' => $empleado->id,
    'integridad' => $request->input('columna-lumbar-integridad'),
    'integridad_observacion' => $request->input('Columna-vertebral-integridad'),
    'forma' => $request->input('columna-lumbar-Forma'),
    'forma_observacion' => $request->input('Columna-vertebral-Forma'),
    'movimientos' => $request->input('columna-lumbar-Movimientos'),
    'movimientos_observacion' => $request->input('Columna-vertebral-Movimientos'),
    'fuerza' => $request->input('columna-lumbar-Fuerza'),
    'fuerza_observacion' => $request->input('Columna-vertebral-Fuerza'),
]);           
                //EXPLORACION COLUMNA VERTEBRAL               
ExploracionFisicaColumnaVertebral::create([
    'empleados_id' => $empleado->id,
    'escoleosis' => $request->input('columna-cervical-Escoleosis'),
    'evaluacion_escoleosis' => $request->input('Columna-vertebral-Escoleosis'),
    'cifosis' => $request->input('columna-cervical-Cifosis'),
    'evaluacion_cifosis' => $request->input('Columna-vertebral-Cifosis'),
    'lordosis' => $request->input('columna-cervical-Lordosis'),
    'evaluacion_lordosis' => $request->input('Columna-vertebral-Lordosis'),
]);   

 // Guardar auxiliares diagnósticos
 $radiografias = '';
 $torax = '';
 $col_lumbar = '';
 $laboratorio = '';
 $audiometria = '';
 $otros = '';

 if ($request->has('diagnostico')) {
     foreach ($request->input('diagnostico') as $index => $diagnostico) {
         $detalle = $request->input('diagnostico-detalle')[$index] ?? '';
         switch ($diagnostico) {
             case 'Radiografía':
                 $radiografias .= ($radiografias ? ', ' : '') . ($detalle ?: 'Sí');
                 break;
             case 'Tórax':
                 $torax .= ($torax ? ', ' : '') . ($detalle ?: 'Sí');
                 break;
             case 'Col. Lumbar':
                 $col_lumbar .= ($col_lumbar ? ', ' : '') . ($detalle ?: 'Sí');
                 break;
             case 'Laboratorio':
                 $laboratorio .= ($laboratorio ? ', ' : '') . ($detalle ?: 'Sí');
                 break;
             case 'Audiometría':
                 $audiometria .= ($audiometria ? ', ' : '') . ($detalle ?: 'Sí');
                 break;
             case 'Otro':
                 $otros .= ($otros ? ', ' : '') . $detalle;
                 break;
         }
     }
 }

 AuxiliarDiagnostico::create([
     'empleados_id' => $empleado->id,
     'radiografias' => $radiografias ?: 'No',
     'torax' => $torax ?: 'No',
     'col_lumbar' => $col_lumbar ?: 'No',
     'laboratorio' => $laboratorio ?: 'No',
     'audiometria' => $audiometria ?: 'No',
     'otros' => $otros ?: 'Ninguno',
 ]);


// Bloque 2: Guardar firma general
$firmaBase64 = $request->input('firma');

if ($firmaBase64) {
    $firmaBase64 = preg_replace('/^data:image\/(png|jpeg);base64,/', '', $firmaBase64);

    $firmaDecodificada = base64_decode($firmaBase64);

    if ($firmaDecodificada !== false) {
        $firmaNombre = 'firma_' . time() . '.png';

        Storage::disk('private')->put('firma/' . $firmaNombre, $firmaDecodificada);
    } else {
        // Opcional: manejar error decodificación
    }
}

    Observacion::create([
        'empleados_id' => $empleado->id,
        'diagnosticos' => $request->has('conclusiones_diagnostico') ? implode(', ', array_filter($request->input('conclusiones_diagnostico'))) : null,
        'recomendaciones' => $request->has('recomendacion') ? implode(', ', array_filter($request->input('recomendacion'))) : null,
        'evaluacion_satisfactoria' => $request->input('satisfactorio'),
        'fecha_formulario' => $request->input('observacion-fecha'),
        'firma_formulario' => $firmaNombreMedico, // Guardar el nombre del archivo
        'salud_ocupacional' => $request->input('observacion-Salud-Ocupacional'),
    ]);
    
    return redirect()->back()->with('success', 'Formulario enviado correctamente.');
}

public function imprimirFormulario(Request $request)
{
    $datos = $request->all();
    $datos['razon-social'] = $request->input('razon-social', '');
    $datos['no-zapato'] = $request->input('no-zapato', '');
    $datos['talla-playera'] = $request->input('talla-playera', '');
    $datos['talla-pantalon'] = $request->input('talla-pantalon', '');
    $datos['tel-emergencia'] = $request->input('tel-emergencia', '');
    $datos['nombre'] = $request->input('nombre', '');
    $datos['edad'] = $request->input('edad', '');
    $datos['genero'] = $request->input('genero', '');
    $datos['estado-civil'] = $request->input('estado-civil', '');
    $datos['fecha-nacimiento'] = $request->input('fecha-nacimiento', '');
    $datos['direccion'] = $request->input('direccion', '');
    $datos['telefono'] = $request->input('telefono', '');
    $datos['escolaridad'] = $request->input('escolaridad', '');
    $datos['departamento'] = $request->input('departamento', '');
    $datos['puesto-aspirante'] = $request->input('puesto-aspirante', '');

    $datos['edad-inicio-labores'] = $request->input('edad-inicio-labores', '');
    $datos['empresa[]'] = $request->input('empresa[]', '');
    $datos['puesto[]'] = $request->input('puesto[]', '');
    $datos['tiempo[]'] = $request->input('tiempo[]', '');
    $datos['agentes[]'] = $request->input('agentes[]', '');

    $datos['exploracion-fisica-peso'] = $request->input('exploracion-fisica-peso', '');
    $datos['exploracion-fisica-talla'] = $request->input('exploracion-fisica-talla', '');
    $datos['exploracion-fisica-t/a'] = $request->input('exploracion-fisica-t/a', '');
    $datos['exploracion-fisica-fc'] = $request->input('exploracion-fisica-fc', '');
    $datos['exploracion-fisica-fr'] = $request->input('exploracion-fisica-fr', '');
    $datos['exploracion-fisica-imc'] = $request->input('exploracion-fisica-imc', '');

    // Recupera la firma del candidato (ya lo tienes)
    $firmaBase64 = $request->input('firma');
    $datos['firmaBase64'] = $firmaBase64;

    // Recupera la firma del médico
    $firmaBase64Medico = $request->input('firma_medico');
    $datos['firmaBase64Medico'] = $firmaBase64Medico;

    // Recupera los auxiliares diagnósticos
    $diagnosticosAuxiliares = $request->input('diagnostico', []);
    $diagnosticosDetalle = $request->input('diagnostico-detalle', []);
    $auxiliares = [];
    foreach ($diagnosticosAuxiliares as $index => $diagnostico) {
        $detalle = $diagnosticosDetalle[$index] ?? '';
        $auxiliares[] = $diagnostico . ($detalle ? ': ' . $detalle : '');
    }
    $datos['auxiliares_diagnosticos'] = $auxiliares;

    // Recupera las conclusiones (diagnósticos y recomendaciones)
    $datos['conclusiones_diagnostico'] = $request->input('conclusiones_diagnostico', []);
    $datos['recomendaciones'] = $request->input('recomendacion', []);

    // Recupera la evaluación satisfactoria
    $datos['satisfactorio'] = $request->input('satisfactorio');

    // Recupera las observaciones
    $datos['observacion_fecha'] = $request->input('observacion-fecha');
    $datos['salud_ocupacional'] = $request->input('observacion-Salud-Ocupacional');

    // Lógica para antecedentes laborales (ya la tienes)
    $agentes = $request->input('agentes', []);
    $tipoAgentes = $request->input('tipo-agente', []);
    $agentesFinal = [];
    foreach ($agentes as $index => $agente) {
        if ($agente === 'Otros' && !empty($tipoAgentes[$index])) {
            $agentesFinal[$index] = $tipoAgentes[$index];
        } else {
            $agentesFinal[$index] = $agente;
        }
    }
    $datos['agentesFinal'] = $agentesFinal;
    $empresas = $datos['empresa'] ?? [];
    $numAgentes = count($agentesFinal);
    $numEmpresas = count($empresas);
    if ($numEmpresas < $numAgentes) {
        $diff = $numAgentes - $numEmpresas;
        $datos['empresa'] = array_merge($empresas, array_fill(0, $diff, ''));
    }

    // Configuración de dompdf
    $pdf = Pdf::loadView('modules.historialclinico.Formulario.formulario_descarga', ['datos' => $datos]);
    $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    return $pdf->download('formulario_descarga.pdf');
}
}