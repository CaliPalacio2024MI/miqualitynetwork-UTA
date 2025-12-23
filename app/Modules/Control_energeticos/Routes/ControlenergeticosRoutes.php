<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Control_energeticos\Http\Controllers\ControlenergeticosController;

Route::get('/home', [ControlenergeticosController::class, 'home'])->name('controlenergeticos.home');

Route::prefix('admin-energeticos')->group(function () {
Route::get('/', [ControlenergeticosController::class, 'adminEnergeticos'])->name('controlenergeticos.admin_energeticos');
Route::get('/energeticos', [ControlenergeticosController::class, 'energeticos'])->name('controlenergeticos.energeticos');
});


