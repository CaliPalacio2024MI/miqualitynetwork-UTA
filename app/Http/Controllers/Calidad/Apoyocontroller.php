<?php

namespace App\Http\Controllers\Calidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Apoyocontroller extends Controller
{
    public function apoyo()
    {
        $user = Auth::user();


        if (!$user->privilegios || !$user->privilegios->acceso_apoyo) {
            return view('layouts.dashboard');
        }

        return view('calidad.apoyo');
    }
}
