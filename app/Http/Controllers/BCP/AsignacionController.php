<?php

namespace App\Http\Controllers\BCP;

use App\Http\Controllers\Controller;

use App\Models\BCP\Catalogo;
use App\Models\BCP\Asignada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AsignacionController extends Controller
{

    public function buscarHabitaciones($seccion)
    {
        $hoy = Carbon::now()->toDateString();

        $habitaciones = Catalogo::where('catalogo.Secciones', $seccion)
            ->leftJoin('llegadas as l1', function ($join) use ($hoy) {
                $join->on('catalogo.N_Hab', '=', 'l1.NHab')
                    ->whereDate('l1.FechaLlegada', '<=', $hoy)
                    ->whereDate('l1.FechaSal', '>=', $hoy);
            })
            ->select([
                'catalogo.N_Hab',
                'catalogo.Tp_Hab',
                'catalogo.Piso',
                'catalogo.Status',
                'l1.Tpo',
                'l1.Nombre',
                'l1.NHab',
                'l1.Valor_A',
                DB::raw("
    CASE 
        WHEN l1.Nombre IS NULL OR TRIM(l1.Nombre) = '' 
        THEN '' 
        ELSE COALESCE(l1.Valor_N,0) + COALESCE(l1.Valor_J,0) + COALESCE(l1.Valor_MG,0) + COALESCE(l1.Valor_I,0) 
    END as MontoMN
"),
                DB::raw("CASE 
                WHEN l1.FechaSal = '$hoy' AND EXISTS (
                    SELECT 1 FROM llegadas l2 
                    WHERE l2.NHab = catalogo.N_Hab 
                    AND l2.FechaLlegada > '$hoy'
                ) THEN 'Pre'
                WHEN l1.FechaSal = '$hoy' THEN 'Sal'
                ELSE ''
            END as Sal_Pre"),
                DB::raw("CASE 
                WHEN l1.FechaSal = '$hoy' THEN catalogo.Cred_Salida 
                ELSE catalogo.Cred_Pasaje 
            END as Credito")
            ])
            ->orderBy('catalogo.N_Hab', 'asc')
            ->get();

        return response()->json($habitaciones);
    }


    public function guardar(Request $request)
    {
        $camarista = $request->input('buscar-camarista');
        $fecha = Carbon::now()->format('Y-m-d');
        $hora = Carbon::now()->format('H:i:s');

        // Eliminar registros anteriores de esta camarista hoy
        DB::table('asignadas')
            ->where('camarista', $camarista)
            ->whereDate('fecha', $fecha)
            ->delete();

        $salPreArr = $request->input('Sal_Pre', []);
        $nHabArr = $request->input('N_Hab', []);
        $tpHabArr = $request->input('Tp_Hab', []);
        $pisoArr = $request->input('Piso', []);
        $statusArr = $request->input('Status', []);
        $tpoArr = $request->input('Tpo', []);
        $adArr = $request->input('AD', []);
        $mnArr = $request->input('MN', []);
        $credsArr = $request->input('Creds', []);
        $titularArr = $request->input('Titular', []);

        $count = count($nHabArr);

        for ($i = 0; $i < $count; $i++) {
            $nHab = $nHabArr[$i] ?? null;

            // Validar si ya está asignada a otra camarista
            $yaAsignada = DB::table('asignadas')
                ->where('N_Hab', $nHab)
                ->whereDate('fecha', $fecha)
                ->where('camarista', '!=', $camarista)
                ->exists();

            if ($yaAsignada) {
                return redirect()->back()->with('error', "La habitación {$nHab} ya está asignada a otra camarista.");
            }

            Asignada::create([
                'Sal_Pre' => $salPreArr[$i] ?? null,
                'N_Hab' => $nHab,
                'Tp_Hab' => $tpHabArr[$i] ?? null,
                'Piso' => $pisoArr[$i] ?? null,
                'Status' => $statusArr[$i] ?? null,
                'Tpo' => $tpoArr[$i] ?? null,
                'AD' => $adArr[$i] ?? null,
                'MN' => $mnArr[$i] ?? null,
                'Creds' => $credsArr[$i] ?? null,
                'Titular' => $titularArr[$i] ?? null,
                'Camarista' => $camarista,
                'Fecha' => $fecha,
                'Hora' => $hora,
            ]);
        }

        return redirect()->back()->with('success', 'Asignaciones guardadas correctamente');
    }


    public function asignadasHoy($camarista)
    {
        if (!$camarista) {
            return response()->json([]);
        }

        $hoy = Carbon::today()->toDateString();

        $habitaciones = DB::table('asignadas')
            ->whereRaw('LOWER(camarista) = ?', [strtolower($camarista)])
            ->whereDate('fecha', $hoy)
            ->get();

        return response()->json($habitaciones);
    }

    //Exportar
    public function exportarHoy($camarista)
    {
        $hoy = Carbon::today()->toDateString();

        $habitaciones = DB::table('asignadas')
            ->where('Camarista', $camarista)
            ->whereDate('Fecha', $hoy)
            ->get();

        $sumaCreds = $habitaciones->sum('Creds');

        $html = "<h2>Asignaciones de: $camarista</h2>";
        $html .= "<p>Fecha: $hoy</p>";
        $html .= "<table border='1' cellpadding='5' cellspacing='0'>
            <thead>
                <tr>
                    <th>Sal/Pre</th>
                    <th>Habitación</th>
                    <th>Tipo</th>
                    <th>Piso</th>
                    <th>Status</th>
                    <th>Tpo</th>
                    <th>AD</th>
                    <th>MN</th>
                    <th>Créditos</th>
                    <th>Titular</th>
                </tr>
            </thead>
            <tbody>";

        foreach ($habitaciones as $h) {
            $html .= "<tr>
                <td>{$h->Sal_Pre}</td>
                <td>{$h->N_Hab}</td>
                <td>{$h->Tp_Hab}</td>
                <td>{$h->Piso}</td>
                <td>{$h->Status}</td>
                <td>{$h->Tpo}</td>
                <td>{$h->AD}</td>
                <td>{$h->MN}</td>
                <td>{$h->Creds}</td>
                <td>{$h->Titular}</td>
              </tr>";
        }

        $html .= "</tbody></table>";
        $html .= "<h3>Total Créditos: $sumaCreds</h3>";

        return response($html);
    }
}
