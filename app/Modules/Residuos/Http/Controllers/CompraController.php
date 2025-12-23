<?php

namespace App\Modules\Residuos\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Residuos\Models\Compra;
use App\Modules\Residuos\Models\TipoResiduo;
use Carbon\Carbon;

class CompraController extends Controller
{
    /**
     * 1) Mostrar lista con filtros
     */
    public function index(Request $request)
    {
        $tipos = TipoResiduo::all();

        $query = Compra::with('tipo_residuo')->orderBy('created_at', 'desc');

        // filtro por tipo
        if ($request->filled('tipo_filtro')) {
            $query->where('tipo_residuo_id', $request->tipo_filtro);
        }

        // filtros de fechas (solapamiento)
        if ($request->filled('fecha_inicio_filtro') && $request->filled('fecha_fin_filtro')) {
            $query->where(function ($q) use ($request) {
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

        $compras = $query->get();

        return view('modules.residuos.control_de_residuos.compras', compact('tipos', 'compras'));
    }

    /**
     * 2) Guardar nueva compra (única por mes y tipo)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'mes_anio'         => ['required','date_format:Y-m'],
            'tipo_residuo_id'  => 'required|exists:tipos_residuos,id',
            'compra_kg'        => 'required|numeric|min:0',
        ]);

        // crear un Carbon en el primer día del mes
        $dt = Carbon::createFromFormat('Y-m', $data['mes_anio'])->startOfMonth();

        // calcular fechas de inicio y fin de mes
        $fecha_inicio = $dt->toDateString();
        $fecha_fin    = $dt->copy()->endOfMonth()->toDateString();

        $anio = $dt->year;
        $mes  = $dt->month;

        // verificar si ya existe compra para ese mes/año y tipo
        $existe = Compra::where('tipo_residuo_id', $data['tipo_residuo_id'])
                        ->where('anio', $anio)
                        ->where('mes',  $mes)
                        ->exists();

        if ($existe) {
            $mesNombre = $dt->locale('es')->isoFormat('MMMM YYYY');
            return redirect()
                ->route('configuracion.compras.index')
                ->with('error', "Ya existe una compra para {$mesNombre} y ese tipo de residuo.");
        }

        Compra::create([
            'fecha_inicio'     => $fecha_inicio,
            'fecha_fin'        => $fecha_fin,
            'tipo_residuo_id'  => $data['tipo_residuo_id'],
            'compra_kg'        => $data['compra_kg'],
            'anio'             => $anio,
            'mes'              => $mes,
        ]);

        return redirect()
            ->route('configuracion.compras.index')
            ->with('success', 'Compra registrada con éxito.');
    }

    /**
     * 3) Eliminar compra
     */
    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();

        return redirect()
            ->route('configuracion.compras.index')
            ->with('success', 'Compra eliminada correctamente.');
    }
}
