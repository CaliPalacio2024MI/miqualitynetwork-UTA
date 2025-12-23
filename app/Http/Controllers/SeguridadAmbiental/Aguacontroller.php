<?php

namespace App\Http\Controllers\SeguridadAmbiental;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Aguacontroller extends Controller
{
    public function agua()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_agua) {

            return view('layouts.dashboard');
        }
        return view('seguridadambiental.agua');
    }
}
