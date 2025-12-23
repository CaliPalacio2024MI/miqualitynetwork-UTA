<?php

namespace App\Modules\Historial_clinico\Http\Controllers;
use App\Http\Controllers\Controller;
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
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    
    public function estadisticas(Request $request)
{
    $query = Empleado::query();

    // Filtros generales
    if ($request->filled('puesto_aspirante')) {
        $query->where('puesto_aspirante', $request->puesto_aspirante);
    }
    if ($request->filled('razon_social')) {
        $query->where('razon_social', $request->razon_social);
    }

    $empleadosFiltradosIds = $query->pluck('id');
    $total = $empleadosFiltradosIds->count();

    // Riesgos generales
    $rt = RiesgoTrabajo::whereIn('empleados_id', $empleadosFiltradosIds)
        ->whereNotNull('riesgo_evaluacion')->count();

    $ec = RiesgoEnfermedad::whereIn('empleados_id', $empleadosFiltradosIds)
        ->whereNotNull('enfermedad_evaluacion')->count();

    // Heredofamiliares generales
    $camposHeredo = [
        'fimicos', 'luéticos', 'diabéticos', 'cardiópatas', 'epilépticos',
        'oncologicos', 'malf_congen', 'atópicos',
    ];
    $conteoHeredo = array_fill_keys($camposHeredo, 0);
    $heredos = HeredoFamiliares::whereIn('empleados_id', $empleadosFiltradosIds)->get();
    foreach ($heredos as $registro) {
        foreach ($camposHeredo as $campo) {
            if (strtolower(trim($registro->$campo)) === 'si') {
                $conteoHeredo[$campo]++;
            }
        }
    }
    arsort($conteoHeredo);
    $top3Heredo = array_slice($conteoHeredo, 0, 3, true);

    $prevalencia = Padece_Enfermedad::whereIn('empleados_id', $empleadosFiltradosIds)
        ->whereNotNull('especifique_enfermedad')
        ->select('especifique_enfermedad', DB::raw('count(*) as cantidad'))
        ->groupBy('especifique_enfermedad')
        ->orderByDesc('cantidad')
        ->take(5)
        ->get();

    $empleadosConPatologia = Padece_Enfermedad::whereIn('empleados_id', $empleadosFiltradosIds)
        ->whereNotNull('padece_enfermedad')
        ->count();

    $porcentajePatologia = $total > 0 ? ($empleadosConPatologia / $total) * 100 : 0;

    // IMC general
    $imcData = ExploracionDatosFisicos::whereIn('empleados_id', $empleadosFiltradosIds)->pluck('fisico_imc');
    $rangosIMC = ['Bajo peso' => 0, 'Normal' => 0, 'Sobrepeso' => 0, 'Obesidad' => 0];
    $sobrepesoObesidadGeneral = 0;
    foreach ($imcData as $imc) {
        if ($imc < 18.5) $rangosIMC['Bajo peso']++;
        elseif ($imc < 25) $rangosIMC['Normal']++;
        elseif ($imc < 30) {
            $rangosIMC['Sobrepeso']++;
            $sobrepesoObesidadGeneral++;
        } else {
            $rangosIMC['Obesidad']++;
            $sobrepesoObesidadGeneral++;
        }
    }
    $porcentajeImcSobrepesoObesidadGeneral = ($total > 0) ? ($sobrepesoObesidadGeneral / $total) * 100 : 0;

    // Género y escolaridad
    $generoEscolaridadData = Empleado::whereIn('id', $empleadosFiltradosIds)
        ->select('genero', 'escolaridad', DB::raw('count(*) as total'))
        ->groupBy('genero', 'escolaridad')
        ->get();
    $labelsGeneroEscolaridad = [];
    $dataGeneroEscolaridad = [];
    foreach ($generoEscolaridadData as $item) {
        $labelsGeneroEscolaridad[] = $item->genero . ' - ' . $item->escolaridad;
        $dataGeneroEscolaridad[] = $item->total;
    }

    // Signos vitales
    $signos = ExploracionDatosFisicos::whereIn('empleados_id', $empleadosFiltradosIds)
        ->select(
            DB::raw('AVG(fisico_ta) as ta'),
            DB::raw('AVG(fisico_fc) as fc'),
            DB::raw('AVG(fisico_fr) as fr')
        )
        ->first();
    $promedioSignos = [
        'TA' => round($signos->ta ?? 0, 2),
        'FC' => round($signos->fc ?? 0, 2),
        'FR' => round($signos->fr ?? 0, 2),
    ];

    // Anomalías físicas
    $zonas = [
        'Craneo' => ExploracionFisicaCraneo::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Cuello' => ExploracionFisicaCuello::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Boca' => ExploracionFisicaBoca::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Ojos' => ExploracionFisicaOjos::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Nariz' => ExploracionFisicaNariz::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Oídos' => ExploracionFisicaOidos::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Abdomen' => ExploracionFisicaAbdomen::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Tórax' => ExploracionFisicaTorax::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Piel' => ExploracionFisicaPiel::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
        'Genitales' => ExploracionFisicaGenitales::whereIn('empleados_id', $empleadosFiltradosIds)->count(),
    ];
    $totalAnomaliasGeneral = array_sum($zonas);
    $promedioAnomaliasPorEmpleadoGeneral = ($total > 0) ? ($totalAnomaliasGeneral / $total) : 0;

    // SPIDER CHART GENERAL
    $spiderGeneralLabels = [
        'Riesgo Trabajo',
        'Riesgo Enfermedad',
        'Patología Detectada',
        'Sobrepeso/Obesidad',
        'Anomalías Físicas (Avg)',
        'Heredofamiliares Relevantes (%)'
    ];
    $spiderGeneralMaxValues = [100, 100, 100, 100, null, 100];

    // Se completará luego el valor de 'Heredofamiliares Relevantes (%)' por cada razón
    $spiderGeneralValues = [
        round(($total > 0 ? ($rt / $total) * 100 : 0), 2),
        round(($total > 0 ? ($ec / $total) * 100 : 0), 2),
        round($porcentajePatologia, 2),
        round($porcentajeImcSobrepesoObesidadGeneral, 2),
        round($promedioAnomaliasPorEmpleadoGeneral, 2),
        null // placeholder
    ];

    // DATOS POR RAZÓN SOCIAL
    $razonesSociales = Empleado::whereIn('id', $empleadosFiltradosIds)
        ->whereNotNull('razon_social')
        ->distinct()
        ->pluck('razon_social')
        ->toArray();

    $dataByRazonSocial = [];
    $heredofamiliaresGlobal = 0;
    $empleadosGlobal = 0;

        foreach ($razonesSociales as $razonSocial) {
            $empleadosPorRazon = Empleado::whereIn('id', $empleadosFiltradosIds)
                ->where('razon_social', $razonSocial)
                ->pluck('id');

            $totalEmpleadosRazon = $empleadosPorRazon->count();

            if ($totalEmpleadosRazon === 0) {
                continue; // Saltar si no hay empleados para esta razón social
            }

            // --- Cálculos específicos para el Spider Chart por razon_social ---
            $rtRazon = RiesgoTrabajo::whereIn('empleados_id', $empleadosPorRazon)
                ->whereNotNull('riesgo_evaluacion')
                ->count();
            $porcentajeRtRazon = ($totalEmpleadosRazon > 0) ? ($rtRazon / $totalEmpleadosRazon) * 100 : 0;

            $ecRazon = RiesgoEnfermedad::whereIn('empleados_id', $empleadosPorRazon)
                ->whereNotNull('enfermedad_evaluacion')
                ->count();
            $porcentajeEcRazon = ($totalEmpleadosRazon > 0) ? ($ecRazon / $totalEmpleadosRazon) * 100 : 0;

            $empleadosConPatologiaRazon = Padece_Enfermedad::whereIn('empleados_id', $empleadosPorRazon)
                ->whereNotNull('padece_enfermedad')
                ->count();
            $porcentajePatologiaRazon = ($totalEmpleadosRazon > 0) ? ($empleadosConPatologiaRazon / $totalEmpleadosRazon) * 100 : 0;

            $imcDataRazon = ExploracionDatosFisicos::whereIn('empleados_id', $empleadosPorRazon)->pluck('fisico_imc');
            $sobrepesoObesidadRazon = 0;
            foreach ($imcDataRazon as $imc) {
                if ($imc >= 25) { // Incluye Sobrepeso y Obesidad
                    $sobrepesoObesidadRazon++;
                }
            }
            $porcentajeImcSobrepesoObesidadRazon = ($totalEmpleadosRazon > 0) ? ($sobrepesoObesidadRazon / $totalEmpleadosRazon) * 100 : 0;

            $anomaliasFisicasConteoRazon = [
                'Craneo' => ExploracionFisicaCraneo::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Cuello' => ExploracionFisicaCuello::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Boca' => ExploracionFisicaBoca::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Ojos' => ExploracionFisicaOjos::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Nariz' => ExploracionFisicaNariz::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Oídos' => ExploracionFisicaOidos::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Abdomen' => ExploracionFisicaAbdomen::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Tórax' => ExploracionFisicaTorax::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Piel' => ExploracionFisicaPiel::whereIn('empleados_id', $empleadosPorRazon)->count(),
                'Genitales' => ExploracionFisicaGenitales::whereIn('empleados_id', $empleadosPorRazon)->count(),
            ];
            $totalAnomaliasRazon = array_sum($anomaliasFisicasConteoRazon);
            $promedioAnomaliasPorEmpleadoRazon = ($totalEmpleadosRazon > 0) ? ($totalAnomaliasRazon / $totalEmpleadosRazon) : 0;

            // --- Otros cálculos para la tabla o otras gráficas por razon_social (existentes) ---
            $rangosIMCRazon = [
                'Bajo peso' => 0, 'Normal' => 0, 'Sobrepeso' => 0, 'Obesidad' => 0
            ];
            foreach ($imcDataRazon as $imc) {
                if ($imc < 18.5) $rangosIMCRazon['Bajo peso']++;
                elseif ($imc < 25) $rangosIMCRazon['Normal']++;
                elseif ($imc < 30) $rangosIMCRazon['Sobrepeso']++;
                else $rangosIMCRazon['Obesidad']++;
            }

            $signosRazon = ExploracionDatosFisicos::whereIn('empleados_id', $empleadosPorRazon)
                ->select(
                    DB::raw('AVG(fisico_ta) as ta'),
                    DB::raw('AVG(fisico_fc) as fc'),
                    DB::raw('AVG(fisico_fr) as fr')
                )
                ->first();

            $dataByRazonSocial[$razonSocial] = [
                'totalEmpleados' => $totalEmpleadosRazon,
                'spiderChartData' => [
                    'labels' => $spiderGeneralLabels, // Usar las mismas etiquetas que el general
                    'values' => [
                        round($porcentajeRtRazon, 2),
                        round($porcentajeEcRazon, 2),
                        round($porcentajePatologiaRazon, 2),
                        round($porcentajeImcSobrepesoObesidadRazon, 2),
                        round($promedioAnomaliasPorEmpleadoRazon, 2)
                    ],
                    'maxValues' => $spiderGeneralMaxValues // Usar los mismos valores máximos que el general
                ],
                'distribucionIMC' => $rangosIMCRazon,
                'promedioSignosVitales' => [
                    'TA' => round($signosRazon->ta ?? 0, 2),
                    'FC' => round($signosRazon->fc ?? 0, 2),
                    'FR' => round($signosRazon->fr ?? 0, 2),
                ],
                'anomaliasFisicas' => $anomaliasFisicasConteoRazon,
            ];
        }

        // --- NUEVOS CÁLCULOS: Promedios Globales para Líneas de Tendencia ---
        // Estos cálculos se mantienen para otras gráficas si las tienes
        $promedioIMC = ExploracionDatosFisicos::whereIn('empleados_id', $empleadosFiltradosIds)->avg('fisico_imc');
        $promedioTotalAnomalias = 0;
        foreach ($zonas as $zonaCount) {
            $promedioTotalAnomalias += $zonaCount;
        }
        $promedioTotalAnomalias = count($zonas) > 0 ? $promedioTotalAnomalias / count($zonas) : 0;


        return response()->json([
            'total' => $total,
            'rt' => $rt,
            'ec' => $ec,
            'topHeredo' => $top3Heredo,
            'prevalencia' => $prevalencia,
            'porcentajePatologia' => $porcentajePatologia,
            'distribucionIMC' => $rangosIMC,
            'generoEscolaridad' => [
                'labels' => $labelsGeneroEscolaridad,
                'data' => $dataGeneroEscolaridad
            ],
            'promedioSignosVitales' => $promedioSignos,
            'anomaliasFisicas' => $zonas,
            'dataByRazonSocial' => $dataByRazonSocial, // Contiene datos para gráficos y tablas específicas por propiedad
            'spiderChartGeneral' => [ // Objeto exclusivo para el spider chart general
                'labels' => $spiderGeneralLabels,
                'values' => $spiderGeneralValues,
                'maxValues' => $spiderGeneralMaxValues
            ],
            'trendLines' => [ // Promedios globales para otras líneas de tendencia
                'promedioIMC' => round($promedioIMC ?? 0, 2),
                'promedioAnomalias' => round($promedioTotalAnomalias ?? 0, 2),
            ]
        ]);
    }
    public function mostrarEstadisticos(Request $request)
    {
        // ... (cálculos de los botones - se mantienen igual) ...

        $query = Empleado::query();

        // Filtro por propiedad
        if ($request->has('propiedad') && $request->propiedad != '') {
            $query->where('razon_social', $request->propiedad);
        }

        // Filtro por departamento (asumiendo que tienes una columna 'departamento' en tu tabla Empleado)
        if ($request->has('departamento') && $request->departamento != '') {
            $query->where('departamento', $request->departamento);
        }

        // Filtro por puesto
        if ($request->has('puesto') && $request->puesto != '') {
            $query->where('puesto_aspirante', $request->puesto);
        }

        // Filtro por enfermedad/condición (busca en la tabla Padece_Enfermedad)
        if ($request->has('enfermedad') && $request->enfermedad != '') {
            $query->whereHas('padeceEnfermedades', function ($q) use ($request) {
                $q->where('especifique_enfermedad', 'like', '%' . $request->enfermedad . '%');
            });
        }

        $personas = $query->get();

        return view('estadisticos', [
            'totalRegistros' => $totalRegistros,
            'incapacidadesRiesgoTrabajo' => $incapacidadesRiesgoTrabajo,
            'incapacidadesEnfermedad' => $incapacidadesEnfermedad,
            'prevalenciaEnfermedades' => $prevalenciaEnfermedades,
            'promedioEdad' => $promedioEdad,
            'semaforoColor' => $semaforoColor,
            'porcentajeConPatologia' => $porcentajeConPatologia,
            'personas' => $personas,
            'filtros' => $request->all(), // Pasar los filtros a la vista para mantener la selección
        ]);
    }
    
