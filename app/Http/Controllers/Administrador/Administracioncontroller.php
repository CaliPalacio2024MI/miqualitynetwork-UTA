<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Administracioncontroller extends Controller
{
//ESTE CONTROLADOR LLAMA ALA VISTA usuario.blade QUE MUESTRA LOS 4 PRINCIPALES BOTONES DE ADMINISTRACION QUE ENVIAN a las secciones de administrar usuarios,propiedades, archivos y procesos

    public function administracion()
    {
        // Se obtiene el usuario que inició sesión
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, se redirige al dashboard con un mensaje de advertencia
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {

            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        }

        // Si tiene permisos, se carga la vista principal de administración
        return view('administracion.usuario');

    }

    public function administrarUsuarios()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('administracion.usuario');
    }

     public function administrarDepartamentos()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('administracion.departamentos.index');
    }

     public function administrarPuestos()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, simplemente se regresa al dashboard
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        // Si tiene permisos, se muestra la vista de administración de usuarios
        return view('administracion.puestos.index');
    }

}
