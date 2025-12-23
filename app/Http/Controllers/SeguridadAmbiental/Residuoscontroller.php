<?php

namespace App\Http\Controllers\SeguridadAmbiental;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Residuoscontroller extends Controller
{
    public function residuos()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_residuos) {

            return view('layouts.dashboard');
        }
        return view('seguridadambiental.residuos');
    }
}