public function filtrarEmpleados(Request $request)
{
    $hotel = $request->input('hotel');
    $propiedad = $request->input('razon_social');
    $departamento = $request->input('departamento');
    $puesto = $request->input('puesto');
    $nombre = $request->input('nombre');
    $enfermedad = $request->input('enfermedad');

    $enfermedadesFijas = [
        'heredoFamiliares' => ['fimicos', 'luéticos', 'diabéticos', 'cardiópatas', 'epilépticos', 'oncologicos', 'malf_congen', 'atópicos'],
        'personalesPatologicos' => ['renales', 'cardiacos', 'hipertensos', 'lumbalgias', 'traumaticos', 'quirurgicos'],
        'personalesNoPatologicos' => ['tabaquismo', 'alcoholismo', 'toxicomania', 'menarquia', 'ritmo', 'fum', 'disminorrea', 'ivsa', 'fup', 'doc', 'pf', 'g', 'p', 'c', 'a'],
    ];

    // Mapear para fácil búsqueda inversa
    $campoRelacionMap = collect($enfermedadesFijas)->flatMap(function ($campos, $relacion) {
        return collect($campos)->mapWithKeys(function ($campo) use ($relacion) {
            return [ucfirst(str_replace('_', ' ', $campo)) => ['relacion' => $relacion, 'campo' => $campo]];
        });
    });

    $query = Empleado::with([
        'riesgoTrabajo',
        'riesgoEnfermedad',
        'padece_Enfermedad',
        'heredoFamiliares',
        'personalesPatologicos',
        'personalesNoPatologicos'
    ]);

    if ($hotel) {
        $query->where('razon_social', $hotel);
    }

    if ($propiedad) {
        $query->where('razon_social', $propiedad);
    }

    if ($puesto) {
        $query->where('puesto_aspirante', $puesto);
    }

    if ($nombre) {
        $query->where('nombre', $nombre);
    }

    if ($enfermedad) {
        $enfermedadNormalizada = ucfirst(strtolower($enfermedad));

        if ($campoRelacionMap->has($enfermedadNormalizada)) {
            // Enfermedad fija → obtener relación y campo
            $info = $campoRelacionMap[$enfermedadNormalizada];

            $query->whereHas($info['relacion'], function ($q) use ($info) {
                $q->where($info['campo'], 'Sí');
            });
        } else {
            // Enfermedad dinámica → buscar en relaciones de texto libre
            $query->where(function ($q) use ($enfermedad) {
                $q->whereHas('riesgoTrabajo', function ($subq) use ($enfermedad) {
                    $subq->whereRaw("LOWER(riesgo_evaluacion) LIKE ?", ["%{$enfermedad}%"]);
                })->orWhereHas('riesgoEnfermedad', function ($subq) use ($enfermedad) {
                    $subq->whereRaw("LOWER(enfermedad_evaluacion) LIKE ?", ["%{$enfermedad}%"]);
                })->orWhereHas('padece_Enfermedad', function ($subq) use ($enfermedad) {
                    $subq->whereRaw("LOWER(especifique_enfermedad) LIKE ?", ["%{$enfermedad}%"]);
                });
            });
        }
    }

    $empleados = $query->get();

    return response()->json($empleados);
}

    public function getPuestosYDepartamentos($hotel)
    {
        $puestos = [];
        $departamentos = [];
    
        switch ($hotel) {
            case 'princess':
                $puestos = PuestoPrincess::pluck('Puestos')->toArray();
                $departamentos = Departamento::where('hotel', 'princess')->pluck('nombre')->toArray();
                break;
            case 'palacio':
                $puestos = PuestoPalacio::pluck('Puestos')->toArray();
                $departamentos = Departamento::where('hotel', 'palacio')->pluck('nombre')->toArray();
                break;
            case 'pierre':
                $puestos = PuestoPierre::pluck('Puestos')->toArray();
                $departamentos = Departamento::where('hotel', 'pierre')->pluck('nombre')->toArray();
                break;
        }
        return response()->json([
            'Puestos' => $puestos,
            'Departamentos' => $departamentos,
        ]);
    }

    public function obtenerDepartamentos(Request $request)
    {
        $propiedad = $request->input('propiedad');
        $departamentos = Empleado::when($propiedad, function ($query) use ($propiedad) {
            return $query->where('razon_social', $propiedad);
        })->distinct('departamento')->orderBy('departamento')->pluck('departamento')->toArray();

        return response()->json($departamentos);
    }

    public function obtenerPuestos(Request $request)
    {
        $propiedad = $request->input('propiedad');
        $puestos = Empleado::when($propiedad, function ($query) use ($propiedad) {
            return $query->where('razon_social', $propiedad);
        })->distinct('puesto_aspirante')->orderBy('puesto_aspirante')->pluck('puesto_aspirante')->toArray();

        return response()->json($puestos);
    }
 public function mostrarRegistro($id)
{
    $empleado = Empleado::find($id);


    // Verificar si el empleado existe
    if ($empleado) {
        $antecedentes = HistorialLaboral::where('empleados_id', $empleado->id)->first();
        $heredoFamiliares = HeredoFamiliares::where('empleados_id', $empleado->id)->first();
        $personalesPatologicos = PersonalesPatologicos::where('empleados_id', $empleado->id)->first();
        $noPatologicos = PersonalesNoPatologicos::where('empleados_id', $empleado->id)->first();
        $riesgoTrabajo = RiesgoTrabajo::where('empleados_id', $empleado->id)->first();
        $riesgoEnfermedad = RiesgoEnfermedad::where('empleados_id', $empleado->id)->first();
        $padece = Padece_Enfermedad::where('empleados_id', $empleado->id)->first();
        $datosFisicos = ExploracionDatosFisicos::where('empleados_id', $empleado->id)->first();
        $craneo = ExploracionFisicaCraneo::where('empleados_id', $empleado->id)->first();
        $cuello = ExploracionFisicaCuello::where('empleados_id', $empleado->id)->first();
        $boca = ExploracionFisicaBoca::where('empleados_id', $empleado->id)->first();
        $ojos = ExploracionFisicaOjos::where('empleados_id', $empleado->id)->first();
        $nariz = ExploracionFisicaNariz::where('empleados_id', $empleado->id)->first();
        $oidos = ExploracionFisicaOidos::where('empleados_id', $empleado->id)->first();
        $visual = ExploracionFisicaVisual::where('empleados_id', $empleado->id)->first();
        $abdomen = ExploracionFisicaAbdomen::where('empleados_id', $empleado->id)->first();
        $torax = ExploracionFisicaTorax::where('empleados_id', $empleado->id)->first();
        $piel = ExploracionFisicaPiel::where('empleados_id', $empleado->id)->first();
        $genitales = ExploracionFisicaGenitales::where('empleados_id', $empleado->id)->first();
        $miembro = ExploracionFisicaMiembroToracico::where('empleados_id', $empleado->id)->first();
        $pelvicos = ExploracionFisicaMiembroPelvico::where('empleados_id', $empleado->id)->first();
        $cervical = ExploracionFisicaColumnaCervical::where('empleados_id', $empleado->id)->first();
        $dorsal = ExploracionFisicaColumnaDorsal::where('empleados_id', $empleado->id)->first();
        $lumbar = ExploracionFisicaColumnaLumbar::where('empleados_id', $empleado->id)->first();
        $vertebral = ExploracionFisicaColumnaVertebral::where('empleados_id', $empleado->id)->first();
        $auxiliar = AuxiliarDiagnostico::where('empleados_id', $empleado->id)->first();
        $observacion = Observacion::where('empleados_id', $empleado->id)->first();
        return response()->json([
             // Ficha de Identificacion
            'nombre' => $empleado->nombre ?? "Sin Registro",
            'edad' => $empleado->edad ?? "Sin Registro",
            'genero' => $empleado->genero ?? "Sin Registro",
            'estado_civil' => $empleado->estado_civil ?? "Sin Registro",
            'fecha_nacimiento' => $empleado->fecha_nacimiento ?? "Sin Registro",
            'direccion' => $empleado->direccion ?? "Sin Registro",
            'telefono' => $empleado->telefono ?? "Sin Registro",
            'escolaridad' => $empleado->escolaridad ?? "Sin Registro",
            'departamento' => $empleado->departamento ?? "Sin Registro",
            'razon_social' => $empleado->razon_social ?? "Sin Registro",
            // Antecedentes Laborales
            'edad_inicio_labores' => $antecedentes->edad_inicio_labores ?? "Sin Registro",
            'empresas_laborado' => $antecedentes->empresas_laborado ?? "Sin Registro",
            'puestos_ocupados' => $antecedentes->puestos_ocupados ?? "Sin Registro",
            'tiempo_laborado' => $antecedentes->tiempo_laborado ?? "Sin Registro",
            'agentes' => $antecedentes->agentes ?? "Sin Registro",
            'agentes' => $antecedentes->agentes ?? "Sin Registro",
            //Heredo Familiares
            'fimicos' => $heredoFamiliares->fimicos ?? "Sin Registro",
            'luéticos' => $heredoFamiliares->luéticos ?? "Sin Registro",
            'diabéticos' => $heredoFamiliares->diabéticos ?? "Sin Registro",
            'cardiópatas' => $heredoFamiliares->cardiópatas ?? "Sin Registro",
            'epilépticos' => $heredoFamiliares->epilépticos ?? "Sin Registro",
            'oncologicos' => $heredoFamiliares->oncologicos ?? "Sin Registro",
            'malf_congen' => $heredoFamiliares->malf_congen ?? "Sin Registro",
            'atópicos' => $heredoFamiliares->atópicos ?? "Sin Registro",
            'otro' => $heredoFamiliares->otro ?? "Sin Registro",
            // Personales Patológicos
            'fimicos_personales' => $personalesPatologicos->fimicos ?? "Sin Registro",
            'lueticos_personales' => $personalesPatologicos->lueticos ?? "Sin Registro",
            'diabeticos_personales' => $personalesPatologicos->diabeticos ?? "Sin Registro",
            'renales' => $personalesPatologicos->renales ?? "Sin Registro",
            'cardiacos' => $personalesPatologicos->cardiacos ?? "Sin Registro",
            'hipertensos' => $personalesPatologicos->hipertensos ?? "Sin Registro",
            'atopicos_personales' => $personalesPatologicos->atopicos ?? "Sin Registro",
            'lumbalgias' => $personalesPatologicos->lumbalgias ?? "Sin Registro",
            'traumaticos' => $personalesPatologicos->traumaticos ?? "Sin Registro",
            'oncologicos_personales' => $personalesPatologicos->oncologicos ?? "Sin Registro",
            'epilepticos_personales' => $personalesPatologicos->epilepticos ?? "Sin Registro",
            'quirurgicos' => $personalesPatologicos->quirurgicos ?? "Sin Registro",
            'otro_personales' => $personalesPatologicos->otro ?? "Sin Registro",
            // Antecedentes Personales No Patológicos
            'no_patologicos_tabaquismo' => $noPatologicos->no_patologicos_tabaquismo ?? "Sin Registro",
            'no_patologicos_tabaquismo_especifica' => $noPatologicos->no_patologicos_tabaquismo_especifica ?? "Sin Registro",
            'no_patologicos_alcoholismo' => $noPatologicos->no_patologicos_alcoholismo ?? "Sin Registro",
            'no_patologicos_alcoholismo_especifica' => $noPatologicos->no_patologicos_alcoholismo_especifica ?? "Sin Registro",
            'no_patologicos_toxicomania' => $noPatologicos->no_patologicos_toxicomania ?? "Sin Registro",
            'no_patologicos_toxicomania_especifica' => $noPatologicos->no_patologicos_toxicomania_especifica ?? "Sin Registro",
            'no_patologicos_menarquia' => $noPatologicos->no_patologicos_menarquia ?? "Sin Registro",
            'no_patologicos_ritmo' => $noPatologicos->no_patologicos_ritmo ?? "Sin Registro",
            'no_patologicos_fum' => $noPatologicos->no_patologicos_fum ?? "Sin Registro",
            'no_patologicos_disminorrea' => $noPatologicos->no_patologicos_disminorrea ?? "Sin Registro",
            'no_patologicos_ivsa' => $noPatologicos->no_patologicos_ivsa ?? "Sin Registro",
            'no_patologicos_fup' => $noPatologicos->no_patologicos_fup ?? "Sin Registro",
            // Riesgo de Trabajo
            'riesgo_trabajo' => $riesgoTrabajo?->riesgo ?? "Sin Registro",
            'riesgo_evaluacion' => $riesgoTrabajo?->riesgo_evaluacion ?? "Sin Registro",
            // Riesgo de Enfermedad
            'riesgo_enfermedad' => $riesgoEnfermedad?->enfermedad ?? "Sin Registro",
            'enfermedad_evaluacion' => $riesgoEnfermedad?->enfermedad_evaluacion ?? "Sin Registro",
            // Padece Enfermedad
            'padece_enfermedad' => $padece->padece_enfermedad ?? "Sin Registro",
            'especifique_enfermedad' => $padece->especifique_enfermedad ?? "Sin Registro",
            'mano_dominante' => $padece->mano_dominante ?? "Sin Registro",
            'firma' => $padece->firma ?? "",
            // EXPLORACIÓN FÍSICA (DATOS FÍSICOS)
            'fisico_peso' => $datosFisicos->fisico_peso ?? "Sin Registro",
            'fisico_talla' => $datosFisicos->fisico_talla ?? "Sin Registro",
            'fisico_ta' => $datosFisicos->fisico_ta ?? "Sin Registro",
            'fisico_fc' => $datosFisicos->fisico_fc ?? "Sin Registro",
            'fisico_fr' => $datosFisicos->fisico_fr ?? "Sin Registro",
            'fisico_imc' => $datosFisicos->fisico_imc ?? "Sin Registro",
            // EXPLORACIÓN FÍSICA CRÁNEO
            'craneo_forma' => $craneo->forma ?? "Sin Registro",
            'craneo_tamano' => $craneo->tamaño ?? "Sin Registro",
            'craneo_pelo' => $craneo->pelo ?? "Sin Registro",
            'craneo_cara' => $craneo->cara ?? "Sin Registro",
            // CUELLO
            'cuello_ganglios' => $cuello->ganglios ?? "Sin Registro",
            'cuello_movilidad' => $cuello->movilidad ?? "Sin Registro",
            'cuello_tiroides' => $cuello->tiroides ?? "Sin Registro",
            'cuello_pulsos' => $cuello->pulsos ?? "Sin Registro",
            // BOCA
            'boca_mucosas' => $boca->mucosas ?? "Sin Registro",
            'boca_dentadura' => $boca->dentadura ?? "Sin Registro",
            'boca_lengua' => $boca->lengua ?? "Sin Registro",
            'boca_encias' => $boca->encias ?? "Sin Registro",
            'boca_faringe' => $boca->faringe ?? "Sin Registro",
            'boca_amigdalas' => $boca->amigdalas ?? "Sin Registro",
            // OJOS
            'ojos_conjuntivas' => $ojos->conjuntivas ?? "Sin Registro",
            'ojos_pupilas' => $ojos->pupilas ?? "Sin Registro",
            'ojos_parpados' => $ojos->parpados ?? "Sin Registro",
            'ojos_reflejos' => $ojos->reflejos ?? "Sin Registro",
            // NARIZ
            'nariz_tabique' => $nariz->tabique ?? "Sin Registro",
            'nariz_mucosas' => $nariz->mucosas ?? "Sin Registro",
            // OIDOS
            'oido_pabellon' => $oidos->pabellon ?? "Sin Registro",
            'oido_cae' => $oidos->cae ?? "Sin Registro",
            'oido_timpanos' => $oidos->timpanos ?? "Sin Registro",
            // AGUDEZA VISUAL
            'visual_sl' => $visual->SL ?? "Sin Registro",
            'visual_cl' => $visual->CL ?? "Sin Registro",
            // ABDOMEN
            'abdomen_megalias' => $abdomen->megalias ?? "Sin Registro",
            'abdomen_hernias' => $abdomen->hernias ?? "Sin Registro",
            // TORAX
            'torax_forma' => $torax->forma ?? "Sin Registro",     
            'torax_ritmos' => $torax->ritmos_Cardiacos ?? "Sin Registro",
            'torax_campos' => $torax->campos_pulm ?? "Sin Registro",
            'torax_mamas' => $torax->mamas ?? "Sin Registro",
            // PIEL
            'piel_nevos' => $piel->nevos ?? "Sin Registro",
            'piel_cicatrices' => $piel->cicatrices ?? "Sin Registro",
            'piel_varices' => $piel->varices ?? "Sin Registro",
            'piel_edemas' => $piel->edemas ?? "Sin Registro",
            'piel_micosis' => $piel->micosis ?? "Sin Registro",
            // GENITALES
            'genitales_fimosis' => $genitales->fimosis ?? "Sin Registro",
            'genitales_varicocele' => $genitales->varicocele ?? "Sin Registro",
            'genitales_hernias' => $genitales->hernias ?? "Sin Registro",
            'genitales_criptorquidias' => $genitales->criptorquidias ?? "Sin Registro",
            // MIEMBROS TORÁCICOS
            'miembro_integridad' => $miembro->integridad ?? "Sin Registro",
            'miembro_integridad_obs' => $miembro->integridad_observacion ?? "Sin Registro",
            'miembro_forma' => $miembro->forma ?? "Sin Registro",
            'miembro_forma_obs' => $miembro->forma_observacion ?? "Sin Registro",
            'miembro_articulaciones' => $miembro->articulaciones ?? "Sin Registro",
            'miembro_articulaciones_obs' => $miembro->articulaciones_observacion ?? "Sin Registro",
            'miembro_tono' => $miembro->tono_muscular ?? "Sin Registro",
            'miembro_tono_obs' => $miembro->tono_muscular_observacion ?? "Sin Registro",
            'miembro_reflejos' => $miembro->reflejos ?? "Sin Registro",
            'miembro_reflejos_obs' => $miembro->reflejos_observacion ?? "Sin Registro",
            'miembro_sensibilidad' => $miembro->sensibilidad ?? "Sin Registro",
            'miembro_sensibilidad_obs' => $miembro->sensibilidad_observacion ?? "Sin Registro",
            // Exploración Miembros Pélvicos
            'integridad' => $pelvicos->integridad ?? "Sin Registro",
            'integridadObs' => $pelvicos->integridad_observacion ?? "Sin Registro",
            'forma' => $pelvicos->forma ?? "Sin Registro",
            'formaObs' => $pelvicos->forma_observacion ?? "Sin Registro",
            'articulaciones' => $pelvicos->articulaciones ?? "Sin Registro",
            'articulacionesObs' => $pelvicos->articulaciones_observacion ?? "Sin Registro",
            'tonoMuscular' => $pelvicos->tono_muscular ?? "Sin Registro",
            'tonoMuscularObs' => $pelvicos->tono_muscular_observacion ?? "Sin Registro",
            'reflejos' => $pelvicos->reflejos ?? "Sin Registro",
            'reflejosObs' => $pelvicos->reflejos_observacion ?? "Sin Registro",
            // Exploración Columna Cervical
            'cervical_integridad' => $cervical->integridad ?? "Sin Registro",
            'cervical_integridad_observacion' => $cervical->integridad_observacion ?? "Sin Registro",
            'cervical_forma' => $cervical->forma ?? "Sin Registro",
            'cervical_forma_observacion' => $cervical->forma_observacion ?? "Sin Registro",
            'cervical_movimientos' => $cervical->movimientos ?? "Sin Registro",
            'cervical_movimientos_observacion' => $cervical->movimientos_observacion ?? "Sin Registro",
            'cervical_fuerza' => $cervical->fuerza ?? "Sin Registro",
            'cervical_fuerza_observacion' => $cervical->fuerza_observacion ?? "Sin Registro",
            // Exploración Columna Dorsal
            'dorsal_integridad' => $dorsal->integridad ?? "Sin Registro",
            'dorsal_integridad_observacion' => $dorsal->integridad_observacion ?? "Sin Registro",
            'dorsal_forma' => $dorsal->forma ?? "Sin Registro",
            'dorsal_forma_observacion' => $dorsal->forma_observacion ?? "Sin Registro",
            'dorsal_movimientos' => $dorsal->movimientos ?? "Sin Registro",
            'dorsal_movimientos_observacion' => $dorsal->movimientos_observacion ?? "Sin Registro",
            'dorsal_fuerza' => $dorsal->fuerza ?? "Sin Registro",
            'dorsal_fuerza_observacion' => $dorsal->fuerza_observacion ?? "Sin Registro",
            // Exploración Columna Lumbar
            'lumbar_integridad' => $lumbar->integridad ?? "Sin Registro",
            'lumbar_integridad_observacion' => $lumbar->integridad_observacion ?? "Sin Registro",
            'lumbar_forma' => $lumbar->forma ?? "Sin Registro",
            'lumbar_forma_observacion' => $lumbar->forma_observacion ?? "Sin Registro",
            'lumbar_movimientos' => $lumbar->movimientos ?? "Sin Registro",
            'lumbar_movimientos_observacion' => $lumbar->movimientos_observacion ?? "Sin Registro",
            'lumbar_fuerza' => $lumbar->fuerza ?? "Sin Registro",
            'lumbar_fuerza_observacion' => $lumbar->fuerza_observacion ?? "Sin Registro",
            // Exploración Columna Vertebral
            'vertebral_escoleosis' => $vertebral->escoleosis ?? "Sin Registro",
            'vertebral_evaluacion_escoleosis' => $vertebral->evaluacion_escoleosis ?? "Sin Registro",
            'vertebral_cifosis' => $vertebral->cifosis ?? "Sin Registro",
            'vertebral_evaluacion_cifosis' => $vertebral->evaluacion_cifosis ?? "Sin Registro",
            'vertebral_lordosis' => $vertebral->lordosis ?? "Sin Registro",
            'vertebral_evaluacion_lordosis' => $vertebral->evaluacion_lordosis ?? "Sin Registro",
            // Auxiliares de Diagnóstico
            'radiografias' => $auxiliar?->radiografias ?? "Sin Registro",
            'torax' => $auxiliar?->torax ?? "Sin Registro",
            'col_lumbar' => $auxiliar?->col_lumbar ?? "Sin Registro",
            'laboratorio' => $auxiliar?->laboratorio ?? "Sin Registro",
            'audiometria' => $auxiliar?->audiometria ?? "Sin Registro",
            'otros' => $auxiliar?->otros ?? "Sin Registro",
            // Observaciones
            'diagnosticos' => $observacion?->diagnosticos ?? "Sin Registro",
            'recomendaciones' => $observacion?->recomendaciones ?? "Sin Registro",
            'evaluacion_satisfactoria' => $observacion?->evaluacion_satisfactori ?? "Sin Registro",
            'fecha_formulario' => $observacion?->fecha_formulario ?? "Sin Registro",
            'firma_formulario' => $observacion?->firma_formulario ?? "Sin Registro",
            
        ]);
    } else {

    }
}
public function formEdit($id) {
    $empleado = Empleado::find($id);
        $antecedentes = HistorialLaboral::where('empleados_id', $empleado->id)->first();
        $heredoFamiliares = HeredoFamiliares::where('empleados_id', $empleado->id)->first();
        $personalesPatologicos = PersonalesPatologicos::where('empleados_id', $empleado->id)->first();
        $noPatologicos = PersonalesNoPatologicos::where('empleados_id', $empleado->id)->first();
        $riesgoTrabajo = RiesgoTrabajo::where('empleados_id', $empleado->id)->first();
        $riesgoEnfermedad = RiesgoEnfermedad::where('empleados_id', $empleado->id)->first();
        $padece = Padece_Enfermedad::where('empleados_id', $empleado->id)->first();
        $datosFisicos = ExploracionDatosFisicos::where('empleados_id', $empleado->id)->first();
        $craneo = ExploracionFisicaCraneo::where('empleados_id', $empleado->id)->first();
        $cuello = ExploracionFisicaCuello::where('empleados_id', $empleado->id)->first();
        $boca = ExploracionFisicaBoca::where('empleados_id', $empleado->id)->first();
        $ojos = ExploracionFisicaOjos::where('empleados_id', $empleado->id)->first();
        $nariz = ExploracionFisicaNariz::where('empleados_id', $empleado->id)->first();
        $oidos = ExploracionFisicaOidos::where('empleados_id', $empleado->id)->first();
        $visual = ExploracionFisicaVisual::where('empleados_id', $empleado->id)->first();
        $abdomen = ExploracionFisicaAbdomen::where('empleados_id', $empleado->id)->first();
        $torax = ExploracionFisicaTorax::where('empleados_id', $empleado->id)->first();
        $piel = ExploracionFisicaPiel::where('empleados_id', $empleado->id)->first();
        $genitales = ExploracionFisicaGenitales::where('empleados_id', $empleado->id)->first();
        $miembro = ExploracionFisicaMiembroToracico::where('empleados_id', $empleado->id)->first();
        $pelvicos = ExploracionFisicaMiembroPelvico::where('empleados_id', $empleado->id)->first();
        $cervical = ExploracionFisicaColumnaCervical::where('empleados_id', $empleado->id)->first();
        $dorsal = ExploracionFisicaColumnaDorsal::where('empleados_id', $empleado->id)->first();
        $lumbar = ExploracionFisicaColumnaLumbar::where('empleados_id', $empleado->id)->first();
        $vertebral = ExploracionFisicaColumnaVertebral::where('empleados_id', $empleado->id)->first();
        $auxiliar = AuxiliarDiagnostico::where('empleados_id', $empleado->id)->first();
        $observacion = Observacion::where('empleados_id', $empleado->id)->first();
    return view('modules.historialclinico.informe.formEdit', compact('empleado', 'antecedentes',
    'heredoFamiliares','personalesPatologicos','noPatologicos','riesgoTrabajo','riesgoEnfermedad', 
    'padece','datosFisicos','craneo','cuello','boca','ojos','nariz','oidos','visual','abdomen',
    'torax','piel','genitales','miembro','pelvicos','cervical','dorsal','lumbar','vertebral',
    'auxiliar','observacion'));
}

