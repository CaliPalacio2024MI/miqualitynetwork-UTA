<?php

namespace App\Modules\Bsc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bsc\Property;
use App\Models\Propiedades;

class PropiedadController extends Controller
{
    public function index()
    {
        $propiedades = Propiedades::all();
        $propiedadSeleccionada = Propiedades::first();

        return view('modules.bsc.propiedad.panel', compact('propiedades', 'propiedadSeleccionada'));
    }
    public function getProcesses($id)
{
    $propiedad = Propiedades::with('processes.subprocesses.indicators')
        ->findOrFail($id);

    // Devuelve solo los datos necesarios
    return response()->json($propiedad->processes);
}
}


