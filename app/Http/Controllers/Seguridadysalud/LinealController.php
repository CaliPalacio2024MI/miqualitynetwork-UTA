<?php

namespace App\Http\Controllers\Seguridadysalud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioAccidente;
use App\Models\Propiedades;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EstadisticosExport;
use Maatwebsite\Excel\Facades\Excel;

class LinealController extends Controller
{
    /**
     * Muestra la vista principal con filtros.
     */
    public function estadisticos(Request $request)
    {
        // 1) Todas las propiedades para el filtro de Hotel
        $propiedades = Propiedades::all();

        // 2) Extraemos los años disponibles de la fecha_evento
        $anios = FormularioAccidente::query()
            ->selectRaw('YEAR(fecha_evento) as anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');

        // 3) Enviamos ambas variables al Blade
        return view('seguridadysalud.estadisticos', compact('propiedades', 'anios'));
    }

    /**
     * Devuelve los datos de las gráficas en JSON para AJAX.
     */
    public function datosEstadisticos(Request $r): JsonResponse
    {
        $hotel  = $r->input('hotel', '');
        $inicio = $r->input('fecha_inicio', '');
        $fin    = $r->input('fecha_fin', '');
        $anio   = $r->input('anio', '');

        // Base de accidentes con filtros de hotel, fechas y año
        $base = FormularioAccidente::query()
            ->when($hotel, fn($q) => $q->where('propiedad_id', $hotel))
            ->when(
                $inicio && $fin,
                fn($q) =>
                $q->whereBetween('fecha_evento', [$inicio, $fin])
            )
            ->when(
                $anio && $anio !== 'Todos',
                fn($q) =>
                $q->whereYear('fecha_evento', $anio)
            );

        // 1) Accidentes por Departamento
        $porDepto = (clone $base)
            ->select('departamento_evento as etiqueta', DB::raw('COUNT(*) as valores'))
            ->groupBy('departamento_evento')
            ->get();

        // 2) Accidentes por Mes
        $porMes = (clone $base)
            ->select(DB::raw('MONTH(fecha_evento) as etiqueta'), DB::raw('COUNT(*) as valores'))
            ->groupBy(DB::raw('MONTH(fecha_evento)'))
            ->get();

        // 3) Días Perdidos por Incapacidad
        $porDias = (clone $base)
            ->select(DB::raw('MONTH(fecha_evento) as etiqueta'), DB::raw('SUM(dias_incapacidad) as valores'))
            ->groupBy(DB::raw('MONTH(fecha_evento)'))
            ->get();

        // 4) Partes del cuerpo afectadas (tabla partes_afectadas)
        $porPartes = DB::table('partes_afectadas')
            ->join('formulario_accidentes', 'partes_afectadas.historial_id', '=', 'formulario_accidentes.id')
            ->when($hotel, fn($q) => $q->where('formulario_accidentes.propiedad_id', $hotel))
            ->when(
                $inicio && $fin,
                fn($q) =>
                $q->whereBetween('formulario_accidentes.fecha_evento', [$inicio, $fin])
            )
            ->when(
                $anio && $anio !== 'Todos',
                fn($q) =>
                $q->whereYear('formulario_accidentes.fecha_evento', $anio)
            )
            ->select('parte_cuerpo as etiqueta', DB::raw('COUNT(*) as valores'))
            ->groupBy('parte_cuerpo')
            ->get();

        return response()->json(compact('porDepto', 'porMes', 'porDias', 'porPartes'));
    }

    /**
     * Exporta las gráficas seleccionadas a PDF.
     */
    public function exportarEstadisticosPDF(Request $request)
    {
        $data = $request->only(['mostrar', 'imgDepartamento', 'imgMes', 'imgDias', 'imgPartes']);

        $pdf = Pdf::loadView('seguridadysalud.estadisticas_export', $data);
        return $pdf->download('estadisticas.pdf');
    }

    /**
     * Exporta las gráficas seleccionadas a Excel usando Laravel‑Excel.
     */
    public function exportarEstadisticosExcel(Request $request)
    {
        // 1) Valida y decodifica
        $data = $request->validate([
            'mostrar'  => 'required|string',
            'porDepto' => 'required|array',
            'porMes'   => 'required|array',
            'porDias'  => 'required|array',
            'porPartes' => 'required|array',
        ]);

        // 2) Reestructura los datos para el Export
        $datos = [];
        foreach (['departamento' => 'porDepto', 'mes' => 'porMes', 'dias' => 'porDias', 'partes' => 'porPartes'] as $key => $field) {
            $datos[$key] = [
                'labels' => array_column($data[$field], 'etiqueta'),
                'values' => array_column($data[$field], 'valores'),
            ];
        }

        // 3) Descarga
        return Excel::download(
            new \App\Exports\EstadisticosExport($data['mostrar'], $datos),
            'estadisticas.xlsx'
        );
    }
}
