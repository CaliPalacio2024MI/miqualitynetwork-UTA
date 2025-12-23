<?php

namespace App\Http\Controllers\BCP;

use Illuminate\Http\Request;
use App\Models\BCP\Creditos;
use App\Http\Controllers\Controller;

class CreditosController extends Controller
{
    public function index()
    {
        // Un único registro de créditos (id_creditos = 1)
        $creditos = Creditos::find(1);
        return view('seguridaddelainformacion.bcp.creditos', compact('creditos'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'Creditos' => 'required|integer|min:0',
        ]);

        $creditos = Creditos::find(1);
        if ($creditos) {
            $creditos->creditos = $request->input('Creditos');
            $creditos->save();
            return redirect()->back()->with('success', 'Créditos actualizados correctamente.');
        }

        return redirect()->back()->with('error', 'No se encontró el registro de créditos.');
    }
}
