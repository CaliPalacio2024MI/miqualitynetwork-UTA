<?php

namespace App\Modules\Bsc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Bsc\Models\Indicator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndicatorController extends Controller
{
    public function edit(Indicator $indicator)
    {
        try {
            return response()->json([
                'success' => true,
                'indicator' => [
                    'id' => $indicator->id,
                    'name' => $indicator->name,
                    'subprocess_id' => $indicator->subprocess_id,
                    'data' => $indicator->data // Ya viene decodificado por el cast
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching indicator: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar el indicador'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subprocess_id' => 'required|exists:subprocesses,id',
            'data' => 'required|array' // Validamos que sea un array, el mutator lo convertirá a JSON
        ]);

        try {
            DB::beginTransaction();
            
            $indicator = Indicator::create([
                'name' => $validated['name'],
                'subprocess_id' => $validated['subprocess_id'],
                'data' => $validated['data'] // El mutator lo convierte a JSON automáticamente
            ]);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Indicador creado correctamente',
                'redirect' => route('processes.index'),
                'indicator' => $indicator
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating indicator: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear indicador: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Indicator $indicator)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subprocess_id' => 'required|exists:subprocesses,id',
            'data' => 'required|array'
        ]);

        try {
            DB::beginTransaction();
            
            $indicator->update([
                'name' => $validated['name'],
                'subprocess_id' => $validated['subprocess_id'],
                'data' => $validated['data'] // El mutator lo convierte a JSON
            ]);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Indicador actualizado correctamente',
                'redirect' => route('processes.index'),
                'indicator' => $indicator
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating indicator: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar indicador: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Indicator $indicator)
    {
        try {
            DB::beginTransaction();
            
            $indicator->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Indicador eliminado correctamente'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting indicator: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar indicador: ' . $e->getMessage()
            ], 500);
        }
    }
}