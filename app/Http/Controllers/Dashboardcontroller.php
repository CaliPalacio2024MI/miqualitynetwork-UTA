<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    //ESTA VISTA RETORNA LA VISTA DE dashboard LA CUAL CONTIENE EL CONTENIDO DE BIENVIDA AL USUARIO
    public function index()
    {
        $mensaje=0;
        return view('layouts.dashboard',compact('mensaje'));
    }

}
