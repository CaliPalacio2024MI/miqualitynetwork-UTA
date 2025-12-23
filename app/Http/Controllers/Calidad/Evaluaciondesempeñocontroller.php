<?php

namespace App\Http\Controllers\Calidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Evaluaciondesempeñocontroller extends Controller
{
    public function evaldesempeño()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_evaldesempeño) {
            return view('layouts.dashboard');
        }
        return view('calidad.evaldesempeño');
    }
}
