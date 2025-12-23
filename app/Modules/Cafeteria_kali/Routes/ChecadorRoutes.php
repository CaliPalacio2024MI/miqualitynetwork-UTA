<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Cafeteria_kali\Http\Controllers\ChecadorController;

Route::get('/home', [ChecadorController::class, 'home'])->name('checador.home');
