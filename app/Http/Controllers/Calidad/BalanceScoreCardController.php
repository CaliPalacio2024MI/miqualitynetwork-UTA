<?php

namespace App\Http\Controllers\Calidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Carpetas;
use Illuminate\Support\Facades\Auth;

class BalanceScoreCardController extends Controller
{
    // Vista principal de la sección "Balance Score Card"
    public function balancescorecard()
    {
        $user = Auth::user();

        // Validar acceso del usuario
        if (!$user->privilegios || !$user->privilegios->acceso_balancescorecard) {
            return view('layouts.dashboard');
        }

        // Obtener carpetas principales accesibles para el usuario
        $carpetas = $user->carpetasAccesibles()
            ->where('subseccion', 'balance_score_card')
            ->whereNull('parent_id') // Solo carpetas principales
            ->get();

        return view('calidad.balancescorecard', compact('carpetas'));
    }

    // Muestra los archivos dentro de una carpeta específica
    public function listarArchivos($carpeta_id)
    {
        $user = Auth::user();

        // Validar acceso del usuario
        if (!$user->privilegios || !$user->privilegios->acceso_balancescorecard) {
            return view('layouts.dashboard');
        }
        //CAMBIOS A VISTA PARA MOSTRA EL DASHBOARD REAL DE BALANCE SCORECARD
        //return view('calidad.balancescorecard');
        return view('modules.bsc.dashboard');
    }
}
