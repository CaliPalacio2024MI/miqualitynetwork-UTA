<?php

namespace App\Http\Controllers\SeguridadAmbiental;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Energiacontroller extends Controller
{
    public function energia()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_energia) {

            return view('layouts.dashboard');
        }
        return view('seguridadambiental.energia');
    }
}
