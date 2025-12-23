<?php

namespace App\Modules\mireservacion_eventos\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MireservacioneventosController extends Controller{
    public function home()
    {
        return view('modules.mire.home');
    }

    public function adminEventos()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('modules.mire.administracion.admin_eventos');
    }

    public function eventos()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('modules.mire.administracion.eventos');
    }
}