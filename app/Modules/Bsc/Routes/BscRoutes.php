<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Bsc\Http\Controllers\BscController;
use App\Modules\Bsc\Http\Controllers\AdminAuthController;
use App\Modules\Bsc\Http\Controllers\DashboardController;
use App\Modules\Bsc\Http\Middleware\AdminMiddleware;
use App\Modules\Bsc\Http\Middleware\CustomMiddleware;
use App\Modules\Bsc\Http\Controllers\CustomUserController;
use App\Modules\Bsc\Http\Controllers\CustomuserAuth;
use App\Modules\Bsc\Http\Controllers\ConsumeApi;
use App\Modules\Bsc\Http\Controllers\ObjetivoController;
use App\Modules\Bsc\Http\Controllers\PropiedadController;
use App\Modules\Bsc\Http\Controllers\processController;
use App\Modules\Bsc\Http\Controllers\ProcesoController;
use App\Modules\Bsc\Http\Controllers\SubprocessController;
use App\Modules\Bsc\Http\Controllers\IndicatorController;



// Ruta principal
Route::get('/', function () {
    return view('modules.bsc.procesos.index');
});

 //rutas de propiedades 
Route::get('/propiedades', [PropiedadController::class, 'index'])->name('propiedades.panel');

 Route::post('/objetivos/test-api', [ObjetivoController::class, 'testApiConnection'])->name('objetivos.test-api');

 Route::prefix('customuser')->group(function() {
    Route::get('/', [CustomuserController::class, 'index'])->name('customuser.index');
    
 });

Route::prefix('processes')->group(function() {
    // Rutas estándar CRUD
    Route::get('/', [processController::class, 'index'])->name('processes.index');
    Route::get('/create', [processController::class, 'create'])->name('processes.create');
    Route::post('/', [processController::class, 'store'])->name('processes.store');
    Route::get('/{process}', [processController::class, 'show'])->name('processes.show');
    Route::get('/{process}/edit', [processController::class, 'edit'])->name('processes.edit');
    Route::put('/{process}', [processController::class, 'update'])->name('processes.update');
    Route::delete('/{process}', [processController::class, 'destroy'])->name('processes.destroy');
     
    // Rutas específicas para AJAX/JSON
    Route::get('/{process}/edit/json', [processController::class, 'editJson'])->name('processes.edit.json');
    
    // Rutas para subprocesos
    Route::post('/{process}/subprocesses', [processController::class, 'storeSubprocess'])->name('processes.subprocesses.store');
    
    // Rutas para indicadores
    Route::get('/indicators/{indicator}/data', [processController::class, 'showIndicatorData'])
         ->name('processes.indicators.data');
    Route::get('/indicators/get-template', [processController::class, 'getIndicatorTemplate'])
         ->name('processes.indicators.get-template');
       
    //ruta para realizar fetch a la api
    Route::get('/fetch-api-data', [processController::class, 'fetchApiData'])->name('processes.fetch-api-data');
});

//rutas para subprocesos
Route::prefix('subprocesses')->group(function() {
    Route::get('/{subprocess}/edit',[SubprocessController::class, 'edit'])->name('subprocesses.edit');
    Route::post('/', [SubprocessController::class,'store'])->name('subprocesses.store');
    Route::put('/{subprocess}', [SubprocessController::class,'update'])->name('subprocesses.update');
    Route::delete('/{subprocess}', [SubprocessController::class,'destroy'])->name('subprocesses.destroy');
});

//rutas para indicadores
Route::prefix('indicators')->group(function() {
    Route::get('/{indicator}/edit', [IndicatorController::class, 'edit'])->name('indicators.edit');
    Route::post('/', [IndicatorController::class, 'store'])->name('indicators.store');
    Route::put('/{indicator}', [IndicatorController::class, 'update'])->name('indicators.update');
    Route::delete('/{indicator}', [IndicatorController::class, 'destroy'])->name('indicators.destroy');
});
//ruta principal del dashboard prueba 
Route::get('/home', [BscController::class, 'home'])->name('bsc.home');

Route::get('/propiedades/{id}/processes', [PropiedadController::class, 'getProcesses'])->name('propiedades.processes');