public function update(Request $request, $id)
{
    $empleado = Empleado::findOrFail($id);
        $empleado->update([
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

    $antecedentes = HistorialLaboral::where('empleados_id', $empleado->id)->first();
        $antecedentes->update([
            'edad_inicio_labores' => $request->input('edad-inicio-labores'),
            'empresas_laborado' => $request->input('empresa'),
            'puestos_ocupados' => $request->input('puesto'),
            'tiempo_laborado' => $request->input('tiempo'),
            'agentes' => $request->input('agentes'),
        ]);
    $heredoFamiliares = HeredoFamiliares::where('empleados_id', $empleado->id)->first();
        $heredoFamiliares->update([
            'fimicos' => $request->input('fimicos-heredofamiliares'),
            'luéticos' => $request->input('lueticos-heredofamiliare'),
            'diabéticos' => $request->input('diabeticos-heredofamiliares'),
            'cardiópatas' => $request->input('cardiopatas-heredofamiliares'),
            'epilépticos' => $request->input('epilepticos-heredofamiliares'),
            'oncologicos' => $request->input('oncologicos-heredofamiliares'),
            'malf_congen' => $request->input('malformaciones-heredofamiliares'),
            'atópicos' => $request->input('atopicos-heredofamiliares'),
            'otro' => $request->input('otro-heredofamiliares'),
        ]);
    $personalesPatologicos = PersonalesPatologicos::where('empleados_id', $empleado->id)->first();
        $personalesPatologicos->update([
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

    $noPatologicos = PersonalesNoPatologicos::where('empleados_id', $empleado->id)->first();
        $noPatologicos->update([
            'no_patologicos_tabaquismo' => $request->input('tabaquismo'),
            'no_patologicos_tabaquismo_especifica' => $request->input('especifica_tabaquismo'),
            'no_patologicos_alcoholismo' => $request->input('alcoholismo'),
            'no_patologicos_alcoholismo_especifica' => $request->input('especifica_alcoholismo'),
            'no_patologicos_toxicomania' => $request->input('toxicomanias'),
            'no_patologicos_toxicomania_especifica' => $request->input('especifica_toxicomanias'),
            'no_patologicos_menarquia' => $request->input('menarquia'),
            'no_patologicos_ritmo' => $request->input('ritmo'),
            'no_patologicos_fum' => $request->input('fum'),
            'no_patologicos_disminorrea' => $request->input('disminorrea'),
            'no_patologicos_ivsa' => $request->input('ivsa'),
            'no_patologicos_fup' => $request->input('fup'),
            'no_patologicos_doc' => $request->input('doc'),
            'no_patologicos_pf' => $request->input('pf'),
            'no_patologicos_g' => $request->input('g'),
            'no_patologicos_p' => $request->input('p'),
            'no_patologicos_c' => $request->input('c'),
            'no_patologicos_a' => $request->input('a'),
        ]);
    $riesgoTrabajo = RiesgoTrabajo::where('empleados_id', $empleado->id)->first();
        $riesgoTrabajo->update([
            'riesgo' => $request->input('riesgo-trabajo'),
            'riesgo_evaluacion' => $request->input('especifica-riesgo-trabajo'),
        ]);
    $riesgoEnfermedad = RiesgoEnfermedad::where('empleados_id', $empleado->id)->first();
        $riesgoEnfermedad->update([
            'enfermedad' => $request->input('riesgo-enfermedad'),
            'enfermedad_evaluacion' => $request->input('especifica-riesgo-enfermedad'),
        ]);
    $padece = Padece_Enfermedad::where('empleados_id', $empleado->id)->first();
        $padece->update([
            'padece_enfermedad' => $request->input('padece-enfermedad'),
            'especifique_enfermedad' => $request->input('especifica-padece-enfermedad'),
            'mano_dominante' => $request->input('mano-dominante'),
        ]);
    $datosFisicos = ExploracionDatosFisicos::where('empleados_id', $empleado->id)->first();
        $datosFisicos->update([
            'fisico_peso' => $request->input('exploracion-fisica-peso'),
            'fisico_talla' => $request->input('exploracion-fisica-talla'),
            'fisico_ta' => $request->input('exploracion-fisica-t/a'),
            'fisico_fc' => $request->input('exploracion-fisica-fc'),
            'fisico_fr' => $request->input('exploracion-fisica-fre'),
            'fisico_imc' => $request->input('exploracion-fisica-imc'),
        ]);    
    $craneo = ExploracionFisicaCraneo::where('empleados_id', $empleado->id)->first();
        $craneo->update([
            'forma' => $request->input('craneo-forma'),
            'tamaño' => $request->input('craneo-tamano'),
            'pelo' => $request->input('craneo-pelo'),
            'cara' => $request->input('craneo-Cara'),
        ]);    
    $cuello = ExploracionFisicaCuello::where('empleados_id', $empleado->id)->first();
        $cuello->update([
            'ganglios' => $request->input('cuello-ganglios'),
            'movilidad' => $request->input('cuello-movilidad'),
            'tiroides' => $request->input('cuello-tiroides'),
            'pulsos' => $request->input('cuello-Pulsos'),
        ]);  
    $boca = ExploracionFisicaBoca::where('empleados_id', $empleado->id)->first();
        $boca->update([
            'mucosas' => $request->input('boca-mucosas'),
            'dentadura' => $request->input('boca-dentadura'),
            'lengua' => $request->input('boca-Lengua'),
            'encias' => $request->input('boca-Encias'),
            'faringe' => $request->input('boca-faringe'),
            'amigdalas' => $request->input('boca-amigdalas'),
        ]);    
    $ojos = ExploracionFisicaOjos::where('empleados_id', $empleado->id)->first();
        $ojos->update([
            'conjuntivas' => $request->input('ojos-Conjuntivas'),
            'pupilas' => $request->input('ojos-Pupilas'),
            'parpados' => $request->input('ojos-Parpados'),
            'reflejos' => $request->input('ojos-Reflejos'),
        ]);    
    $nariz = ExploracionFisicaNariz::where('empleados_id', $empleado->id)->first();
        $nariz->update([
            'tabique' => $request->input('nariz-Tabique'),
            'mucosas' => $request->input('nariz-Mucosas'),
        ]);    
    $oidos = ExploracionFisicaOidos::where('empleados_id', $empleado->id)->first();
        $oidos->update([
            'pabellon' => $request->input('oido-Pabellon'),
            'cae' => $request->input('oido-cae'),
            'timpanos' => $request->input('oido-timpanos'),
        ]);   
    $visual = ExploracionFisicaVisual::where('empleados_id', $empleado->id)->first();
        $visual->update([
            'SL' => $request->input('agudeza-visual-sl'),
            'CL' => $request->input('agudeza-visual-cl'),
        ]);    
    $abdomen = ExploracionFisicaAbdomen::where('empleados_id', $empleado->id)->first();
        $abdomen->update([
            'megalias' => $request->input('abdomen-Megalias'),
            'hernias' => $request->input('abdomen-Hernias'),
        ]);    
    $torax = ExploracionFisicaTorax::where('empleados_id', $empleado->id)->first();
        $torax->update([
            'forma' => $request->input('torax-forma'),
            'ritmos_Cardiacos' => $request->input('torax-rCardiacos'),
            'campos_pulm' => $request->input('torax-cPulm'),
            'mamas' => $request->input('torax-Mamas'),
        ]);    
    $piel = ExploracionFisicaPiel::where('empleados_id', $empleado->id)->first();
        $piel->update([
            'nevos' => $request->input('piel-nevos'),
            'cicatrices' => $request->input('piel-Cicatrices'),
            'varices' => $request->input('piel-Varices'),
            'edemas' => $request->input('piel-Edemas'),
            'micosis' => $request->input('piel-Micosis'),
        ]);    
    $genitales = ExploracionFisicaGenitales::where('empleados_id', $empleado->id)->first();
        $genitales->update([
            'fimosis' => $request->input('genitales-fimosis'),
            'varicocele' => $request->input('genitales-Varicocele'),
            'hernias' => $request->input('genitales-Hernias'),
            'criptorquidias' => $request->input('genitales-Criptorquidias'),
        ]);    
    $miembro = ExploracionFisicaMiembroToracico::where('empleados_id', $empleado->id)->first();
        $miembro->update([
            'integridad' => $request->input('miembros-toraxicos-Integridad'),
            'integridad_observacion' => $request->input('especifica-miembro-integridad'),
            'forma' => $request->input('miembros-toraxicos-forma'),
            'forma_observacion' => $request->input('especifica-miembro-forma'),
            'articulaciones' => $request->input('miembros-toraxicos-Articulaciones'),
            'articulaciones_observacion' => $request->input('especifica-miembro-articulaciones'),
            'tono_muscular' => $request->input('miembros-toraxicos-tonoMusculars'),
            'tono_muscular_observacion' => $request->input('especifica-miembro-tonoMuscular'),
            'reflejos' => $request->input('miembros-toraxicos-Reflejos'),
            'reflejos_observacion' => $request->input('especifica-miembro-Reflejos'),
            'sensibilidad' => $request->input('miembros-toraxicos-Sensibilidad'),
            'sensibilidad_observacion' => $request->input('especifica-miembro-Sensibilidad'),
        ]); 
    $pelvicos = ExploracionFisicaMiembroPelvico::where('empleados_id', $empleado->id)->first();
        $pelvicos->update([
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
    $cervical = ExploracionFisicaColumnaCervical::where('empleados_id', $empleado->id)->first();
        $cervical->update([
            'integridad' => $request->input('columna-cervical-integridad'),
            'integridad_observacion' => $request->input('Columna-vertebral-integridad'),
            'forma' => $request->input('columna-cervical-Forma'),
            'forma_observacion' => $request->input('Columna-vertebral-Forma'),
            'movimientos' => $request->input('columna-cervical-Movimientos'),
            'movimientos_observacion' => $request->input('Columna-vertebral-Movimientos'),
            'fuerza' => $request->input('columna-cervical-Fuerza'),
            'fuerza_observacion' => $request->input('Columna-vertebral-Fuerza'),
        ]);    
    $dorsal = ExploracionFisicaColumnaDorsal::where('empleados_id', $empleado->id)->first();
        $dorsal->update([
            'integridad' => $request->input('columna-dorsal-integridad'),
            'integridad_observacion' => $request->input('Columna-vertebral-integridad'),
            'forma' => $request->input('columna-dorsal-Forma'),
            'forma_observacion' => $request->input('Columna-vertebral-Forma'),
            'movimientos' => $request->input('columna-dorsal-Movimientos'),
            'movimientos_observacion' => $request->input('Columna-vertebral-Movimientos'),
            'fuerza' => $request->input('columna-dorsal-Fuerza'),
            'fuerza_observacion' => $request->input('Columna-vertebral-Fuerza'),
        ]);  

    $lumbar = ExploracionFisicaColumnaLumbar::where('empleados_id', $empleado->id)->first();
        $lumbar->update([
            'integridad' => $request->input('columna-lumbar-integridad'),
            'integridad_observacion' => $request->input('Columna-vertebral-integridad'),
            'forma' => $request->input('columna-lumbar-Forma'),
            'forma_observacion' => $request->input('Columna-vertebral-Forma'),
            'movimientos' => $request->input('columna-lumbar-Movimientos'),
            'movimientos_observacion' => $request->input('Columna-vertebral-Movimientos'),
            'fuerza' => $request->input('columna-lumbar-Fuerza'),
            'firfuerza_observacionma' => $request->input('Columna-vertebral-Fuerza'),
        ]);    
    $vertebral = ExploracionFisicaColumnaVertebral::where('empleados_id', $empleado->id)->first();
        $vertebral->update([
            'escoleosis' => $request->input('columna-cervical-Escoleosis'),
            'evaluacion_escoleosis' => $request->input('Columna-vertebral-Escoleosis'),
            'cifosis' => $request->input('columna-cervical-Cifosis'),
            'evaluacion_cifosis' => $request->input('Columna-vertebral-Cifosis'),
            'lordosis' => $request->input('columna-cervical-Lordosis'),
            'evaluacion_lordosis' => $request->input('Columna-vertebral-Lordosis'),
        ]);    
    $auxiliar = AuxiliarDiagnostico::where('empleados_id', $empleado->id)->first();
        $auxiliar->update([
            'radiografias' => $request->input('radiografias-aux'),
            'torax' => $request->input('torax-aux'),
            'col_lumbar' => $request->input('col-lumbar-aux'),
            'laboratorio' => $request->input('laboratorio-aux'),
            'audiometria' => $request->input('audiometria-aux'),
            'otros' => $request->input('otros-aux'),
        ]);

    $observacion = Observacion::where('empleados_id', $empleado->id)->first();        
        $observacion->update([
            'diagnosticos' => $request->input('conclusiones_diagnostico'),
            'recomendaciones' => $request->input('conclusiones_recomendaciones'),
            'evaluacion_satisfactoria' => $request->input('conclusiones_satisfactorias'),
            'fecha_formulario' => $request->input('fecha-formulario'),
            'salud_ocupacional' => $request->input('salud-ocupacional'),
        ]);   

     return redirect()->back()->with('success', 'Formulario enviado correctamente.');
}   
public function descargarReporte(Request $request)
{
    $query = Empleado::query();

    if ($request->has('hotel') && $request->hotel !== '') {
        $query->where('razon_social', $request->hotel);
    }
    if ($request->has('departamento') && $request->departamento !== '') {
        $query->where('departamento', $request->departamento);
    }
    if ($request->has('puesto') && $request->puesto !== '') {
        $query->where('puesto_aspirante', $request->puesto);
    }

    $personas = $query->get();

    $pdf = Pdf::loadView('modules.historialclinico.informe.reportContentPDF', compact('personas'));
    return $pdf->download('reporte_empleados.pdf');
}
    public function descargarGrafica(Request $request)
    {
        // Inicializa la consulta del modelo Empleado
        $query = Empleado::query();

        // Aplica filtros de Propiedad (razon_social), Departamento y Puesto (puesto_aspirante)
        // Los nombres de los parámetros en $request coinciden con los del JavaScript
        if ($request->has('hotel') && $request->hotel !== '') {
            $query->where('razon_social', $request->hotel);
        }
        if ($request->has('departamento') && $request->departamento !== '') {
            $query->where('departamento', $request->departamento);
        }
        if ($request->has('puesto') && $request->puesto !== '') {
            $query->where('puesto_aspirante', $request->puesto);
        }

        // --- Lógica para el filtro de 'enfermedad' ---
        if ($request->has('enfermedad') && $request->enfermedad !== '') {
            $enfermedadFiltro = $request->enfermedad;
            // Normalizar el nombre de la enfermedad del input para que coincida con los nombres de columna en la DB
            // Por ejemplo, "Malf congen" -> "malf_congen", "Fimicos" -> "fimicos"
            $enfermedadFiltroSnake = Str::snake($enfermedadFiltro);

            // Se usa un closure para agrupar las condiciones OR, asegurando que el filtro
            // de enfermedad no interfiera con los filtros AND anteriores (propiedad, depto, puesto).
            $query->where(function ($q) use ($enfermedadFiltro, $enfermedadFiltroSnake) {
                // Define los campos relevantes en cada modelo.
                // ¡IMPORTANTE!: Estos arrays deben contener los nombres EXACTOS de las columnas en tus tablas de DB.
                $heredoFields = ['fimicos', 'lueticos', 'diabeticos', 'cardiopatas', 'epilepticos', 'oncologicos', 'malf_congen', 'atopicos', 'otro'];
                $patologicoFields = ['fimicos', 'lueticos', 'diabeticos', 'renales', 'cardiacos', 'hipertensos', 'atopicos', 'lumbalgias', 'traumaticos', 'oncologicos', 'epilepticos', 'quirurgicos', 'otro'];
                $noPatologicoFields = ['tabaquismo', 'alcoholismo', 'toxicomania', 'menarquia', 'ritmo', 'fum', 'disminorrea', 'ivsa', 'fup', 'doc', 'pf', 'g', 'p', 'c', 'a'];


                // 1. Buscar en HeredoFamiliares (campos booleanos/flags)
                // Si la enfermedad filtrada es uno de los campos de HeredoFamiliares
                if (in_array($enfermedadFiltroSnake, $heredoFields)) {
                    $q->orWhereHas('heredoFamiliares', function ($subQuery) use ($enfermedadFiltroSnake) {
                        // Asume que la columna es booleana y 'true' (o 1) significa que la padece
                        $subQuery->where($enfermedadFiltroSnake, true);
                    });
                }

                // 2. Buscar en PersonalesPatologicos (campos booleanos/flags)
                // Si la enfermedad filtrada es uno de los campos de PersonalesPatologicos
                if (in_array($enfermedadFiltroSnake, $patologicoFields)) {
                    $q->orWhereHas('personalesPatologicos', function ($subQuery) use ($enfermedadFiltroSnake) {
                        // Asume que la columna es booleana y 'true' (o 1) significa que la padece
                        $subQuery->where($enfermedadFiltroSnake, true);
                    });
                }

                // 3. Buscar en Padece_Enfermedad (campo de texto 'especifique_enfermedad')
                // Esto es para enfermedades que se especifican libremente en el campo 'especifique_enfermedad'.
                // Usamos 'like' para buscar coincidencias parciales, y el nombre original de la enfermedad.
                $q->orWhereHas('padeceEnfermedad', function ($subQuery) use ($enfermedadFiltro) {
                    $subQuery->where('especifique_enfermedad', 'like', '%' . $enfermedadFiltro . '%');
                });

                // 4. Buscar en PersonalesNoPatologicos (campos booleanos/flags, ej. 'Si'/'No')
                // Si la enfermedad filtrada es uno de los campos de PersonalesNoPatologicos
                if (in_array($enfermedadFiltroSnake, $noPatologicoFields)) {
                    $q->orWhereHas('noPatologicos', function ($subQuery) use ($enfermedadFiltroSnake) {
                        // Asume que la columna es de texto y 'Si' indica que la padece
                        $subQuery->where($enfermedadFiltroSnake, 'Si');
                    });
                }
                // Si tienes otras tablas donde se registran enfermedades, añade más `orWhereHas` aquí
            });
        }
        // --- Fin de la lógica del filtro de 'enfermedad' ---

        // Ejecuta la consulta para obtener las personas (empleados) filtradas
        $personas = $query->get();

        // Carga la vista Blade 'reportContentPDF' con las personas filtradas
        $pdf = PDF::loadView('modules.historialclinico.informe.graficaPDF', compact('personas'));

        // Devuelve el PDF para su descarga con el nombre 'reporte_empleados.pdf'
        return $pdf->download('reporte_empleados.pdf');
    }
public function descargarPDF($id) {
    $empleado = Empleado::findOrFail($id);
    $antecedentes = HistorialLaboral::where('empleados_id', $empleado->id)->first();
    $heredoFamiliares = HeredoFamiliares::where('empleados_id', $empleado->id)->first();
    $personalesPatologicos = PersonalesPatologicos::where('empleados_id', $empleado->id)->first();
    $noPatologicos = PersonalesNoPatologicos::where('empleados_id', $empleado->id)->first();
    $riesgoTrabajo = RiesgoTrabajo::where('empleados_id', $empleado->id)->first();
    $riesgoEnfermedad = RiesgoEnfermedad::where('empleados_id', $empleado->id)->first();
    $padece = Padece_Enfermedad::where('empleados_id', $empleado->id)->first();
    $datosFisicos = ExploracionDatosFisicos::where('empleados_id', $empleado->id)->first();
    $craneo = ExploracionFisicaCraneo::where('empleados_id', $empleado->id)->first();
    $cuello = ExploracionFisicaCuello::where('empleados_id', $empleado->id)->first();
    $boca = ExploracionFisicaBoca::where('empleados_id', $empleado->id)->first();
    $ojos = ExploracionFisicaOjos::where('empleados_id', $empleado->id)->first();
    $nariz = ExploracionFisicaNariz::where('empleados_id', $empleado->id)->first();
    $oidos = ExploracionFisicaOidos::where('empleados_id', $empleado->id)->first();
    $visual = ExploracionFisicaVisual::where('empleados_id', $empleado->id)->first();
    $abdomen = ExploracionFisicaAbdomen::where('empleados_id', $empleado->id)->first();
    $torax = ExploracionFisicaTorax::where('empleados_id', $empleado->id)->first();
    $piel = ExploracionFisicaPiel::where('empleados_id', $empleado->id)->first();
    $genitales = ExploracionFisicaGenitales::where('empleados_id', $empleado->id)->first();
    $miembro = ExploracionFisicaMiembroToracico::where('empleados_id', $empleado->id)->first();
    $pelvicos = ExploracionFisicaMiembroPelvico::where('empleados_id', $empleado->id)->first();
    $cervical = ExploracionFisicaColumnaCervical::where('empleados_id', $empleado->id)->first();
    $dorsal = ExploracionFisicaColumnaDorsal::where('empleados_id', $empleado->id)->first();
    $lumbar = ExploracionFisicaColumnaLumbar::where('empleados_id', $empleado->id)->first();
    $vertebral = ExploracionFisicaColumnaVertebral::where('empleados_id', $empleado->id)->first();
    $auxiliar = AuxiliarDiagnostico::where('empleados_id', $empleado->id)->first();
    $observacion = Observacion::where('empleados_id', $empleado->id)->first();
    $pdf = Pdf::loadView('modules.historialclinico.informe.registrosEmpleadosPDF', compact('empleado', 'antecedentes',
    'heredoFamiliares','personalesPatologicos','noPatologicos','riesgoTrabajo','riesgoEnfermedad', 
    'padece','datosFisicos','craneo','cuello','boca','ojos','nariz','oidos','visual','abdomen',
    'torax','piel','genitales','miembro','pelvicos','cervical','dorsal','lumbar','vertebral',
    'auxiliar','observacion'));
    return $pdf->download('ficha_empleado.pdf');
}
}
