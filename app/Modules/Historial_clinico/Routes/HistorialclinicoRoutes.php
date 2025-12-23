<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Historial_clinico\Http\Controllers\historialclinicoController;
use App\Http\Controllers\Administrador\DepartamentosController;
use App\Http\Controllers\Administrador\PuestosController;
use App\Modules\Historial_clinico\Http\Controllers\AgentesController;
use App\Modules\Historial_clinico\Http\Controllers\formularioController;
use App\Models\Departamento;
use App\Models\Puestos;  
use App\Modules\Historial_clinico\Http\Controllers\ReporteController;


Route::get('/home', [HistorialclinicoController::class, 'home'])->name('historialclinico.home');
Route::prefix('admin-historial')->group(function () {
  Route::get('/', [HistorialclinicoController::class, 'adminHistorial'])->name('historialclinico.admin_historial');
  Route::get('/agentes', [HistorialclinicoController::class, 'agentes'])->name('historialclinico.agentes');
});

/* 
    //RUTA PARA AGREGAR DEPARTAMENTOS     no supe si debian agregarse aqui directamente o no, asi que lo deje asi  
    // Ruta para mostrar la página de administración de departamentos
    Route::get('/departamentos/admin', [DepartamentosController::class, 'indexAdmin'])->name('departamentos.admin');

    // Rutas para las operaciones CRUD de Departamentos (API o AJAX)
    Route::post('/departamentos', [DepartamentosController::class, 'store'])->name('departamentos.store');
    Route::delete('/departamentos/{id}', [DepartamentosController::class, 'destroy'])->name('departamentos.destroy');
    Route::put('/departamentos/{id}', [DepartamentosController::class, 'update'])->name('departamentos.update');

    // Rutas para obtener y buscar departamentos (usadas por JavaScript)
    Route::get('/departamentos/propiedad/{propiedad}', [DepartamentosController::class, 'getByPropiedad'])->name('departamentos.getByPropiedad');
    Route::get('/departamentos/buscar/{propiedad}/{termino}', [DepartamentosController::class, 'buscarDepartamentos'])->name('departamentos.buscar');

    //RUTA PARA AGREGAR PUESTOS
    // --- Rutas para Puestos ---
    Route::get('/puestos/admin', [PuestosController::class, 'indexPuestos'])->name('puestos.admin'); // Ruta para la vista de puestos
    Route::post('/puestos', [PuestosController::class, 'store'])->name('puestos.store');
    Route::delete('/puestos/{id}', [PuestosController::class, 'destroy'])->name('puestos.destroy');
    Route::put('/puestos/{id}', [PuestosController::class, 'update'])->name('puestos.update');

    // Rutas para obtener y buscar puestos (usadas por JavaScript)
    Route::get('/puestos/departamento/{departamentoId}/propiedad/{propiedadId}', [PuestosController::class, 'getByDepartamentoAndPropiedad'])->name('puestos.getByDepartamentoAndPropiedad');
    Route::get('/puestos/buscar/{departamentoId}/{propiedadId}/{termino}', [PuestosController::class, 'buscarPuestos'])->name('puestos.buscar');
    // --- Rutas para Agentes ---
    // Ruta para mostrar la vista de administración de agentes
    Route::get('/agentes', [AgentesController::class, 'indexAgentes'])->name('agentes.index');

    // Rutas API para las operaciones CRUD de agentes
    Route::post('/agentes', [AgentesController::class, 'store'])->name('agentes.store');
    Route::put('/agentes/{id}', [AgentesController::class, 'update'])->name('agentes.update');
    Route::delete('/agentes/{id}', [AgentesController::class, 'destroy'])->name('agentes.destroy');

    // Rutas para obtener y buscar agentes (usadas por JavaScript)
    Route::get('/agentes/todos', [AgentesController::class, 'getAllAgentes'])->name('agentes.all');
    Route::get('/agentes/buscar/{termino}', [AgentesController::class, 'buscarAgentes'])->name('agentes.buscar');

    // --- Rutas API para carga dinámica ---
    Route::get('/api/departamentos/{hotel}', function ($hotel) {
        $departamentos = Departamento::where('propiedad', $hotel)->get();
        return response()->json($departamentos);
    })->name('api.departamentos.por_hotel');

    Route::get('/api/puestos/{departamento}', function ($departamento) {    
        $puestos = Puestos::where('departamento_id', $departamento)->get();
        return response()->json($puestos);
    })->name('api.puestos.por_departamento');

    // --- Rutas del formulario ---
    // --- Dar de Alta --
    Route::get('/historial/formulario', [formularioController::class, 'formulario'])->name('historialclinico.formulario');
    Route::post('/guardar-historial', [formularioController::class, 'store'])->name('historial.store');
    // Ruta para imprimir el formulario
    Route::get('/imprimir-formulario', [formularioController::class, 'imprimirFormulario'])->name('imprimir.formulario');
//ruta para los estadisticos
Route::get('/historialclinico/estadisticos', function () {
    return view('modules.historialclinico.informe.reportStatistics');
})->name('historialclinico.reportStatistics');
//ruta para vista de reportes
Route::get('/historialclinico/reportes', function () {
    return view('modules.historialclinico.informe.reportContent');
})->name('historialclinico.reportContent');
//Para script de las estadisticas
Route::get('/api/estadisticas-empleados', [ReporteController::class, 'estadisticas']);
Route::get('/api/puestos-y-departamentos/{hotel}', [ReporteController::class, 'getPuestosYDepartamentos']);
//actualizar tablas
Route::get('/api/filtrar-empleados', [ReporteController::class, 'filtrarEmpleados']);
// Ruta para obtener los datos del empleado por su ID
Route::get('/empleado/{id}', [ReporteController::class, 'mostrarRegistro']);
// Actualizar los datos del empleado
Route::post('/formEdit/{id}', [ReporteController::class, 'update'])->name('empleado.update');
Route::get('/formEdit/{id}', [ReporteController::class, 'formEdit']);
//Ruta descargar formulario de empleado
Route::get('/empleado/pdf/{id}', [ReporteController::class, 'descargarPDF']);
//ruta para descargar las tablas de la vista de reporte
Route::get('/reporte/pdf', [ReporteController::class, 'descargarReporte']);
//ruta para descargar las tablas de la vista de estadisticos
Route::get('/grafica-reporte/pdf', [ReporteController::class, 'descargarGrafica'])->name('grafica.pdf');
*/
