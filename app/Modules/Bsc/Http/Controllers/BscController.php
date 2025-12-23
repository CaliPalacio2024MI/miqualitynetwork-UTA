<?php

namespace App\Modules\Bsc\Http\Controllers;

use App\Http\Controllers\Controller;

class BscController extends Controller{
    public function home()
    {
        return view('modules.bsc.home');
    }
}