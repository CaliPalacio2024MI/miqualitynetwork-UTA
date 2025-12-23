<?php

namespace App\Http\Controllers\SeguridadAlimentaria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Medicioncontroller extends Controller
{
    public function medicion()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_medicion) {

            return view('layouts.dashboard');
        }
        return view('seguridadalimentaria.medicion');
    }
}
