<?php

namespace App\Modules\Residuos\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Residuos\Models\Salida;
use App\Modules\Residuos\Models\Entrada;
use App\Modules\Residuos\Models\TipoResiduo;
use App\Modules\Residuos\Models\AreaProcedencia;

class SalidaController extends Controller
{
    /**
     * Muestra el formulario de Salida y la lista de entradas, con filtros
     */
    public function create(Request $request)
    {
        $query = Entrada::with(['tipoResiduo', 'areaProcedencia'])
            ->orderByDesc('fecha_entrada');

        // Si deseas filtrar por tipo_filtro
        if ($request->filled('tipo_filtro')) {
            $query->where('tipo_residuo_id', $request->tipo_filtro);
        }
        // Filtro por fecha_inicio_filtro
        if ($request->filled('fecha_inicio_filtro')) {
            $query->where('fecha_entrada', '>=', $request->fecha_inicio_filtro);
        }
        // Filtro por fecha_fin_filtro
        if ($request->filled('fecha_fin_filtro')) {
            $query->where('fecha_entrada', '<=', $request->fecha_fin_filtro);
        }

        // Obtener las entradas filtradas
        $entradas = $query->get();

        // Para el filtro de Tipo de Residuo
        $tiposPosibles = TipoResiduo::all();

        // Retorna la vista con $entradas y $tiposPosibles
        return view('modules.residuos.control_de_residuos.salidas', compact('entradas', 'tiposPosibles'));
    }

    public function store(Request $request)
    {
        // Validar que se reciba un array con al menos un ID
        $validatedData = $request->validate([
            'entrada_id'        => 'required|array|min:1',
            'entrada_id.*'      => 'exists:residuos_entradas,id',
            'fecha_salida'      => 'required|date',
            'quien_se_lo_lleva' => 'required|string|max:255',
            'testigo'           => 'nullable|string|max:255',
        ]);

        // Por cada ID seleccionado se crea una salida independiente
        foreach ($validatedData['entrada_id'] as $id) {
            $entrada = Entrada::findOrFail($id);

            // Armar los datos de la salida
            $dataSalida = [
                'entrada_id'        => $id,
                'tipo_residuo_id'   => $entrada->tipo_residuo_id,
                'cantidad_kg'       => $entrada->cantidad_kg,
                'fecha_salida'      => $validatedData['fecha_salida'],
                'quien_se_lo_lleva' => $validatedData['quien_se_lo_lleva'],
                'testigo'           => $validatedData['testigo'] ?? null,
            ];

            // Crear la Salida
            $salida = Salida::create($dataSalida);

            // Romper la relación para evitar borrado en cascada
            $salida->update(['entrada_id' => null]);

            // Eliminar la entrada
            $entrada->delete();
        }

        return redirect()
            ->route('salidas.create')
            ->with('success', 'Salidas registradas y entradas eliminadas con éxito.');
    }
}
