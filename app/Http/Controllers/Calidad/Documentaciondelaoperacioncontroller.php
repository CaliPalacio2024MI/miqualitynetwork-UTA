<?php

namespace App\Http\Controllers\Calidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Documentaciondelaoperacioncontroller extends Controller
{
    public function documentaciondelaoperacion()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_documentaciondelaoperacion) {
            return view('layouts.dashboard');
        }
        return view('calidad.documentaciondelaoperacion');
    }
}
