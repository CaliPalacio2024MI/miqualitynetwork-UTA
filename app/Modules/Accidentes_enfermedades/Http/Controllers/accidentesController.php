<?php

namespace App\Modules\Accidentes_enfermedades\Http\Controllers;

use App\Http\Controllers\Controller;

class accidentesController extends Controller{
    public function home()
    {
        return view('modules.accidentes_enfermedades.home');
    }
}