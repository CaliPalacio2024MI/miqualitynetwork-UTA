<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Bcp\Http\Controllers\RackController;

Route::get('/home', [RackController::class, 'home'])->name('bcp.home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rackhabitaciones', function () {
    return view('modules.bcp.rackhabitaciones');
})->name('bcp.rackhabitaciones');


Route::get('/checkin', function () {
    return view('modules.bcp.checkin');
})->name('bcp.checkin');

Route::get('/llegadas', function () {
    return view('modules.bcp.llegadas');
})->name('bcp.llegadas');;


Route::get('/marche', function () {
    return view('modules.bcp.marche');
})->name('bcp.marche');;

Route::get('/centroconsumopalacio', function () {
    return view('modules.bcp.centroconsumopalacio');
})->name('bcp.centroconsumopalacio');;

Route::get('/centroconsumopierre', function () {
    return view('modules.bcp.centroconsumopierre');
})->name('bcp.centroconsumopierre');;

Route::get('/centroconsumoprincess', function () {
    return view('modules.bcp.centroconsumoprincess');
})->name('bcp.centroconsumoprincess');;

Route::get('/estadodecuenta', function () {
    return view('modules.bcp.estadodecuenta');
})->name('bcp.estadodecuenta');;

use App\Http\Controllers\AdminCentroConsumoController;

Route::prefix('bcp/admin-racks')->group(function () {
    Route::get('/centros-consumo', [AdminCentroConsumoController::class, 'index'])->name('admincentrosconsumo.index');
    Route::post('/centros-consumo', [AdminCentroConsumoController::class, 'store'])->name('admincentrosconsumo.store');
});


use App\Http\Controllers\HabitacionController;
Route::get('/buscar-habitacion/{numero}', [HabitacionController::class, 'buscar']);
use App\Http\Controllers\CentroConsumoController;
Route::post('/abrir-cuenta', [CentroConsumoController::class, 'abrirCuenta']);
Route::get('/cuentas-marche', [CentroConsumoController::class, 'obtenerCuentasMarche']);
Route::post('/actualizar-consumo', [CentroConsumoController::class, 'actualizarConsumo']);
Route::post('/actualizar-consumo-concat', [CentroConsumoController::class, 'actualizarConsumoConcatenado']);
Route::get('/detalle-mesa/{mesa}', [CentroConsumoController::class, 'detalleMesa']);
Route::get('/obtener-cuenta/{habitacion}', [CentroConsumoController::class, 'obtenerCuenta']);
Route::post('/registrar-propina', [CentroConsumoController::class, 'registrarPropina']);
Route::post('/guardar-forma-pago', [CentroConsumoController::class, 'guardarFormaPago']);
Route::get('/todas-cuentas', [CentroConsumoController::class, 'todasCuentas']);
Route::post('/limpiar-mesa/{mesa}', [CentroConsumoController::class, 'limpiarMesa']);
Route::post('/limpiar-cheque/{habitacion}', [CentroConsumoController::class, 'limpiarCheque']);
Route::post('/guardar-propina-descuento-respaldo', [CentroConsumoController::class, 'guardarPropinaDescuentoRespaldo']);
Route::get('/obtener-cuenta-respaldo/{habitacion}', [CentroConsumoController::class, 'obtenerCuentaRespaldo']);
Route::get('/todas-cuentas-respaldo', [CentroConsumoController::class, 'todasCuentasRespaldo']);
Route::post('/limpiar-respaldo', [CentroConsumoController::class, 'limpiarRespaldo']);









Route::get('/administracioncreditos', function () {
    return view('administracioncreditos');});
Route::prefix('admin-racks')->group(function () {
  Route::get('/', [RackController::class, 'adminRacks'])->name('bcp.admin');
  Route::get('/centros-consumo', [RackController::class, 'adminCentrosConsumo'])->name('bcp.admin.centros_consumo');
  Route::get('/catalogo', [RackController::class, 'adminCatalogo'])->name('bcp.admin.catalogo');
  Route::get('/tipos-status', [RackController::class, 'adminTiposStatus'])->name('bcp.admin.tipos_status');
});