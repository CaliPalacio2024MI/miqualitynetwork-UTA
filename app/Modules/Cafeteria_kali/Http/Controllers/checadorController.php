<?php

namespace App\Modules\Cafeteria_kali\Http\Controllers;

use App\Http\Controllers\Controller;

class ChecadorController extends Controller{
    public function home()
    {
        return view('modules.checador.home');
    }
}