<?php

namespace App\Modules\Historial_clinico\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistorialclinicoController extends Controller{
    public function home()
    {
        return view('modules.historialclinico.home');
    }
    public function adminHistorial()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('modules.historialclinico.administracion.admin_historial');
    }

    public function agentes()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('modules.historialclinico.administracion.agentes');
    }
}