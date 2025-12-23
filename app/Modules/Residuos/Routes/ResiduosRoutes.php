<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Residuos\Http\Controllers\ConfiguracionController;
use App\Modules\Residuos\Http\Controllers\EntradaController;
use App\Modules\Residuos\Http\Controllers\SalidaController;
use App\Modules\Residuos\Http\Controllers\CompraController;
use App\Modules\Residuos\Http\Controllers\PoblacionController;
use App\Modules\Residuos\Http\Controllers\TipoResiduoAjaxController;
use App\Modules\Residuos\Http\Controllers\EstadisticoController;
use App\Modules\Residuos\Http\Controllers\ResiduosController;
/*
|--------------------------------------------------------------------------
| Redirección de la URL base
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/gestionambiental/entradas');
});

//|--------------------------------------------------------------------------
//| Rutas de adminsitración de Residuos
Route::get('/admin-residuos', [ResiduosController::class, 'adminResiduos'])->name('residuos.administracion.admin_residuos');
Route::get('/residuos', [ResiduosController::class, 'residuos'])->name('residuos.administracion.residuos');
Route::get('/areas', [ResiduosController::class, 'areas'])->name('residuos.administracion.areas');
//|--------------------------------------------------------------------------

/*
|--------------------------------------------------------------------------
| Rutas para la Configuración
|--------------------------------------------------------------------------
*/
Route::prefix('configuracion')->group(function () {
    // Tipo de Residuo y Áreas de Procedencia
    Route::get('/tipo-residuo', [ConfiguracionController::class, 'mostrarTipoResiduo'])
        ->name('configuracion.tipo_residuo');
    Route::post('/tipo-residuo', [ConfiguracionController::class, 'agregarTipoResiduo'])
        ->name('configuracion.agregarTipoResiduo');
    Route::delete('/tipo-residuo/{id}', [ConfiguracionController::class, 'eliminarTipoResiduo'])
        ->name('configuracion.eliminarTipoResiduo');
    Route::put('/tipo-residuo/{id}', [ConfiguracionController::class, 'editarTipoResiduo'])
        ->name('configuracion.editarTipoResiduo');

    // Ruta para la edición inline vía AJAX
    Route::put('/tipo-residuo/ajax/{id}', [TipoResiduoAjaxController::class, 'update'])
        ->name('configuracion.editarTipoResiduoAjax');

    // Áreas de Procedencia
    Route::get('/area-procedencia', [ConfiguracionController::class, 'mostrarAreaProcedencia'])
        ->name('configuracion.area_procedencia');
    Route::post('/area-procedencia', [ConfiguracionController::class, 'agregarAreaProcedencia'])
        ->name('configuracion.agregarAreaProcedencia');
    Route::delete('/area-procedencia/{id}', [ConfiguracionController::class, 'eliminarAreaProcedencia'])
        ->name('configuracion.eliminarAreaProcedencia');
    Route::put('/area-procedencia/{id}', [ConfiguracionController::class, 'editarAreaProcedencia'])
        ->name('configuracion.editarAreaProcedencia');

    // Compras
    Route::get('/compras', [CompraController::class, 'index'])
        ->name('configuracion.compras.index');
    Route::post('/compras', [CompraController::class, 'store'])
        ->name('configuracion.agregarCompra');
    Route::delete('/compras/{id}', [CompraController::class, 'destroy'])
        ->name('configuracion.eliminarCompra');

    // Población
    Route::get('/poblacion', [PoblacionController::class, 'index'])
        ->name('configuracion.poblacion.index');
    Route::post('/poblacion', [PoblacionController::class, 'store'])
        ->name('configuracion.poblacion.store');
    Route::delete('/poblacion/{id}', [PoblacionController::class, 'destroy'])
        ->name('configuracion.poblacion.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas para la Gestión Ambiental: Entradas y Salidas
|--------------------------------------------------------------------------
*/
Route::prefix('gestionambiental')->group(function () {
    // Entradas (mostrar formulario y listado)
    Route::get('/entradas', [EntradaController::class, 'index'])
        ->name('entradas.index');
    Route::post('/entradas', [EntradaController::class, 'store'])
        ->name('entradas.store');

    // Salidas
    Route::get('/salidas', [SalidaController::class, 'create'])
        ->name('salidas.create');
    Route::post('/salidas', [SalidaController::class, 'store'])
        ->name('salidas.store');
});

/*
|--------------------------------------------------------------------------
| Ruta para Estadístico
|--------------------------------------------------------------------------
*/
Route::get('/estadistico', [EstadisticoController::class, 'index'])
    ->name('residuos.estadistico.index');
