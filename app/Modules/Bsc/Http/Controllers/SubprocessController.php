<?php

namespace App\Modules\Bsc\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Bsc\Models\Subprocess;
use App\Modules\Bsc\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubprocessController extends Controller
{

     public function edit(Subprocess $subprocess)
    {
        try {
            $subprocess->load('indicators');
            
            return response()->json([
                'success' => true,
                'subprocess' => $subprocess,
                'process_id' => $subprocess->process_id
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching subprocess: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar el subproceso'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'process_id' => 'required|exists:processes,id'
        ]);

        try {
            DB::beginTransaction();
            
            $subprocess = Subprocess::create($validated);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Subproceso creado correctamente',
                'redirect' => route('processes.index')
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating subprocess: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear subproceso'
            ], 500);
        }
    }

    public function update(Request $request, Subprocess $subprocess)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'process_id' => 'required|exists:processes,id'
        ]);

        try {
            DB::beginTransaction();
            
            $subprocess->update($validated);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Subproceso actualizado correctamente',
                'redirect' => route('processes.index')
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating subprocess: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar subproceso'
            ], 500);
        }
    }

    public function destroy(Subprocess $subprocess)
    {
        try {
            DB::beginTransaction();
            
            // Eliminar indicadores asociados primero
            $subprocess->indicators()->delete();
            $subprocess->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Subproceso eliminado correctamente'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting subprocess: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar subproceso'
            ], 500);
        }
    }
}
