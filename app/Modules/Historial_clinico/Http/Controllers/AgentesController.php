<?php

namespace App\Modules\Historial_clinico\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Modules\Historial_clinico\Models\Agente; // Esta también
use Illuminate\Http\Request;

class AgentesController extends Controller
{
    /**
     * Muestra la vista de administración de agentes.
     * Carga los datos iniciales necesarios para la vista (si los hubiera, aunque para agentes no se necesitan propiedades/departamentos).
     *
     * @return \Illuminate\View\View
     */
    public function indexAgentes()
    {
        // En este caso, para 'agentes', no necesitas cargar propiedades ni departamentos,
        // ya que la lógica de carga de la lista será completamente con JavaScript.
        // Solo retornamos la vista 'agentes'.
        return view('modules.historialclinico.administracion.agentes');
    }

    /**
     * Almacena un nuevo agente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'agente' => 'required|string|max:255|unique:agentes,agente', // Asegura que el nombre del agente sea único
        ]);

        $agente = Agente::create([
            'agente' => $request->input('agente'),
        ]);

        return response()->json(['message' => 'Agente agregado correctamente.', 'agente' => $agente], 201);
    }

    /**
     * Actualiza el nombre de un agente existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $agente = Agente::find($id);

        if (!$agente) {
            return response()->json(['message' => 'Agente no encontrado.'], 404);
        }

        $request->validate([
            'agente' => 'required|string|max:255|unique:agentes,agente,' . $id, // Ignora el propio ID al validar unicidad
        ]);

        $agente->agente = $request->input('agente');
        $agente->save();

        return response()->json(['message' => 'Agente actualizado con éxito.']);
    }

    /**
     * Elimina un agente de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $agente = Agente::find($id);

        if (!$agente) {
            return response()->json(['message' => 'Agente no encontrado.'], 404);
        }

        $agente->delete();
        return response()->json(['message' => 'Agente eliminado con éxito.']);
    }

    /**
     * Obtiene y devuelve todos los agentes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAgentes()
    {
        $agentes = Agente::all();
        return response()->json($agentes);
    }

    /**
     * Busca agentes por nombre.
     *
     * @param  string  $termino
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscarAgentes($termino)
    {
        $agentes = Agente::where('agente', 'LIKE', '%' . $termino . '%')->get();
        return response()->json($agentes);
    }
}