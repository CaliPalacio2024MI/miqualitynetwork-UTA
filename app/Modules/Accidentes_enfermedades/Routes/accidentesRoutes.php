<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Accidentes_enfermedades\Http\Controllers\accidentesController;

Route::get('/home', [accidentesController::class, 'home'])->name('accidentes.home');
