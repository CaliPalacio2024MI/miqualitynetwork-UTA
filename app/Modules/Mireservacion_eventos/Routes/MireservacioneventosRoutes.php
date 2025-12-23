<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Mireservacion_eventos\Http\Controllers\MireservacioneventosController;

Route::get('/home', [MireservacioneventosController::class, 'home'])->name('mire.home');
Route::get('/admin-eventos', [MireservacioneventosController::class, 'adminEventos'])->name('mire.administracion.admin_eventos');
Route::get('/eventos', [MireservacioneventosController::class, 'eventos'])->name('mire.administracion.eventos');