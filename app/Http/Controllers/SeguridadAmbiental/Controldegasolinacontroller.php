<?php

namespace App\Http\Controllers\SeguridadAmbiental;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controldegasolinacontroller extends Controller
{
    public function controldegasolina()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_aire) {

            return view('layouts.dashboard');
        }
        return view('seguridadambiental.controldegasolina');
    }
}
