<?php

namespace App\Modules\Bsc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bsc\Objetivo;
use App\Models\Bsc\Property;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class ObjetivoController extends Controller
{
    public function index()
    {
       
        $properties = Property::all(); 
        $objetivos = Objetivo::with(['property', 'parent', 'children'])
            ->orderBy('property_id')
            ->orderBy('parent_id')
            ->get();
            
        return view('objetivos.index', [
            'objetivosPadres' => $objetivos->whereNull('parent_id'),
            'objetivos' => $objetivos,
            'properties' => $properties
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'peso' => 'required|numeric|min:0|max:100',
            'property_id' => 'required|exists:properties,id',
            'parent_id' => 'nullable|exists:objetivos,id',
            'api_url' => 'required|url',
            'indicador_key' => 'required|string',
            'color' => 'required|string|size:7'
        ]);
        
        
        try {
            $objetivo = Objetivo::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Objetivo creado correctamente',
                'data' => $objetivo
            ]);

        } catch (\Exception $e) {
            Log::error('Error al crear objetivo: ' . $e->getMessage());
            return view('objetivos.index')->with([
                'success' => false,
                'message' => 'Error al crear objetivo',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, Objetivo $objetivo)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'peso' => 'required|numeric|min:0|max:100',
            'property_id' => 'required|exists:properties,id',
            'parent_id' => 'nullable|exists:objetivos,id',
            'api_url' => 'required|url',
            'indicador_key' => 'required|string',
            'color' => 'required|string|size:7'
        ]);

        try {
            $objetivo->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Objetivo actualizado correctamente',
                'data' => $objetivo
            ]);

        } catch (\Exception $e) {
            Log::error('Error al actualizar objetivo: ' . $e->getMessage());
            return view('objetivos.index')->with([
                'success' => false,
                'message' => 'Error al crear objetivo',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit(Objetivo $objetivo)
    {
        $properties = Property::all();
        $objetivosPadres = Objetivo::whereNull('parent_id')
                        ->where('id', '!=', $objetivo->id)
                        ->get();
        
        return response()->json([
            'formAction' => route('objetivos.update', $objetivo),
            'objetivo' => $objetivo,
            'properties' => $properties,
            'objetivosPadres' => $objetivosPadres
        ]);
    }

    public function destroy(Objetivo $objetivo)
    {
        try {
            if ($objetivo->children()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'No se puede eliminar el objetivo porque tiene objetivos hijos asignados.');
            }

            $objetivo->delete();
            return redirect()->route('objetivos.index')
                ->with('success', 'Objetivo eliminado correctamente');
        } catch (\Exception $e) {
            Log::error("Error eliminando objetivo: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el objetivo');
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

private function extractAvailableFields($data)
{
    if (empty($data)) return [];

    // Si es un array de objetos, usar las claves del primer elemento
    if (isset($data[0]) && is_array($data[0])) {
        return array_keys($data[0]);
    }
    
    // Si es un objeto simple
    if (is_array($data)) {
        return array_keys($data);
    }
    
    return [];
}
    
    private function processApiDataForChart(array $apiData, string $field)
    {
        // Procesamiento básico - puedes adaptarlo según la estructura de tu API
        $labels = [];
        $values = [];
        
        if (isset($apiData[0])) {
            // Array de elementos
            foreach ($apiData as $item) {
                $item = (array)$item;
                $labels[] = $item['fecha'] ?? $item['periodo'] ?? count($labels) + 1;
                $values[] = $item[$field] ?? 0;
            }
        } else {
            // Objeto simple
            $labels = array_keys($apiData);
            $values = array_values($apiData);
        }
        
        return [
            'labels' => $labels,
            'values' => $values
        ];
    }
    
    private function buildApiUrl(Objetivo $objetivo)
    {
        $baseUrl = $objetivo->api_url;
        $params = json_decode($objetivo->api_params, true) ?? [];
        
        $queryString = http_build_query(
            array_reduce($params, function($carry, $item) {
                $carry[$item['key']] = $item['value'];
                return $carry;
            }, [])
        );
        
        return str_contains($baseUrl, '?') ? 
            $baseUrl . '&' . $queryString : 
            $baseUrl . '?' . $queryString;
    }
    
    private function getAvailableFields(Objetivo $objetivo)
    {
        try {
            $apiUrl = $this->buildApiUrl($objetivo);
            $response = Http::get($apiUrl);
            
            if ($response->successful()) {
                $data = $response->json();
                return $this->extractAvailableFields($data);
            }
        } catch (\Exception $e) {
            Log::error("Error al obtener campos disponibles: " . $e->getMessage());
        }
        
        return [];
    }
    public function show(Objetivo $objetivo)
    {
        // Si se solicita refrescar los datos
        if (request()->has('refresh')) {
            try {
                $client = new Client();
                $response = $client->get($objetivo->api_url);
                $apiData = json_decode($response->getBody(), true);
                
                // Actualizar los metadatos
                $objetivo->meta = array_merge($objetivo->meta ?? [], [
                    'resultado' => $this->parsePercentage($apiData['resultado'] ?? 0),
                    'promedio_esperado' => $this->parsePercentage($apiData['promedio_esperado'] ?? 0)
                ]);
                $objetivo->save();
                
            } catch (\Exception $e) {
                Log::error("Error actualizando datos de API: " . $e->getMessage());
                return redirect()->back()->with('error', 'Error al actualizar datos: ' . $e->getMessage());
            }
        }
        
        return view('objetivos.show', compact('objetivo'));
    }
    
    private function parsePercentage($value)
    {
        if (is_numeric($value)) return $value;
        return (float) str_replace(['%', ','], '', $value);
    }

private function fetchApiData($apiUrl)
{
    $client = new Client();
    $response = $client->get($apiUrl);
    return json_decode($response->getBody(), true);
}

}