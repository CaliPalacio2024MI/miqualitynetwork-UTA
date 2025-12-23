<?php

namespace App\Modules\Control_documental\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Archivo;

class LmcontrolcambiosController extends Controller
{
    public function lmcontrolcambios()
    {
        // Obtener los archivos con los datos necesarios
        $archivos = Archivo::where('se_ha_hecho_cambio', 1)->get();

        // Pasar los datos a la vista
        return view('modules.controldoc.lmcontrolcambios', compact('archivos'));
    }
}
