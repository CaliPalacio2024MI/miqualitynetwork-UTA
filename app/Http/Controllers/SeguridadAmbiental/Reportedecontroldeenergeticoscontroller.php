<?php

namespace App\Http\Controllers\SeguridadAmbiental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Consumo;
use App\Core\Models\Propiedades;
use App\Core\Models\Energetico;

class Reportedecontroldeenergeticoscontroller extends Controller
{
    public function reportedecontroldeenergeticos(Request $request)
    {
        // Configuración básica
        $fechaMesAnterior = Carbon::now()->subMonth();
        $mesAnterior = $fechaMesAnterior->month;
        $anioMesAnterior = $fechaMesAnterior->year;

        // Obtener datos
        $propiedades = Propiedades::select('id_propiedad', 'nombre_propiedad')->get();
        $energeticos = Energetico::all()->keyBy('id');

        // Consulta de consumos
        $query = Consumo::with(['propiedad', 'energetico'])
            ->when($request->filled('propiedad_id'), fn($q) => $q->where('propiedad_id', $request->propiedad_id))
            ->when($request->filled('energetico_id'), fn($q) => $q->where('energetico_id', $request->energetico_id))
            ->when($request->filled('mes'), 
                fn($q) => $q->whereMonth('fecha', $request->mes),
                fn($q) => $q->whereMonth('fecha', $mesAnterior))
            ->when($request->filled('anio'), 
                fn($q) => $q->whereYear('fecha', $request->anio),
                fn($q) => $q->whereYear('fecha', $anioMesAnterior))
            ->orderBy('fecha', 'desc');

        $consumos = $query->get();
        $usandoFiltros = $request->anyFilled(['mes', 'anio', 'propiedad_id', 'energetico_id']);

        // Preparar datos para el gráfico (VERSIÓN GARANTIZADA)
        $chartData = [];
        $energeticosConConsumo = $energeticos->filter(function($energetico) use ($consumos) {
        return $consumos->where('energetico_id', $energetico->id)->sum('cantidad_utilizada') > 0;
    });

    $labels = [];
    $values = [];
    $backgroundColors = [];

    foreach ($energeticosConConsumo as $energetico) {
        $totalConsumo = $consumos->where('energetico_id', $energetico->id)
                               ->sum('cantidad_utilizada');
        
        $labels[] = $energetico->nombre;
        $values[] = $totalConsumo;
        $backgroundColors[] = $energetico->color ?? $this->getDefaultColor($energetico->id);
    }

    // Si no hay datos pero sí consumos, forzar datos
    

    return view('seguridadambiental.reportedecontroldeenergeticos', [
         'propiedades' => $propiedades, // Asegúrate de incluir esto
        'energeticos' => $energeticos,
        'consumos' => $consumos,
        'labels' => $labels,
        'values' => $values,
        'backgroundColors' => $backgroundColors,
        'costoTotal' => $consumos->sum('costo'),
            'chartData' => $chartData, // Enviamos todos los datos juntos
            'usandoFiltros' => $usandoFiltros,
            'mesAnterior' => $mesAnterior,
            'anioMesAnterior' => $anioMesAnterior
        ]);
    }

    private function getDefaultColor($id)
    {
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];
        return $colors[$id % count($colors)];
    }
    public function generarPDF(Request $request)
{
    // Obtener los mismos filtros que en el reporte principal
    $fechaMesAnterior = Carbon::now()->subMonth();
    $mesAnterior = $fechaMesAnterior->month;
    $anioMesAnterior = $fechaMesAnterior->year;

    $consumos = Consumo::with(['propiedad', 'energetico'])
        ->when($request->filled('propiedad_id'), fn($q) => $q->where('propiedad_id', $request->propiedad_id))
        ->when($request->filled('energetico_id'), fn($q) => $q->where('energetico_id', $request->energetico_id))
        ->when($request->filled('mes'), 
            fn($q) => $q->whereMonth('fecha', $request->mes),
            fn($q) => $q->whereMonth('fecha', $mesAnterior))
        ->when($request->filled('anio'), 
            fn($q) => $q->whereYear('fecha', $request->anio),
            fn($q) => $q->whereYear('fecha', $anioMesAnterior))
        ->orderBy('fecha', 'desc')
        ->get();

    $costoTotal = $consumos->sum('costo');
}
}