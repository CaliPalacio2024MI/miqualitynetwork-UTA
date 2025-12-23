<?php

namespace App\Http\Controllers\SeguridadAmbiental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Carpetas;
use Illuminate\Support\Facades\Auth;

class Controlderesiduoscontroller extends Controller
{
    // Vista principal de la sección "Control de Residuos"
    public function controlderesiduos()
{
    $user = Auth::user();

    if (!$user->privilegios || !$user->privilegios->acceso_controlderesiduos) {
        return view('layouts.dashboard');
    }

    // Redirigir directamente a entradas
    return redirect()->route('entradas.index');
}
}
