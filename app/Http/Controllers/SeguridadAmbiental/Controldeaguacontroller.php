<?php

namespace App\Http\Controllers\SeguridadAmbiental;

use App\Http\Controllers\Controller;
use App\Core\Models\Propiedades;
use App\Core\Models\Energetico;
use App\Models\Consumo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Controldeaguacontroller extends Controller
{
    // Vista principal de la sección "Control de Agua"
    public function controldeagua()
    {
        return view('seguridadambiental.controldeagua', [
            'propiedades' => Propiedades::all(),
            'energeticos' => Energetico::where('modulo', 'agua')->get(),
            'fecha_actual' => now()->format('Y-m-d')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'propiedad_id' => 'required|exists:propiedades,id_propiedad',
            'energetico_id' => 'required|exists:control_energeticos_tables,id', // Cambiado a nombre real de tabla
            'cantidad' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'costo' => 'required|numeric|min:0'
        ]);

        // Crear el registro de consumo
        $consumo = Consumo::create([
            'propiedad_id' => $validated['propiedad_id'],
            'energetico_id' => $validated['energetico_id'],
            'cantidad_utilizada' => $validated['cantidad'],
            'costo' => $validated['costo'],
            'fecha' => $validated['fecha']
        ]);

        // REDIRIGIR AL MES ANTERIOR (NO al mes del registro)
    return redirect()
        ->route('dashboard.reportedecontroldeenergeticos') // Sin parámetros
        ->with('success', 'Consumo registrado correctamente');
}
}