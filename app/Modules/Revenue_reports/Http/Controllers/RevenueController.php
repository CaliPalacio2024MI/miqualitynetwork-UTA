<?php

namespace App\Modules\Revenue_reports\Http\Controllers;

use App\Http\Controllers\Controller;

class RevenueController extends Controller{
    public function home()
    {
        return view('modules.revenue_reports.home');
    }
}