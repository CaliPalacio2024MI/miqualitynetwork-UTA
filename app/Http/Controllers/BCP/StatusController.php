<?php

namespace App\Http\Controllers\BCP;

use Illuminate\Support\Facades\DB;
use App\Models\BCP\Asignada;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{

    public function obtenerAsignaciones()
    {
        $hoy = date('Y-m-d');

        $asignaciones = Asignada::select(
            'Camarista as nombre',
            DB::raw('SUM(Creds) as cred_total'),
            DB::raw("SUM(CASE WHEN Status IN ('PICK', 'OCUS') THEN Creds ELSE 0 END) as cred_comp"),
            DB::raw("SUM(Creds) - SUM(CASE WHEN Status IN ('PICK', 'OCUS') THEN Creds ELSE 0 END) as cred_pend")
        )
            ->whereDate('Fecha', $hoy)
            ->groupBy('Camarista')
            ->get();

        return response()->json($asignaciones);
    }

    public function detalleAsignaciones($camarista)
    {
        $hoy = date('Y-m-d');

        $detalles = Asignada::where('Camarista', $camarista)
            ->whereDate('Fecha', $hoy)
            ->get();

        return response()->json($detalles);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'n_hab' => 'required|string',
            'fecha' => 'required|date',
            'nuevo_status' => 'required|string',
        ]);

        $actualizacionAsignadas = DB::table('asignadas')
            ->where('N_Hab', $request->n_hab)
            ->where('Fecha', $request->fecha)
            ->update(['Status' => $request->nuevo_status]);

        // Actualizar también en tabla catalogo
        $actualizacionCatalogo = DB::table('catalogo')
            ->where('N_Hab', $request->n_hab)
            ->update(['Status' => $request->nuevo_status]);

        if ($actualizacionAsignadas || $actualizacionCatalogo) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No se actualizó ningún registro.']);
        }
    }
}
