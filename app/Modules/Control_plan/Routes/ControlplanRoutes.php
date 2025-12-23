<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Control_plan\Http\Controllers\ControlplanController;

Route::get('/home', [ControlplanController::class, 'home'])->name('controlplan.home');
Route::get('/print', [ControlplanController::class, 'print'])->name('controlplan.print');
Route::get('/update', [ControlplanController::class, 'listPlan'])->name('controlplan.update');
Route::get('/stats', [ControlplanController::class, 'total'])->name('controlplan.stats');



Route::get('/update/{plan}/details', [ControlplanController::class, 'showDetails']); // Our API endpoint