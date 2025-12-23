<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Control_documental\Http\Controllers\ControldocumentalController;
use App\Modules\Control_documental\Http\Controllers\Lmdistribucioncontroller;
use App\Modules\Control_documental\Http\Controllers\Lminternaexternacontroller;
use App\Modules\Control_documental\Http\Controllers\Lmcontrolcambioscontroller;
use App\Modules\Control_documental\Http\Controllers\Lmeliminadacontroller;

Route::get('/control-documental', [ControldocumentalController::class, 'controldocumental'])->name('controldoc.controldocumental');
Route::get('/lmdistribucion', [LmdistribucionController::class, 'lmdistribucion'])->name('controldoc.lmdistribucion');
Route::get('/lminternaexterna', [LminternaexternaController::class, 'lminternaexterna'])->name('controldoc.lminternaexterna');
Route::get('/lmcontrolcambios', [LmcontrolcambiosController::class, 'lmcontrolcambios'])->name('controldoc.lmcontrolcambios');
Route::get('/lmeliminada', [LmeliminadaController::class, 'lmeliminada'])->name('controldoc.lmeliminada');
Route::get('/control-documental/carpeta/{carpeta_id}', [ControldocumentalController::class, 'verCarpeta'])->name('controldocumental.carpetas');
