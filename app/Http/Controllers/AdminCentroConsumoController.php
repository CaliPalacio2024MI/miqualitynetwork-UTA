<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroConsumo;

class AdminCentroConsumoController extends Controller
{
    // Mostrar y buscar centros de consumo
    public function index(Request $request)
{
    $buscar = $request->input('buscar');

    $centros = CentroConsumo::when($buscar, function ($query, $buscar) {
        return $query->where('nombre', 'LIKE', "%{$buscar}%")
                     ->orWhere('propiedad', 'LIKE', "%{$buscar}%");
    })->get();

    $datos = ['centros' => $centros, 'buscar' => $buscar];
return call_user_func('view', 'modules.bcp.administracion.centros_consumo', $datos);


}






    // Guardar un nuevo centro de consumo
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'propiedad' => 'required|string|max:100',
            'categoria' => 'nullable|string|max:100',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        CentroConsumo::create($data);

        return back()->with('success', 'Centro de consumo creado correctamente.');
    }
}

