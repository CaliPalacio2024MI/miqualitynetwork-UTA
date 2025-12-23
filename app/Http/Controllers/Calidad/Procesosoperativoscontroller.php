<?php
namespace App\Http\Controllers\Calidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Carpetas;
use Illuminate\Support\Facades\Auth;

class Procesosoperativoscontroller extends Controller
{
    
    public function procesosoperativos()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_procesosoperativos) {
            return view('layouts.dashboard');
        }

        // Obtener las carpetas accesibles para el usuario
        $carpetas = $user->carpetasAccesibles()
            ->where('subseccion', 'procesos_operativos')
            ->whereNull('parent_id') // Solo carpetas principales
            ->get();

        return view('calidad.procesosoperativos', compact('carpetas'));
    }

    

    public function listarArchivos($carpeta_id)
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_procesosoperativos) {
            return view('layouts.dashboard');
        }

        // Verificar si el usuario tiene acceso a la carpeta
        if (!$user->carpetasAccesibles->contains($carpeta_id)) {
            abort(403, 'No tienes permiso para acceder a esta carpeta.');
        }

        // Obtener la carpeta específica dentro de Procesos Operativos
        $carpeta = Carpetas::where('id', $carpeta_id)
            ->where('subseccion', 'procesos_operativos')
            ->firstOrFail();

        // Obtener los archivos de la carpeta
        $archivos = Archivo::where('carpeta_id', $carpeta_id)->get();

        return view('calidad.procesosoperativos', compact('carpeta', 'archivos'));
    }

    public function verCarpeta($carpeta_id)
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_procesosoperativos) {
            return view('layouts.dashboard');
        }

        // Verificar si el usuario tiene acceso a la carpeta
        if (!$user->carpetasAccesibles->contains($carpeta_id)) {
            abort(403, 'No tienes permiso para acceder a esta carpeta.');
        }

        // Obtener la carpeta seleccionada
        $carpeta = Carpetas::findOrFail($carpeta_id);

        // Obtener subcarpetas dentro de la carpeta, limitadas a las accesibles
        $subcarpetas = $user->carpetasAccesibles()
            ->where('parent_id', $carpeta_id)
            ->get();

        // Obtener archivos dentro de la carpeta
        $archivos = Archivo::where('carpeta_id', $carpeta_id)->get();

        return view('archivos.vercarpeta', compact('carpeta', 'subcarpetas', 'archivos'));
    }

}
