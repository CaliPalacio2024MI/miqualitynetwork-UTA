<?php

namespace App\Modules\Control_documental\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Archivo;

class LmeliminadaController extends Controller
{
    public function lmeliminada()
    {
        // Obtener los archivos eliminados (visible = 0)
        $archivos = Archivo::where('visible', 0)->get();

        // Pasar los datos a la vista
        return view('modules.controldoc.lmeliminada', compact('archivos'));
    }
}
