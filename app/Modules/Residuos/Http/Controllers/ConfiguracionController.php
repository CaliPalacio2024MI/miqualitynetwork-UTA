<?php

namespace App\Modules\Residuos\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Residuos\Models\TipoResiduo;
use App\Modules\Residuos\Models\AreaProcedencia;

class ConfiguracionController extends Controller
{
    // Muestra la vista para gestionar los Tipos de Residuo.
    public function mostrarTipoResiduo()
    {
        $tipos = TipoResiduo::orderBy('nombre')->get();
        return view('modules.residuos.administracion.tipo_residuo', compact('tipos'));
    }

    // Muestra la vista para gestionar las Áreas de Procedencia.
    public function mostrarAreaProcedencia()
    {
        $areas = AreaProcedencia::orderBy('nombre')->get();
        return view('modules.residuos.administracion.area_procedencia', compact('areas'));
    }

    // Agrega un nuevo Tipo de Residuo.
    public function agregarTipoResiduo(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'color'  => 'required|string|size:7',
            'precio' => 'required|numeric|min:0'
        ]);

        TipoResiduo::create([
            'nombre' => $request->nombre,
            'color'  => $request->color,
            'precio' => $request->precio
        ]);

        return redirect()->route('configuracion.tipo_residuo')
                         ->with('success', 'Tipo de Residuo agregado correctamente.');
    }

    // Edita un Tipo de Residuo.
    public function editarTipoResiduo(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'color'  => 'required|string|size:7',
            'precio' => 'required|numeric|min:0'
        ]);

        $tipo = TipoResiduo::findOrFail($id);
        $tipo->update([
            'nombre' => $request->nombre,
            'color'  => $request->color,
            'precio' => $request->precio
        ]);

        return redirect()->route('configuracion.tipo_residuo')
                         ->with('success', 'Tipo de Residuo actualizado correctamente.');
    }

    // Elimina un Tipo de Residuo.
    public function eliminarTipoResiduo($id)
    {
        TipoResiduo::destroy($id);

        return redirect()->route('configuracion.tipo_residuo')
                         ->with('success', 'Tipo de Residuo eliminado correctamente.');
    }

    // Agrega un nuevo Área de Procedencia.
    public function agregarAreaProcedencia(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        AreaProcedencia::create(['nombre' => $request->nombre]);

        return redirect()->route('configuracion.area_procedencia')
                         ->with('success', 'Área de Procedencia agregada correctamente.');
    }

    // Edita un Área de Procedencia.
    public function editarAreaProcedencia(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $area = AreaProcedencia::findOrFail($id);
        $area->update(['nombre' => $request->nombre]);

        return redirect()->route('configuracion.area_procedencia')
                         ->with('success', 'Área de Procedencia actualizada correctamente.');
    }

    // Elimina un Área de Procedencia.
    public function eliminarAreaProcedencia($id)
    {
        AreaProcedencia::destroy($id);

        return redirect()->route('configuracion.area_procedencia')
                         ->with('success', 'Área de Procedencia eliminada correctamente.');
    }
}
