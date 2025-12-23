<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Revenue_reports\Http\Controllers\RevenueController;


Route::get('/home', [RevenueController::class, 'home'])->name('revenue_reports.home');
