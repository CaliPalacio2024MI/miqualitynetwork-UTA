<?php

namespace App\Http\Controllers\Seguridaddelainformacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Carpetas;
use Illuminate\Support\Facades\Auth;

class Riesgotecnologicocontroller extends Controller
{
    // Vista principal de la sección "Riesgo Tecnológico"
    public function riesgotecnologico()
    {
        $user = Auth::user();

        // Validar acceso del usuario
        if (!$user->privilegios || !$user->privilegios->acceso_riesgotecnologico) {
            return view('layouts.dashboard');
        }

        // Obtener carpetas principales accesibles para el usuario
        $carpetas = $user->carpetasAccesibles()
            ->where('subseccion', 'riesgo_tecnologico')
            ->whereNull('parent_id') // Solo carpetas principales
            ->get();

        return view('seguridaddelainformacion.riesgotecnologico', compact('carpetas'));
    }

    // Muestra los archivos dentro de una carpeta específica
    public function listarArchivos($carpeta_id)
    {
        $user = Auth::user();

        // Validar acceso del usuario
        if (!$user->privilegios || !$user->privilegios->acceso_riesgotecnologico) {
            return view('layouts.dashboard');
        }

        // Verificar si el usuario tiene acceso a la carpeta
        if (!$user->carpetasAccesibles->contains($carpeta_id)) {
            abort(403, 'No tienes permiso para acceder a esta carpeta.');
        }

        // Obtener la carpeta y sus archivos
        $carpeta = Carpetas::where('id', $carpeta_id)
            ->where('subseccion', 'riesgo_tecnologico')
            ->firstOrFail();

        $archivos = Archivo::where('carpeta_id', $carpeta_id)->get();

        return view('seguridaddelainformacion.riesgotecnologico', compact('carpeta', 'archivos'));
    }

    // Vista para ver contenido de una carpeta específica con control de acceso
    public function verCarpeta($carpeta_id)
    {
        $user = Auth::user();

        // Validar acceso del usuario
        if (!$user->privilegios || !$user->privilegios->acceso_riesgotecnologico) {
            return view('layouts.dashboard');
        }

        // Verificar si el usuario tiene acceso a la carpeta
        if (!$user->carpetasAccesibles->contains($carpeta_id)) {
            abort(403, 'No tienes permiso para acceder a esta carpeta.');
        }

        // Obtener la carpeta seleccionada
        $carpeta = Carpetas::findOrFail($carpeta_id);

        // Obtener subcarpetas accesibles
        $subcarpetas = $user->carpetasAccesibles()
            ->where('parent_id', $carpeta_id)
            ->get();

        // Obtener archivos dentro de la carpeta
        $archivos = Archivo::where('carpeta_id', $carpeta_id)->get();

        return view('archivos.vercarpeta', compact('carpeta', 'subcarpetas', 'archivos'));
    }
}
