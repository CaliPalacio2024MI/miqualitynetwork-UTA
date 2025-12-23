<?php

namespace App\Modules\Bsc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Bsc\Models\process;
use App\Modules\Bsc\Models\subprocess;
use App\Modules\Bsc\Models\indicator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Propiedades;

class processController extends Controller
{
public function index()
    {
        // Obtener procesos agrupados por propiedad
        $propiedades = Propiedades::with(['processes.subprocesses.indicators'])
    ->get()
    ->map(function($propiedad) {
        $propiedad->total_rows = $propiedad->processes->max(function($process) {
            return $process->subprocesses->max(function($subprocess) {
                return max($subprocess->indicators->count(), 1);
            });
        });
        return $propiedad;
    });

$processes = $propiedades->flatMap->processes; // <- aquí
        

                        
        
        return view('modules.bsc.processes.index_cards', compact('processes', 'propiedades'));
    }
    
    public function create(Request $request)
        {
            $propiedades = Propiedades::all();
            $selectedPropiedad = $request->input('propiedad_id', null);
            
            return response()->json([
                'success' => true,
                'propiedades' => $propiedades,
                'selectedPropiedad' => $selectedPropiedad
            ]);
        }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'id_propiedad' => 'required|exists:propiedades,id_propiedad',
            'subprocesses' => 'sometimes|array',
            'subprocesses.*.name' => 'required|string|max:255',
            'subprocesses.*.indicators' => 'sometimes|array',
            'subprocesses.*.indicators.*.name' => 'required|string|max:255',
            'subprocesses.*.indicators.*.data' => 'nullable|json'
        ]);

        try {
            DB::beginTransaction();
            
            $process = Process::create([
                'name' => $validated['name'],
                'id_propiedad' => $validated['id_propiedad']
            ]);

            if (isset($validated['subprocesses'])) {
                foreach ($validated['subprocesses'] as $subprocessData) {
                    $subprocess = $process->subprocesses()->create([
                        'name' => $subprocessData['name']
                    ]);

                    if (isset($subprocessData['indicators'])) {
                        foreach ($subprocessData['indicators'] as $indicatorData) {
                            $subprocess->indicators()->create([
                                'name' => $indicatorData['name'],
                                'data' => $indicatorData['data'] ?? null
                            ]);
                        }
                    }
                }
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Proceso creado correctamente',
                'redirect' => route('processes.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating process: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear proceso: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
{
    $process = Process::with('subprocesses.indicators')->findOrFail($id);
    $propiedades = Propiedades::all(); // Obtener todas las propiedades
    
    return response()->json([
        'success' => true,
        'process' => $process,
        'propiedades' => $propiedades,
        'selectedPropiedad' => $process->id_propiedad // Propiedad actual del proceso
    ]);
}

    // Agregar este método al ProcessController
public function getIndicatorTemplate(Request $request)
{
    return view('modules.bsc.processes._indicator', [
        'subprocessIndex' => $request->subprocessIndex,
        'indicatorIndex' => $request->index
    ]);
}


    public function update(Request $request, Process $process)
    {
        $validated = $request->validate([

           'name' => 'required|string|max:255',
            'id_propiedad' => 'required|exists:propiedades,id_propiedad',
            'subprocesses' => 'sometimes|array',
            'subprocesses.*.id' => 'sometimes|exists:subprocesses,id',
            'subprocesses.*.name' => 'required|string|max:255',
            'subprocesses.*.indicators' => 'sometimes|array',
            'subprocesses.*.indicators.*.id' => 'sometimes|exists:indicators,id',
            'subprocesses.*.indicators.*.name' => 'required|string|max:255',
            'subprocesses.*.indicators.*.data' => 'nullable|json'
        ]);

        try {
            DB::beginTransaction();
            
            $process->update(['name' => $validated['name']]);

            if (isset($validated['subprocesses'])) {
                $subprocessIds = [];
                
                foreach ($validated['subprocesses'] as $subprocessData) {
                    // Actualizar o crear subproceso
                    if (isset($subprocessData['id'])) {
                        $subprocess = $process->subprocesses()->find($subprocessData['id']);
                        $subprocess->update(['name' => $subprocessData['name']]);
                    } else {
                        $subprocess = $process->subprocesses()->create(['name' => $subprocessData['name']]);
                    }
                    $subprocessIds[] = $subprocess->id;

                    // Manejar indicadores
                    if (isset($subprocessData['indicators'])) {
                        $indicatorIds = [];
                        
                        foreach ($subprocessData['indicators'] as $indicatorData) {
                            if (isset($indicatorData['id'])) {
                                $indicator = $subprocess->indicators()->find($indicatorData['id']);
                                $indicator->update([
                                    'name' => $indicatorData['name'],
                                    'data' => $indicatorData['data'] ?? null
                                ]);
                            } else {
                                $indicator = $subprocess->indicators()->create([
                                    'name' => $indicatorData['name'],
                                    'data' => $indicatorData['data'] ?? null
                                ]);
                            }
                            $indicatorIds[] = $indicator->id;
                        }
                        
                        // Eliminar indicadores que no están en la lista actual
                        $subprocess->indicators()->whereNotIn('id', $indicatorIds)->delete();
                    } else {
                        // Si no hay indicadores en la solicitud, eliminar todos los existentes
                        $subprocess->indicators()->delete();
                    }
                }
                
                // Eliminar subprocesos que no están en la lista actual
                $process->subprocesses()->whereNotIn('id', $subprocessIds)->delete();
            } else {
                // Si no hay subprocesos en la solicitud, eliminar todos los existentes
                $process->subprocesses()->delete();
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true, 
                'message' => 'Proceso actualizado correctamente',
                'redirect' => route('processes.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating process: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Error al actualizar proceso: ' . $e->getMessage()
            ], 500);
        }
    }



    public function destroy(Process $process)
{
    try {
        DB::beginTransaction();
        
        // Eliminar todos los indicadores asociados a los subprocesos
        $process->subprocesses()->each(function($subprocess) {
            $subprocess->indicators()->delete();
        });
        
        // Eliminar todos los subprocesos
        $process->subprocesses()->delete();
        

        
        // Finalmente eliminar el proceso principal
        $process->delete();
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Proceso y todos sus elementos asociados eliminados correctamente'
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Error deleting process: " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar el proceso: ' . $e->getMessage()
        ], 500);
    }
}

public function showIndicatorData($indicatorId)
{
    $indicator = Indicator::with('subprocess.process')->findOrFail($indicatorId);
    
    // Procesar datos del indicador según su configuración
    $chartData = $this->processIndicatorData($indicator->data);
    
    return response()->json([
        'name' => $indicator->name,
        'html' => view('processes._indicator_view', [
            'indicator' => $indicator,
            'chartData' => $chartData
        ])->render()
    ]);
}

private function processIndicatorData($data)
{
    // Aqui se procesaran losd atos de lo que mostraran los indicadores
    return [
        'type' => $data['type'] ?? 'doughnut',
        'title' => $data['departamento'] ?? [],
        'resultado_actual' => $data['resultado'] ?? [],
        'resultado_esperado' => $data['resultado_esperado'] ?? []
    ];
}

// En processController.php agregar este método
public function fetchApiData(Request $request)
{
    $request->validate([
        'api_url' => 'required|url'
    ]);

    try {
        $client = new Client();
        $response = $client->get($request->api_url, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'verify' => false // Solo para desarrollo
        ]);

        $data = json_decode($response->getBody(), true);

        // Estructura similar a tu ejemplo que funciona
        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos correctamente',
            'data_sample' => $data
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener datos de la API: ' . $e->getMessage()
        ], 500);
    }
}
public function testApiConnection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'URL inválida',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $client = new Client();
            $response = $client->get($request->api_url, [
                'headers' => ['Accept' => 'application/json'],
                'http_errors' => false
            ]);

            $contentType = $response->getHeaderLine('Content-Type');
            if (!str_contains($contentType, 'application/json')) {
                throw new \Exception("La API no devolvió un JSON válido");
            }

            $data = json_decode($response->getBody(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("La respuesta no es un JSON válido");
            }

            // Extraer campos disponibles para indicadores
            $availableFields = [];
            if (isset($data[0]) && is_array($data[0])) {
                $availableFields = array_keys($data[0]);
            } elseif (is_array($data)) {
                $availableFields = array_keys($data);
            }

            return response()->json([
                'success' => true,
                'message' => 'Conexión exitosa',
                'available_fields' => $availableFields,
                'data_sample' => array_slice($data, 0, 3)
            ]);

        } catch (\Exception $e) {
            Log::error("Error probando conexión API: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al conectar con la API: ' . $e->getMessage()
            ], 500);
        }
    }

}

