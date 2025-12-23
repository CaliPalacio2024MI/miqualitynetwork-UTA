<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Carpetas;
use Illuminate\Support\Facades\Auth;

class AdminCarpetasController extends Controller
{
    //ESTE CONTROLADOR REGRESA LA VISTA DE LAS DE ADMINISTRACION  PARA CREAR Y BORRAR CARPETAS LLAMADO index
    public function administrarCarpeta($seccion, $carpeta_id)
    {
        // Se obtiene el usuario que inició sesión
        $user = Auth::user();

        // Si el usuario no tiene permisos para administrar usuarios, se manda al dashboard con un mensaje
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        }

        // Se busca la carpeta que se quiere administrar, según el ID y la sección
        $carpeta = Carpetas::where('id', $carpeta_id)->where('seccion', $seccion)->firstOrFail();

        // Obtener la carpeta principal (si existe)
        $carpetaPrincipal = $carpeta->parent_id ? Carpetas::find($carpeta->parent_id) : null;

        // Se revisa si se está filtrando por estado (visible u oculto)
        $estado = request('estado');

        // Se arma la consulta base para los archivos de esa carpeta
        $archivosQuery = Archivo::where('carpeta_id', $carpeta_id);

        // Si se pidió solo ver los visibles
        if ($estado === 'visible') {
            $archivosQuery->where('visible', true);
        }
        // Si se pidió solo ver los ocultos
        elseif ($estado === 'oculto') {
            $archivosQuery->where('visible', false);
        }

        // Se obtienen los archivos según los filtros aplicados
        $archivos = $archivosQuery->get();

        // Se buscan las subcarpetas que cuelgan de esta carpeta
        $subcarpetas = Carpetas::where('parent_id', $carpeta_id)->get();

        // Se manda todo a la vista para mostrarlo
        return view('archivos.gestion_carpeta', compact('carpeta', 'archivos', 'subcarpetas', 'seccion', 'carpetaPrincipal'));
    }
}
