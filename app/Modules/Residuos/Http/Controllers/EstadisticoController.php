<?php

namespace App\Modules\Residuos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EstadisticoController extends Controller
{
    public function index(Request $request)
    {
        $tiposResiduos = DB::table('tipos_residuos')->get();

        $query = DB::table('residuos_salidas')
            ->leftJoin('tipos_residuos', 'residuos_salidas.tipo_residuo_id', '=', 'tipos_residuos.id'); // ✅ corregido

        $hayFiltros = $request->filled('tipo') || $request->filled('fecha_inicio');

        if ($hayFiltros) {
            if ($request->filled('fecha_inicio')) {
                list($year, $month) = explode('-', $request->fecha_inicio);
                $query->whereYear('residuos_salidas.fecha_salida', $year)
                      ->whereMonth('residuos_salidas.fecha_salida', $month);
            }

            if ($request->filled('tipo')) {
                $query->where('tipos_residuos.nombre', $request->tipo);
            }
        } else {
            $now = Carbon::now();
            $query->whereYear('residuos_salidas.fecha_salida', $now->year)
                  ->whereMonth('residuos_salidas.fecha_salida', $now->month);
        }

        $query->groupBy(
            'tipos_residuos.id',
            'tipos_residuos.nombre',
            'tipos_residuos.precio',
            DB::raw('YEAR(residuos_salidas.fecha_salida)'),
            DB::raw('MONTH(residuos_salidas.fecha_salida)')
        );

        $query->select(
            DB::raw('SUM(residuos_salidas.cantidad_kg) as cantidad_kg'),
            DB::raw('YEAR(residuos_salidas.fecha_salida) as anio'),
            DB::raw('MONTH(residuos_salidas.fecha_salida) as mes'),
            'tipos_residuos.nombre as residuo',
            'tipos_residuos.precio as precio_kg',

            DB::raw("ANY_VALUE((
                SELECT SUM(c.compra_kg)
                FROM compras c
                WHERE c.tipo_residuo_id = tipos_residuos.id
                  AND c.anio = YEAR(residuos_salidas.fecha_salida)
                  AND c.mes  = MONTH(residuos_salidas.fecha_salida)
            )) as compra_kg"),

            DB::raw("ANY_VALUE((
                SELECT p.pax
                FROM poblaciones p
                WHERE p.anio = YEAR(residuos_salidas.fecha_salida)
                  AND p.mes  = MONTH(residuos_salidas.fecha_salida)
                LIMIT 1
            )) as pax")
        );

        $residuosSalidas = $query->get();

        return view('modules.residuos.reporte_de_residuos.index', compact('tiposResiduos', 'residuosSalidas'));
    }
}
