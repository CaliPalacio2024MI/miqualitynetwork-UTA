<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Propiedades;
use Illuminate\Support\Facades\Auth;

class vistaPropiedadesController extends Controller
{
    // ESTE CONTROLADOR REGRESA LA VISTA DE propiedades.blade que muestra  
    // los formularios para crear y borrar propiedades
    public function configurar()
    {
        // Se obtiene el usuario que inició sesión
        $user = Auth::user();

        // Si no tiene permisos para administrar usuarios, se manda al dashboard con un mensaje
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        }

        // Se consultan todas las propiedades, pero solo se seleccionan los campos necesarios
        $datos = Propiedades::get(['id_propiedad', 'nombre_propiedad']);

        // Se carga la vista 'propiedades.blade.php' con los datos obtenidos
        return view('administracion.propiedades', compact('datos'));
    }

    /**
     * Devuelve todas las propiedades (áreas) en JSON para la API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiIndex()
    {
        return response()->json(Propiedades::all());
    }
}
