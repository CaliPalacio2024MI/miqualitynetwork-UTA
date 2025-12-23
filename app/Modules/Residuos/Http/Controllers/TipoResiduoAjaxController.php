<?php

namespace App\Modules\Residuos\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Residuos\Models\TipoResiduo;

class TipoResiduoAjaxController extends Controller
{
    /**
     * Actualiza un registro de TipoResiduo vía AJAX.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'color'  => 'required|string|size:7', // Ejemplo: "#FFFFFF"
            'precio' => 'required|numeric|min:0'
        ]);

        // Buscar el registro
        $tipo = TipoResiduo::findOrFail($id);

        // Actualizar en la BD
        $tipo->update($data);

        // Responder en JSON
        return response()->json([
            'message' => 'Tipo de Residuo actualizado correctamente.',
            'data'    => $data
        ], 200);
    }
}
