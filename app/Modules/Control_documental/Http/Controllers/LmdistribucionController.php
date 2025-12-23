<?php

namespace App\Modules\Control_documental\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Archivo;
use Illuminate\Http\Request;

class LmdistribucionController extends Controller
{
    public function lmdistribucion()
    {
        $archivos = Archivo::where('visible', 1)->get();
        return view('modules.controldoc.lmdistribucion', compact('archivos'));
    }
}
