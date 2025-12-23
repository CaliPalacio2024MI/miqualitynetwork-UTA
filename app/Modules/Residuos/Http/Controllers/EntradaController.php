<?php

namespace App\Modules\Residuos\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Residuos\Models\Entrada;
use App\Modules\Residuos\Models\TipoResiduo;
use App\Modules\Residuos\Models\AreaProcedencia; 

class EntradaController extends Controller
{
    /**
     * Muestra el formulario y la lista de entradas registradas con posibilidad de filtrar.
     */
    public function index(Request $request)
    {
        // Obtener todos los tipos de residuo para el combo del filtro y del formulario
        $tipos  = TipoResiduo::all();
        // Obtener todas las áreas para el combo de procedencia
        $areas  = AreaProcedencia::all();

        // Construir la consulta base
        $query = Entrada::with(['tipoResiduo', 'areaProcedencia'])
                        ->orderByDesc('fecha_entrada');

        // Aplicar filtro por tipo de residuo
        if ($request->filled('tipo_filtro')) {
            $query->where('tipo_residuo_id', $request->tipo_filtro);
        }
        // Filtrar por fecha de inicio
        if ($request->filled('fecha_inicio_filtro')) {
            $query->where('fecha_entrada', '>=', $request->fecha_inicio_filtro);
        }
        // Filtrar por fecha fin
        if ($request->filled('fecha_fin_filtro')) {
            $query->where('fecha_entrada', '<=', $request->fecha_fin_filtro);
        }

        // Obtener las entradas según los filtros aplicados
        $entradas = $query->get();

        // Retornar la vista con el formulario y la tabla de entradas
       return view('modules.residuos.control_de_residuos.entradas', compact('tipos', 'areas', 'entradas'));

    }

    /**
     * Procesa el formulario y guarda la entrada en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'fecha_entrada'        => 'required|date',
            'tipo_residuo_id'      => 'required|exists:tipos_residuos,id',
            'area_procedencia_id'  => 'required|exists:areas_procedencia,id',
            'cantidad_kg'          => 'required|numeric',
            'observaciones'        => 'nullable|string'
        ]);

        // Crear el registro en la base de datos
        Entrada::create($validatedData);

        // Redirigir a la vista del listado con mensaje de éxito
        return redirect()
            ->route('entradas.index')
            ->with('success', 'Entrada registrada con éxito.');
    }
}
