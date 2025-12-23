<?php

namespace App\Modules\Bcp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RackController extends Controller{
    public function home()
    {
        return view('modules.bcp.rackhabitaciones');
    }

    public function adminRacks()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar racks, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de racks
        return view('modules.bcp.administracion.admin_racks');
    }

    public function adminCentrosConsumo()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar centros de consumo, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de centros de consumo
        return view('modules.bcp.administracion.centros_consumo');
    }
    public function adminCatalogo()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar el catálogo, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración del catálogo
        return view('modules.bcp.administracion.catalogo');
    }
    public function adminTiposStatus()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar tipos de status, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de tipos de status
        return view('modules.bcp.administracion.tipos_status');
    }
}