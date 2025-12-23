<?php

namespace App\Modules\Residuos\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResiduosController extends Controller{
    public function home()
    {
        return view('modules.residuos.home');
    }

    public function adminResiduos()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('modules.residuos.administracion.admin_residuos');
    }

    public function residuos()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('modules.residuos.administracion.residuos');
    }

    public function areas()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('modules.residuos.administracion.areas');
    }
}