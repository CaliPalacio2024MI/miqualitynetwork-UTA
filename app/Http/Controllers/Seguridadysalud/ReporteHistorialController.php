<?php

namespace App\Http\Controllers\Seguridadysalud;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FormularioAccidente;
use App\Models\Propiedades;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Exports\ReporteHistorialExport;
use App\Exports\ReporteHistorialExportIndividual;
use Maatwebsite\Excel\Facades\Excel;

class ReporteHistorialController extends Controller
{
    public function index(Request $request)
    {
        $propiedades = Propiedades::all();
        $hotel        = $request->query('hotel', '');
        $fechaInicio  = $request->query('fecha_inicio', '');
        $fechaFin     = $request->query('fecha_fin', '');
        $nombre       = $request->query('nombre', '');

        $query = FormularioAccidente::query();

        if (!empty($hotel)) {
            $query->where('propiedad_id', $hotel);
        }

        if (!empty($fechaInicio)) {
            $query->whereDate('fecha_evento', '>=', $fechaInicio);
        }

        if (!empty($fechaFin)) {
            $query->whereDate('fecha_evento', '<=', $fechaFin);
        }

        $registros = $query
            ->orderBy('fecha_evento', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('seguridadysalud.reporte', compact(
            'propiedades',
            'registros',
            'hotel',
            'fechaInicio',
            'fechaFin',
            'nombre'
        ));
    }

    public function exportPdf(Request $request)
    {
        $hotel        = $request->input('hotel', '');
        $fechaInicio  = $request->input('fecha_inicio', '');
        $fechaFin     = $request->input('fecha_fin', '');
        $nombre       = $request->input('nombre', '');

        $query = FormularioAccidente::query();

        if (!empty($hotel)) {
            $query->where('propiedad_id', $hotel);
        }

        if (!empty($fechaInicio)) {
            $query->whereDate('fecha_evento', '>=', $fechaInicio);
        }

        if (!empty($fechaFin)) {
            $query->whereDate('fecha_evento', '<=', $fechaFin);
        }

        if (!empty($nombre)) {
            $query->where('nombre_lesionado', 'like', "%{$nombre}%");
        }

        $registros = $query->orderBy('fecha_evento', 'desc')->get();

        $propiedad = $hotel
            ? (Propiedades::find($hotel)?->nombre_propiedad ?? '---')
            : 'Todos';

        $pdf = Pdf::loadView('seguridadysalud.reporte_pdf', [
            'registros'    => $registros,
            'propiedad'    => $propiedad,
            'fechaInicio'  => $fechaInicio ?: '—',
            'fechaFin'     => $fechaFin ?: '—',
            'nombre'       => $nombre ?: '—',
        ]);

        $filename = 'reporte_historial_' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }

    public function exportPdfIndividual($id)
{
    $r = FormularioAccidente::findOrFail($id);

    $propiedad = $r->propiedad_id
        ? (Propiedades::find($r->propiedad_id)?->nombre_propiedad ?? '---')
        : '—';

    $registros = collect([$r]);
    $anio      = Carbon::parse($r->fecha_evento)->format('Y');
    $nombre    = $r->nombre_lesionado;


    $pdf = Pdf::loadView('seguridadysalud.reporte_pdf', [
        'registros'    => $registros,
        'propiedad'    => $propiedad,
        'anio'         => $anio,
        'nombre'       => $nombre,
        'fechaInicio'  => Carbon::parse($r->fecha_evento)->format('Y-m-d'),
        'fechaFin'     => Carbon::parse($r->fecha_evento)->format('Y-m-d'),
        'chunkIndex'   => 0,
        'chunks'       => [0], 
    ]);

    $filename = 'historial_' . Str::slug($r->nombre_lesionado) . '_' 
                . now()->format('Ymd_His') . '.pdf';

    return $pdf->download($filename);
}


    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ReporteHistorialExport($request),
            'reporte_accidentes_' . now()->format('Ymd_His') . '.xlsx'
        );
    }

    public function exportExcelIndividual($id)
    {
        $registro = FormularioAccidente::findOrFail($id);
        $export = new ReporteHistorialExportIndividual($registro);
        $filename = 'historial_' . Str::slug($registro->nombre_lesionado) . '_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download($export, $filename);
    }

    public function edit($id)
    {
        $registro    = FormularioAccidente::findOrFail($id);
        $propiedades = Propiedades::all();
        return view('seguridadysalud.reporte_edit', compact('registro','propiedades'));
    }

    public function update(Request $request, $id)
    {
        $registro = FormularioAccidente::findOrFail($id);
        $data = $request->validate([
            'nombre'    => 'required|string|max:255',
            'edad'      => 'required|integer|min:0',
            'direccion' => 'required|string',
            'depto'     => 'required|string',
            'fecha'     => 'required|date',
        ]);

        $registro->nombre_lesionado     = $data['nombre'];
        $registro->edad_lesionado       = $data['edad'];
        $registro->direccion_particular = $data['direccion'];
        $registro->departamento_evento  = $data['depto'];
        $registro->fecha_evento         = $data['fecha'];
        $registro->save();

        return response()->json([
            'nombre'    => $registro->nombre_lesionado,
            'edad'      => $registro->edad_lesionado,
            'direccion' => $registro->direccion_particular,
            'depto'     => $registro->departamento_evento,
            'fecha'     => Carbon::parse($registro->fecha_evento)->format('Y-m-d'),
        ]);
    }

    public function destroy($id)
    {
        FormularioAccidente::findOrFail($id)->delete();

        return redirect()
            ->route('seguridadysalud.reporte')
            ->with('success', 'Registro eliminado correctamente.');
    }
}
