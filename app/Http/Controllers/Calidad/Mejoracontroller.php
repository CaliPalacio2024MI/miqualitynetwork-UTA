<?php

namespace App\Http\Controllers\Calidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Mejoracontroller extends Controller
{
    public function mejora()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_mejora) {
            return view('layouts.dashboard');
        }
        return view('calidad.mejora');
    }
}
