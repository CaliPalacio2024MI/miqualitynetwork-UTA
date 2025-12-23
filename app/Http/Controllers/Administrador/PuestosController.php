<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Puestos;
use App\Models\Propiedades;
use App\Models\Departamento;
use App\Models\Proceso; // ← agregado

class PuestosController extends Controller
{
    /**
     * Muestra la vista de administración de puestos con la lista de propiedades y departamentos.
     *
     * @return \Illuminate\View\View
     */
    public function indexPuestos()
    {
        $propiedades = \App\Models\Propiedades::all();
        $departamentos = \App\Models\Departamento::all();
        $procesos = \App\Models\Proceso::all(); // ← agregado

        return view('administracion.puestos.index', compact('propiedades', 'departamentos', 'procesos'));
    }

    /**
     * Devuelve todos los puestos en JSON (API global).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiIndex()
    {
        return response()->json(Puestos::with('proceso')->get()); // ← agregamos la relación
    }

    /**
     * Almacena un nuevo puesto.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'puesto'           => 'required|string|max:255',
            'departamento_id'  => 'required|exists:departamentos,id',
            'propiedad_id'     => 'required|exists:propiedades,id_propiedad',
            'proceso_id'       => 'nullable|exists:procesos,id_proceso', // ← nuevo
        ]);

        Puestos::create([
            'puesto'           => $request->input('puesto'),
            'departamento_id'  => $request->input('departamento_id'),
            'propiedad_id'     => $request->input('propiedad_id'),
            'proceso_id'       => $request->input('proceso_id'), // ← nuevo
        ]);

        return redirect()->back()
            ->with('success', 'Puesto agregado correctamente.')
            ->with('selected_propiedad', $request->input('propiedad_id'))
            ->with('selected_departamento', $request->input('departamento_id'));
    }

    /**
     * Actualiza un puesto específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $puesto = Puestos::find($id);

        if (! $puesto) {
            return response()->json(['message' => 'Puesto no encontrado.'], 404);
        }

        $request->validate([
            'puesto'      => 'required|string|max:255',
            'proceso_id'  => 'nullable|exists:procesos,id_proceso', // ← nuevo
        ]);

        $puesto->puesto = $request->input('puesto');
        $puesto->proceso_id = $request->input('proceso_id'); // ← nuevo
        $puesto->save();

        return response()->json(['message' => 'Puesto actualizado con éxito.']);
    }

    /**
     * Elimina un puesto específico.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $puesto = Puestos::find($id);

        if ($puesto) {
            $puesto->delete();
            return response()->json(['message' => 'Puesto eliminado con éxito.']);
        }

        return response()->json(['message' => 'Puesto no encontrado.'], 404);
    }

    /**
     * Devuelve los puestos filtrados por departamento.
     *
     * @param  int  $departamentoId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByDepartamento($departamentoId)
    {
        $puestos = Puestos::where('departamento_id', $departamentoId)->get();
        return response()->json($puestos);
    }

    /**
     * Obtiene puestos filtrados por departamento y propiedad.
     *
     * @param int $departamentoId
     * @param int $propiedadId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByDepartamentoAndPropiedad($propiedadId, $departamentoId)
    {
        $puestos = Puestos::where('departamento_id', $departamentoId)
            ->where('propiedad_id', $propiedadId)
            ->get();

        return response()->json($puestos);
    }

    /**
     * Busca puestos por nombre dentro de una propiedad y departamento.
     *
     * @param int    $departamentoId
     * @param int    $propiedadId
     * @param string $termino
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscarPuestos($departamentoId, $propiedadId, $termino)
    {
        $puestos = Puestos::where('departamento_id', $departamentoId)
            ->where('propiedad_id', $propiedadId)
            ->where('puesto', 'LIKE', '%' . $termino . '%')
            ->get();
        return response()->json($puestos);
    }
}
