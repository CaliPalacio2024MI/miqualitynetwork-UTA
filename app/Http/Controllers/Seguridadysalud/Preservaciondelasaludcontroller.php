<?php

namespace App\Http\Controllers\Seguridadysalud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Preservaciondelasaludcontroller extends Controller
{
    public function preservaciondelasalud()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_perservaciondelasalud) {

            return view('layouts.dashboard');
        }
        return view('seguridadysalud.preservaciondelasalud');
    }
}
