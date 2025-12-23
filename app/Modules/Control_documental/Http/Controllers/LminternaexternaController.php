<?php

namespace App\Modules\Control_documental\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivo;

class LminternaexternaController extends Controller
{
    public function index()
    {
        // Obtener solo los registros donde visible = 1
        $archivos = Archivo::where('visible', 1)->get();

        // Pasar los datos filtrados a la vista
        return view('modules.controldoc.lminternaexterna', compact('archivos'));
    }

    public function lminternaexterna()
    {
        // Obtén los datos de la tabla 'archivos'
        $archivos = Archivo::where('visible', 1)->get();

        // Retorna la vista con los datos
        return view('modules.controldoc.lminternaexterna', compact('archivos'));
    }
}
