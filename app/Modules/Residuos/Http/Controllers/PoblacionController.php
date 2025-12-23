<?php

namespace App\Modules\Residuos\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Modules\Residuos\Models\Poblacion;
use Carbon\Carbon;

class PoblacionController extends Controller
{
    public function index(Request $request)
    {
        // Filtros de rango de fechas
        $query = Poblacion::orderBy('created_at', 'desc');

        if ($request->filled('fecha_inicio_filtro') && $request->filled('fecha_fin_filtro')) {
            $query->where(function($q) use ($request) {
                $q->where('fecha_inicio', '<=', $request->fecha_fin_filtro)
                  ->where('fecha_fin',   '>=', $request->fecha_inicio_filtro);
            });
        } else {
            if ($request->filled('fecha_inicio_filtro')) {
                $query->where('fecha_fin', '>=', $request->fecha_inicio_filtro);
            }
            if ($request->filled('fecha_fin_filtro')) {
                $query->where('fecha_inicio', '<=', $request->fecha_fin_filtro);
            }
        }

        $poblaciones = $query->get();

        return view('modules.residuos.control_de_residuos.poblacion', compact('poblaciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mes_anio'    => ['required','date_format:Y-m'],
            'huespedes'   => 'required|integer',
            'anfitriones' => 'required|integer',
            'visitantes'  => 'required|integer',
            'probedores'  => 'required|integer',
        ]);

        // Construir Carbon del primer día del mes
        $dt    = Carbon::createFromFormat('Y-m', $validated['mes_anio'])->startOfMonth();
        $year  = $dt->year;
        $month = $dt->month;

        if (Poblacion::where('anio', $year)->where('mes', $month)->exists()) {
            $nombre = $dt->locale('es')->isoFormat('MMMM YYYY');
            return redirect()
                ->route('configuracion.poblacion.index')
                ->with('error', "El mes {$nombre} ya ha sido registrado.");
        }

        // Fechas inicio y fin de ese mes
        $fecha_inicio = $dt->toDateString();
        $fecha_fin    = $dt->copy()->endOfMonth()->toDateString();

        // Calcular PAX
        $pax = $validated['huespedes']
             + $validated['anfitriones']
             + $validated['visitantes']
             + $validated['probedores'];

        Poblacion::create([
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin'    => $fecha_fin,
            'huespedes'    => $validated['huespedes'],
            'anfitriones'  => $validated['anfitriones'],
            'visitantes'   => $validated['visitantes'],
            'probedores'   => $validated['probedores'],
            'pax'          => $pax,
            'anio'         => $year,
            'mes'          => $month,
        ]);

        return redirect()
            ->route('configuracion.poblacion.index')
            ->with('success','Registro de población guardado con éxito.');
    }

    public function destroy($id)
    {
        Poblacion::findOrFail($id)->delete();

        return redirect()
            ->route('configuracion.poblacion.index')
            ->with('success','Registro eliminado correctamente.');
    }
}
