<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Propiedades;
use App\Models\Proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // ← Asegúrate de tener esto arriba

class DepartamentosController extends Controller
{
    /**
     * Devuelve todos los departamentos en JSON
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Departamento::with('proceso')->get()); // ← ahora con proceso
    }

    /**
     * Muestra la vista de administración de departamentos con la lista de propiedades.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        $propiedades = Propiedades::all();
        $procesos = Proceso::all(); // ← agregamos procesos
        return view('administracion.departamentos.index', compact('propiedades', 'procesos'));
    }

    /**
     * Almacena un nuevo departamento.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'departamento' => 'required|string|max:255',
                'propiedad_id' => 'required|integer|exists:propiedades,id_propiedad',
                'proceso_id' => 'nullable|integer|exists:procesos,id_proceso', // ✅ ← AQUÍ FUE LA CORRECCIÓN
            ]);

            $departamento = \App\Models\Departamento::create([
                'departamento' => $request->departamento,
                'propiedad_id' => $request->propiedad_id,
                'proceso_id' => $request->proceso_id, // ← guardar proceso
            ]);

            return response()->json([
                'message' => 'Departamento agregado correctamente.',
                'departamento' => $departamento
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error inesperado en el servidor.',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Actualiza un departamento específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if (! $departamento) {
            return response()->json(['message' => 'Departamento no encontrado.'], 404);
        }

        $request->validate([
            'departamento' => 'required|string|max:255',
            'proceso_id' => 'nullable|integer|exists:procesos,id_proceso', // ✅ ← TAMBIÉN AQUÍ FUE LA CORRECCIÓN
        ]);

        $departamento->update([
            'departamento' => $request->input('departamento'),
            'proceso_id' => $request->input('proceso_id'), // ← actualización
        ]);

        return response()->json(['message' => 'Departamento actualizado con éxito.']);
    }

    /**
     * Elimina un departamento específico.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $departamento = Departamento::find($id);

        if ($departamento) {
            $departamento->delete();
            return response()->json(['message' => 'Departamento eliminado con éxito.']);
        }

        return response()->json(['message' => 'Departamento no encontrado.'], 404);
    }

    /**
     * Obtiene departamentos filtrados por el ID de propiedad.
     *
     * @param int $propiedadId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByPropiedad($propiedadId)
    {
        $departamentos = \App\Models\Departamento::where('propiedad_id', $propiedadId)->get();
        return response()->json($departamentos);
    }

    /**
     * Busca departamentos por nombre y propiedad.
     *
     * @param int    $propiedadId
     * @param string $termino
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscarDepartamentos($propiedadId, $termino)
    {
        $departamentos = Departamento::where('propiedad_id', $propiedadId)
            ->where('departamento', 'LIKE', '%' . $termino . '%')
            ->get();

        return response()->json($departamentos);
    }
}
