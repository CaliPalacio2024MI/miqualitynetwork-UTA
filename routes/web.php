<?php


use App\Http\Controllers\Administrador\AdminCarpetasController;
use App\Http\Controllers\Calidad\DocumentacionmiController;
use App\Http\Controllers\Calidad\CafeteriadeanfitrionesController;
use App\Http\Controllers\Seguridaddelainformacion\Bcpcontroller;
use App\Http\Controllers\Seguridaddelainformacion\Controlescontroller;
use App\Http\Controllers\Seguridaddelainformacion\Drpcontroller;
use App\Http\Controllers\Seguridaddelainformacion\Mantenimientocontroller;
use App\Http\Controllers\Seguridaddelainformacion\Riesgotecnologicocontroller;
use App\Http\Controllers\Seguridaddelainformacion\Circularescontroller;
use App\Http\Controllers\Seguridadysalud\Atencionaemergenciascontroller;
use App\Http\Controllers\Seguridadysalud\Gestioncontroller;
use App\Http\Controllers\Seguridadysalud\Higienecontroller;
use App\Http\Controllers\Seguridadysalud\Historialclinicocontroller;
use App\Http\Controllers\Seguridadysalud\Identificacionycontrolriesgoscontroller;
use App\Http\Controllers\Seguridadysalud\Prevencionentrabajoscontroller;
use App\Http\Controllers\ProfileController;
use App\Modules\Control_energeticos\Http\Controllers\ControlenergeticosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calidad\ContextoorgController;
use App\Http\Controllers\Calidad\Evaluaciondesempeñocontroller;
use App\Http\Controllers\Calidad\LiderazgoController;
use App\Http\Controllers\Calidad\Mejoracontroller;
use App\Http\Controllers\Calidad\Planificacioncontroller;
use App\Http\Controllers\Calidad\Apoyocontroller;
use App\Http\Controllers\Administrador\Administracioncontroller;
use App\Http\Controllers\Administrador\vistaPropiedadesController;
use App\Http\Controllers\Administrador\crearAnfitrionController;
use App\Http\Controllers\Calidad\Controlplanesdeaccioncontroller;
use App\Http\Controllers\Calidad\Procesosdeapoyocontroller;
use App\Http\Controllers\Calidad\Procesosoperativoscontroller;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\SeguridadAmbiental\Comunidadcontroller;
use App\Http\Controllers\SeguridadAmbiental\Controldeaguacontroller;
use App\Http\Controllers\SeguridadAmbiental\Controldeenergiacontroller;
use App\Http\Controllers\SeguridadAmbiental\Controldeairecontroller;
use App\Http\Controllers\SeguridadAmbiental\Controlderesiduoscontroller;
use App\Http\Controllers\SeguridadAmbiental\Recursosnaturalescontroller;
use App\Http\Controllers\SeguridadAmbiental\informaciondeaguacontroller;
use App\Http\Controllers\SeguridadAmbiental\Informaciondeenergiacontroller;
use App\Http\Controllers\SeguridadAmbiental\Ruidocontroller;
use App\Http\Controllers\SeguridadAmbiental\Suelocontroller;
use App\Http\Controllers\Administrador\crearPropiedadesController;
use App\Http\Controllers\Administrador\borrarPropiedadesController;
use App\Http\Controllers\Administrador\modificaranfitrionesController;
use App\Http\Controllers\Administrador\DepartamentosController;
use App\Http\Controllers\Administrador\PuestosController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\Administrador\borrarUserController;
use App\Http\Controllers\CarpetasController;
use App\Http\Controllers\Administrador\vistaeditaranfitrionController;
use App\Http\Controllers\Administrador\procesosController;
use App\Http\Controllers\Calidad\BalanceScoreCardController;
use App\Http\Controllers\Calidad\Documentaciondelaoperacioncontroller;
use App\Http\Controllers\Calidad\MireserevaciondeeventosController;
use App\Http\Controllers\Calidad\RevenueReportsController;
use App\Http\Controllers\SeguridadAmbiental\Aguacontroller;
use App\Http\Controllers\SeguridadAmbiental\Airecontroller;
use App\Http\Controllers\SeguridadAmbiental\Energiacontroller;
use App\Http\Controllers\SeguridadAmbiental\Informaciondeairecontroller;
use App\Http\Controllers\SeguridadAmbiental\Reportedecontroldeenergeticoscontroller;
use App\Http\Controllers\SeguridadAmbiental\Residuoscontroller;
use App\Modules\Residuos\Http\Controllers\TipoResiduoAjaxController;
//Controladores Proyecto [Control de documentos]
use App\Modules\Residuos\Http\Controllers\EstadisticoController;
use App\Modules\Historial_clinico\Http\Controllers\AgentesController;
use App\Modules\Historial_clinico\Http\Controllers\formularioController;
use App\Models\Departamento;
use App\Models\Puestos;
use App\Modules\Historial_clinico\Http\Controllers\ReporteController;
////------------------------------------------..INICIO..---------------------------------------------------JUANITO.-------
use App\Http\Controllers\Seguridadysalud\LinealController;
use App\Http\Controllers\Seguridadysalud\ReporteHistorialController;
///-------------------------------JUANITO..FIN..-----------------------------------------...-----------------------
// importa el controlador EXACTO


// BCP
use App\Http\Controllers\BCP\llegadaController;
use App\Http\Controllers\BCP\CatalogoController;
use App\Http\Controllers\BCP\SeccionesController;
use App\Http\Controllers\BCP\TipoStatusController;
use App\Http\Controllers\BCP\CreditosController;
use App\Http\Controllers\BCP\AsignacionController;
use App\Http\Controllers\BCP\StatusController;
/////////////////////--------------------------IMPLEMENTACION DE LOS 3 CRUD-----------////////////////////
use App\Http\Controllers\AccidenteController;
use App\Http\Controllers\LesionController;
use App\Http\Controllers\CausaController;
///////////////////////////-------------------------------JUAN CARLOS-----------------------------//////////////

// Ruta principal de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Dashboard para usuarios autenticados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Ruta de dashboard principal
    Route::get('/dashboard', [Dashboardcontroller::class, 'index'])->name('dashboard');

    // ---------------------------------------------
    // RUTAS PARA CONTEXTO DE LA ORGANIZACIÓN
    // ---------------------------------------------

    // Ruta principal para la vista de "Contexto de la Organización"
    Route::get('/calidad/contextoorg', [ContextoorgController::class, 'contextoOrg'])
        ->name('dashboard.contextoorg');

    // Ruta para listar los archivos dentro de una carpeta específica en "Contexto de la Organización"
    Route::get('/calidad/contextoorg/carpeta/', [ContextoorgController::class, 'contextoOrg'])
        ->name('contextoorg.index');

    // Ruta para ver el contenido de una carpeta específica en "Contexto de la Organización"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/contextoorg/ver/{carpeta_id}', [ContextoorgController::class, 'verCarpeta'])
        ->name('contextoorg.carpetas');

    // ---------------------------------------------
    // RUTAS PARA LIDERAZGO
    // ---------------------------------------------

    // Ruta principal para la vista de "Liderazgo"
    Route::get('/calidad/liderazgo', [LiderazgoController::class, 'liderazgo'])
        ->name('dashboard.liderazgo');

    // Ruta para listar los archivos dentro de una carpeta específica en "Liderazgo"
    Route::get('/calidad/liderazgo/carpeta/', [LiderazgoController::class, 'liderazgo'])
        ->name('liderazgo.index');

    // Ruta para ver el contenido de una carpeta específica en "Liderazgo"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/liderazgo/ver/{carpeta_id}', [LiderazgoController::class, 'verCarpeta'])
        ->name('liderazgo.carpetas');

    // RUTAS PARA LA SECCION DE APOYO
    Route::get('/calidad/apoyo', [Apoyocontroller::class, 'apoyo'])->name('dashboard.apoyo');

    // ---------------------------------------------
    // RUTAS PARA DOCUMENTACIONMI
    // ---------------------------------------------
    // Ruta principal para la vista de "Documentación MI"
    Route::get('/calidad/documentacionmi', [DocumentacionmiController::class, 'documentacionmi'])
        ->name('dashboard.documentacionmi');
    // Ruta alternativa para la vista de "Documentación MI"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/documentacion-mi', [DocumentacionmiController::class, 'documentacionmi'])
        ->name('documentacionmi.index');
    // Ruta para ver el contenido de una carpeta específica en "Documentación MI"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/documentacion-mi/carpeta/{carpeta_id}', [DocumentacionmiController::class, 'verCarpeta'])
        ->name('documentacionmi.carpetas');

    // ---------------------------------------------
    // RUTAS PARA MI RESERVACIÓN DE EVENTOS
    // ---------------------------------------------

    // Ruta principal para la vista de "Mi Reservación de Eventos"
    Route::get('/calidad/mireservaciondeeventos', [MireserevaciondeeventosController::class, 'mireservaciondeeventos'])
        ->name('dashboard.mireservaciondeeventos');

    // Ruta alternativa para la vista de "Mi Reservación de Eventos"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/mi-reservacion-de-eventos', [MireserevaciondeeventosController::class, 'mireservaciondeeventos'])
        ->name('mireservaciondeeventos.index');

    // Ruta para ver el contenido de una carpeta específica en "Mi Reservación de Eventos"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/mi-reservacion-de-eventos/carpeta/{carpeta_id}', [MireserevaciondeeventosController::class, 'verCarpeta'])
        ->name('mireservaciondeeventos.carpetas');

    // ---------------------------------------------
    // RUTAS PARA CONTROL DOCUMENTAL
    // ---------------------------------------------

    // Ruta principal para la vista de "Control Documental"


    // Ruta alternativa para la vista de "Control Documental"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    // Route::get('/calidad/control-documental', [Controldocumentalcontroller::class, 'controldocumental'])
    //     ->name('controldocumental.index');

    // Ruta para ver el contenido de una carpeta específica en "Control Documental"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.


    // ---------------------------------------------
    // RUTAS PARA PLANIFICACIÓN
    // ---------------------------------------------

    // Ruta principal para la vista de "Planificación"
    Route::get('/calidad/planificacion', [Planificacioncontroller::class, 'planificacion'])
        ->name('dashboard.planificacion');

    // Ruta alternativa para la vista de "Planificación"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/planificacion', [Planificacioncontroller::class, 'planificacion'])
        ->name('planificacion.index');

    // Ruta para ver el contenido de una carpeta específica en "Planificación"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/planificacion/carpeta/{carpeta_id}', [Planificacioncontroller::class, 'verCarpeta'])
        ->name('planificacion.carpetas');

    //Rutas [PROYECTO CONTROL DE DOCUMENTOS (Seccion Calidad)]
    Route::get('/calidad/documentaciondelaoperacion', [Documentaciondelaoperacioncontroller::class, 'documentaciondelaoperacion'])->name('dashboard.documentaciondelaoperacion');

    // ---------------------------------------------
    // RUTAS PARA CAFETERIA DE ANFITRIONES (CAFE KALI)
    // ---------------------------------------------
    // Ruta principal para la vista de "Cafetería de Anfitriones" (CAFE KALI)
    Route::get('/calidad/cafeteriadeanfitriones', [CafeteriadeanfitrionesController::class, 'cafeteriadeanfitriones'])
        ->name('dashboard.cafeteriadeanfitriones');
    // Ruta alternativa para la vista de "Cafetería de Anfitriones" (CAFE KALI)
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/cafeteria-de-anfitriones', [CafeteriadeanfitrionesController::class, 'cafeteriadeanfitriones'])
        ->name('cafeteriadeanfitriones.index');
    // Ruta para ver el contenido de una carpeta específica en "Cafetería de Anfitriones" (CAFE KALI)
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/cafeteria-de-anfitriones/carpeta/{carpeta_id}', [CafeteriadeanfitrionesController::class, 'verCarpeta'])
        ->name('cafeteriadeanfitriones.carpetas');

    // ---------------------------------------------
    // RUTAS PARA PROCESOS OPERATIVOS
    // ---------------------------------------------

    // Ruta principal para la vista de "Procesos Operativos"
    Route::get('/calidad/procesosoperativos', [Procesosoperativoscontroller::class, 'procesosoperativos'])
        ->name('dashboard.procesosoperativos');

    // Ruta alternativa para la vista de "Procesos Operativos"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/procesos-operativos', [Procesosoperativoscontroller::class, 'procesosoperativos'])
        ->name('procesosoperativos.index');

    // Ruta para ver el contenido de una carpeta específica en "Procesos Operativos"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/procesos-operativos/carpeta/{carpeta_id}', action: [Procesosoperativoscontroller::class, 'verCarpeta'])
        ->name('procesosoperativos.carpetas');

    // ---------------------------------------------
    // RUTAS PARA PROCESOS DE APOYO
    // ---------------------------------------------

    // Ruta principal para la vista de "Procesos de Apoyo"
    Route::get('/calidad/procesosdeapoyo', [Procesosdeapoyocontroller::class, 'procesosdeapoyo'])
        ->name('dashboard.procesosdeapoyo');

    // Ruta alternativa para la vista de "Procesos de Apoyo"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/procesosdeapoyo', [Procesosdeapoyocontroller::class, 'procesosdeapoyo'])
        ->name('procesosdeapoyo.index');

    // Ruta para ver el contenido de una carpeta específica en "Procesos de Apoyo"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/procesosdeapoyo/carpeta/{carpeta_id}', [Procesosdeapoyocontroller::class, 'verCarpeta'])
        ->name('procesosdeapoyo.carpetas');

    // Rutas para Evaluación del Desempeño
    Route::get('/calidad/evaldesempeño', [Evaluaciondesempeñocontroller::class, 'evaldesempeño'])->name('dashboard.evaldesempeño');
    // ---------------------------------------------
    // RUTAS PARA REVENUE REPORTS
    // ---------------------------------------------

    // Ruta principal para la vista de "Revenue Reports"
    Route::get('/calidad/evaldesempeño/revenuereports', [RevenueReportsController::class, 'revenueReports'])
        ->name('dashboard.revenuereports');

    // Ruta alternativa para la vista de "Revenue Reports"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/revenue-reports', [RevenueReportsController::class, 'revenueReports'])
        ->name('revenuereports.index');

    // Ruta para ver el contenido de una carpeta específica en "Revenue Reports"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/revenue-reports/carpeta/{carpeta_id}', [RevenueReportsController::class, 'verCarpeta'])
        ->name('revenuereports.carpetas');


    // ---------------------------------------------
    // RUTAS PARA BALANCE SCORE CARD
    // ---------------------------------------------

    // Ruta principal para la vista de "Balance Score Card"
    Route::get('/calidad/evaldesempeño/balancescorecard', [BalanceScoreCardController::class, 'balanceScoreCard'])
        ->name('dashboard.balancescorecard');

    // Ruta alternativa para la vista de "Balance Score Card"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/balance-score-card', [BalanceScoreCardController::class, 'balanceScoreCard'])
        ->name('balancescorecard.index');

    // Ruta para ver el contenido de una carpeta específica en "Balance Score Card"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/balance-score-card/carpeta/{carpeta_id}', [BalanceScoreCardController::class, 'verCarpeta'])
        ->name('balancescorecard.carpetas');

    // RUTAS PARA MEJORA
    Route::get('/calidad/mejora', [Mejoracontroller::class, 'mejora'])->name('dashboard.mejora');
    // ---------------------------------------------
    // RUTAS PARA CONTROL DE PLANES DE ACCIÓN
    // ---------------------------------------------

    // Ruta principal para la vista de "Control de Planes de Acción"
    Route::get('/calidad/controlplanesdeaccion', [Controlplanesdeaccioncontroller::class, 'controlplanesdeaccion'])
        ->name('dashboard.controlplanesdeaccion');

    // Ruta alternativa para la vista de "Control de Planes de Acción"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/calidad/control-planes-de-accion', [Controlplanesdeaccioncontroller::class, 'controlplanesdeaccion'])
        ->name('controlplanesdeaccion.index');

    // Ruta para ver el contenido de una carpeta específica en "Control de Planes de Acción"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/calidad/control-planes-de-accion/carpeta/{carpeta_id}', [Controlplanesdeaccioncontroller::class, 'verCarpeta'])
        ->name('controlplanesdeaccion.carpetas');


    // Secciones de SEGURIDAD AMBIENTAL del sidebar (con controladores)
    Route::get('/seguridadambiental/residuos', [Residuoscontroller::class, 'residuos'])->name('dashboard.residuos');

    // ---------------------------------------------
    // RUTAS PARA CONTROL DE RESIDUOS
    // ---------------------------------------------

    // Ruta principal para la vista de "Control de Residuos"
    Route::get('/seguridadambiental/controlderesiduos', [Controlderesiduoscontroller::class, 'controlderesiduos'])
        ->name('dashboard.controlderesiduos');

    // Ruta alternativa para la vista de "Control de Residuos"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/control-de-residuos', [Controlderesiduoscontroller::class, 'controlderesiduos'])
        ->name('controlderesiduos.index');

    // Ruta para ver el contenido de una carpeta específica en "Control de Residuos"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/control-de-residuos/carpeta/{carpeta_id}', [Controlderesiduoscontroller::class, 'verCarpeta'])
        ->name('controlderesiduos.carpetas');

    // Ruta para edicion inline de "Tipos Residuos"     
    Route::put('/residuos/configuracion/editar-tipo-residuo-ajax/{id}', [TipoResiduoAjaxController::class, 'update'])->name('configuracion.editarTipoResiduoAjax');

    // ---------------------------------------------
    // RUTAS PARA CONTROL DE ENERGÍA
    // ---------------------------------------------
    // Ruta principal para la vista de "Control de Energía"
    Route::get('/seguridadambiental/controldeenergia', [Controldeenergiacontroller::class, 'controldeenergia'])
        ->name('dashboard.controldeenergia');

    // Ruta alternativa para la vista de "Control de Energía"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/control-de-energia', [Controldeenergiacontroller::class, 'controldeenergia'])
        ->name('controldeenergia.index');

    // Ruta para ver el contenido de una carpeta específica en "Control de Energía"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/control-de-energia/carpeta/{carpeta_id}', [Controldeenergiacontroller::class, 'verCarpeta'])
        ->name('controldeenergia.carpetas');

    // ---------------------------------------------
    // RUTAS PARA INFORMACION DE ENERGIA
    // ---------------------------------------------
    // Ruta principal para la vista de "Información de Energía"
    Route::get('/seguridadambiental/informaciondeenergia', [Informaciondeenergiacontroller::class, 'informaciondeenergia'])
        ->name('dashboard.informaciondeenergia');
    // Ruta alternativa para la vista de "Información de Energía"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/informacion-de-energia', [Informaciondeenergiacontroller::class, 'informaciondeenergia'])
        ->name('informaciondeenergia.index');
    // Ruta para ver el contenido de una carpeta específica en "Información de Energía"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/informacion-de-energia/carpeta/{carpeta_id}', [Informaciondeenergiacontroller::class, 'verCarpeta'])
        ->name('informaciondeenergia.carpetas');

    // ---------------------------------------------
    // RUTAS PARA CONTROL DE AGUA
    // ---------------------------------------------
    // Ruta principal para la vista de "Control de Agua"
    Route::get('/seguridadambiental/controldeagua', [Controldeaguacontroller::class, 'controldeagua'])
        ->name('dashboard.controldeagua');
    // Ruta alternativa para la vista de "Control de Agua"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/control-de-agua', [Controldeaguacontroller::class, 'controldeagua'])
        ->name('controldeagua.index');
    // Ruta para ver el contenido de una carpeta específica en "Control de Agua"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/control-de-agua/carpeta/{carpeta_id}', [Controldeaguacontroller::class, 'verCarpeta'])
        ->name('controldeagua.carpetas');

    // ---------------------------------------------
    // RUTAS PARA INFORMACION DE AGUA
    // ---------------------------------------------
    // Ruta principal para la vista de "Información de Agua"
    Route::get('/seguridadambiental/informaciondeagua', [Informaciondeaguacontroller::class, 'informaciondeagua'])
        ->name('dashboard.informaciondeagua');
    // Ruta alternativa para la vista de "Información de Agua"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/informacion-de-agua', [Informaciondeaguacontroller::class, 'informaciondeagua'])
        ->name('informaciondeagua.index');
    // Ruta para ver el contenido de una carpeta específica en "Información de Agua"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/informacion-de-agua/carpeta/{carpeta_id}', [Informaciondeaguacontroller::class, 'verCarpeta'])
        ->name('informaciondeagua.carpetas');

    // ---------------------------------------------
    // RUTAS PARA CONTROL DE AIRE
    // ---------------------------------------------
    // Ruta principal para la vista de "Control de Aire"
    Route::get('/seguridadambiental/controldeaire', [Controldeairecontroller::class, 'controldeaire'])
        ->name('dashboard.controldeaire');
    // Ruta alternativa para la vista de "Control de Aire"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/control-de-aire', [Controldeairecontroller::class, 'controldeaire'])
        ->name('controldeaire.index');
    // Ruta para ver el contenido de una carpeta específica en "Control de Aire"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/control-de-aire/carpeta/{carpeta_id}', [Controldeairecontroller::class, 'verCarpeta'])
        ->name('controldeaire.carpetas');

    // ---------------------------------------------
    // RUTAS PARA INFORMACION DE AIRE
    // ---------------------------------------------
    // Ruta principal para la vista de "Información de Aire"
    Route::get('/seguridadambiental/informaciondeaire', [Informaciondeairecontroller::class, 'informaciondeaire'])
        ->name('dashboard.informaciondeaire');
    // Ruta alternativa para la vista de "Información de Aire"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/informacion-de-aire', [Informaciondeairecontroller::class, 'informaciondeaire'])
        ->name('informaciondeaire.index');
    // Ruta para ver el contenido de una carpeta específica en "Información de Aire"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/informacion-de-aire/carpeta/{carpeta_id}', [Informaciondeairecontroller::class, 'verCarpeta'])
        ->name('informaciondeaire.carpetas');

    // ---------------------------------------------
    // RUTAS PARA COMUNIDAD
    // ---------------------------------------------
    // Ruta principal para la vista de "Comunidad"
    Route::get('/seguridadambiental/comunidad', [Comunidadcontroller::class, 'comunidad'])
        ->name('dashboard.comunidad');

    // Ruta alternativa para la vista de "Comunidad"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/comunidad-alternativa', [Comunidadcontroller::class, 'comunidad'])
        ->name('comunidad.index');

    // Ruta para ver el contenido de una carpeta específica en "Comunidad"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/comunidad/carpeta/{carpeta_id}', [Comunidadcontroller::class, 'verCarpeta'])
        ->name('comunidad.carpetas');

    // ---------------------------------------------
    // RUTAS PARA RUIDO
    // ---------------------------------------------
    // Ruta principal para la vista de "Ruido"
    Route::get('/seguridadambiental/ruido', [Ruidocontroller::class, 'ruido'])
        ->name('dashboard.ruido');
    // Ruta alternativa para la vista de "Ruido"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/ruido-alternativa', [Ruidocontroller::class, 'ruido'])
        ->name('ruido.index');
    // Ruta para ver el contenido de una carpeta específica en "Ruido"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/ruido/carpeta/{carpeta_id}', [Ruidocontroller::class, 'verCarpeta'])
        ->name('ruido.carpetas');

    // ---------------------------------------------
    // RUTAS PARA SUELO
    // ---------------------------------------------
    // Ruta principal para la vista de "Suelo"
    Route::get('/seguridadambiental/suelo', [Suelocontroller::class, 'suelo'])
        ->name('dashboard.suelo');
    // Ruta alternativa para la vista de "Suelo"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/suelo-alternativa', [Suelocontroller::class, 'suelo'])
        ->name('suelo.index');
    // Ruta para ver el contenido de una carpeta específica en "Suelo"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/suelo/carpeta/{carpeta_id}', [Suelocontroller::class, 'verCarpeta'])
        ->name('suelo.carpetas');

    // ---------------------------------------------
    // RUTAS PARA RECURSOS NATURALES
    // ---------------------------------------------
    // Ruta principal para la vista de "Recursos Naturales"
    Route::get('/seguridadambiental/recursosnaturales', [Recursosnaturalescontroller::class, 'recursosnaturales'])
        ->name('dashboard.recursosnaturales');
    // Ruta alternativa para la vista de "Recursos Naturales"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/recursos-naturales', [Recursosnaturalescontroller::class, 'recursosnaturales'])
        ->name('recursosnaturales.index');
    // Ruta para ver el contenido de una carpeta específica en "Recursos Naturales"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/recursos-naturales/carpeta/{carpeta_id}', [Recursosnaturalescontroller::class, 'verCarpeta'])
        ->name('recursosnaturales.carpetas');

    // ---------------------------------------------
    // RUTAS PARA REPORTES DE CONTROL DE ENERGÉTICOS
    // ---------------------------------------------
    // Ruta principal para la vista de "Reportes de Control de Energéticos"
    Route::get('/seguridadambiental/reportedecontroldeenergeticos', [Reportedecontroldeenergeticoscontroller::class, 'reportedecontroldeenergeticos'])
        ->name('dashboard.reportedecontroldeenergeticos');
    // Ruta alternativa para la vista de "Reportes de Control de Energéticos"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadambiental/reportes-de-control-de-energeticos', [Reportedecontroldeenergeticoscontroller::class, 'reportedecontroldeenergeticos'])
        ->name('reportedecontroldeenergeticos.index');
    // Ruta para ver el contenido de una carpeta específica en "Reportes de Control de Energéticos"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadambiental/reportes-de-control-de-energeticos/carpeta/{carpeta_id}', [Reportedecontroldeenergeticoscontroller::class, 'verCarpeta'])
        ->name('reportedecontroldeenergeticos.carpetas');


    // Secciones de SEGURIDAD Y SALUD del sidebar (con controladores)
    // ---------------------------------------------
    // RUTAS PARA GESTION
    // ---------------------------------------------
    // Ruta principal para la vista de "Gestión"
    Route::get('/seguridadysalud/gestion', [Gestioncontroller::class, 'gestion'])
        ->name('dashboard.gestion');
    // Ruta alternativa para la vista de "Gestión"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadysalud/gestion-alternativa', [Gestioncontroller::class, 'gestion'])
        ->name('gestion.index');
    // Ruta para ver el contenido de una carpeta específica en "Gestión"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadysalud/gestion/carpeta/{carpeta_id}', [Gestioncontroller::class, 'verCarpeta'])
        ->name('gestion.carpetas');

    // ---------------------------------------------
    // RUTAS PARA ATENCION A EMERGENCIAS
    // ---------------------------------------------
    // Ruta principal para la vista de "Atención a Emergencias"
    Route::get('/seguridadysalud/atencionaemergencias', [Atencionaemergenciascontroller::class, 'atencionaemergencias'])
        ->name('dashboard.atencionaemergencias');
    // Ruta alternativa para la vista de "Atención a Emergencias"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadysalud/atencion-a-emergencias', [Atencionaemergenciascontroller::class, 'atencionaemergencias'])
        ->name('atencionaemergencias.index');
    // Ruta para ver el contenido de una carpeta específica en "Atención a Emergencias"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadysalud/atencion-a-emergencias/carpeta/{carpeta_id}', [Atencionaemergenciascontroller::class, 'verCarpeta'])
        ->name('atencionaemergencias.carpetas');

    // ---------------------------------------------
    // RUTAS PARA HIGIENE
    // ---------------------------------------------
    // Ruta principal para la vista de "Higiene"
    Route::get('/seguridadysalud/higiene', [Higienecontroller::class, 'higiene'])
        ->name('dashboard.higiene');
    // Ruta alternativa para la vista de "Higiene"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadysalud/higiene-alternativa', [Higienecontroller::class, 'higiene'])
        ->name('higiene.index');
    // Ruta para ver el contenido de una carpeta específica en "Higiene"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadysalud/higiene/carpeta/{carpeta_id}', [Higienecontroller::class, 'verCarpeta'])
        ->name('higiene.carpetas');

    // ---------------------------------------------
    // RUTAS PARA IDENTIFICACION Y CONTROL DE RIESGOS
    // ---------------------------------------------
    // Ruta principal para la vista de "Identificación y Control de Riesgos"
    Route::get('/seguridadysalud/identificacionycontrolderiesgos', [Identificacionycontrolriesgoscontroller::class, 'identificacionycontrolderiesgos'])
        ->name('dashboard.identificacionycontrolderiesgos');
    // Ruta alternativa para la vista de "Identificación y Control de Riesgos"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadysalud/identificacion-y-control-de-riesgos', [Identificacionycontrolriesgoscontroller::class, 'identificacionycontrolderiesgos'])
        ->name('identificacionycontrolderiesgos.index');
    // Ruta para ver el contenido de una carpeta específica en "Identificación y Control de Riesgos"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadysalud/identificacion-y-control-de-riesgos/carpeta/{carpeta_id}', [Identificacionycontrolriesgoscontroller::class, 'verCarpeta'])
        ->name('identificacionycontrolderiesgos.carpetas');

    // ---------------------------------------------
    // RUTAS PARA PREVENCION EN TRABAJOS PELIGROSOS
    // ---------------------------------------------
    // Ruta principal para la vista de "Prevención en Trabajos Peligrosos"
    Route::get('/seguridadysalud/prevencionentrabajospeligrosos', [Prevencionentrabajoscontroller::class, 'prevencionentrabajospeligrosos'])
        ->name('dashboard.prevencionentrabajospeligrosos');
    // Ruta alternativa para la vista de "Prevención en Trabajos Peligrosos"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadysalud/prevencion-en-trabajos-peligrosos', [Prevencionentrabajoscontroller::class, 'prevencionentrabajospeligrosos'])
        ->name('prevencionentrabajospeligrosos.index');
    // Ruta para ver el contenido de una carpeta específica en "Prevención en Trabajos Peligrosos"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadysalud/prevencion-en-trabajos-peligrosos/carpeta/{carpeta_id}', [Prevencionentrabajoscontroller::class, 'verCarpeta'])
        ->name('prevencionentrabajospeligrosos.carpetas');

    // ---------------------------------------------
    // RUTAS PARA HISTORIAL CLÍNICO
    // ---------------------------------------------
    Route::get('/seguridadysalud/preservaciondelasalud', [App\Http\Controllers\Seguridadysalud\PreservaciondelasaludController::class, 'preservaciondelasalud'])->name('dashboard.preservaciondelasalud');
    // Ruta principal para la vista de "Historial Clínico"
    Route::get('/seguridadysalud/historialclinico', [HistorialclinicoController::class, 'historialclinico'])
        ->name('dashboard.historialclinico');
    // Ruta alternativa para la vista de "Historial Clínico"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadysalud/historial-clinico', [HistorialclinicoController::class, 'historialclinico'])
        ->name('historialclinico.index');
    // Ruta para ver el contenido de una carpeta específica en "Historial Clínico"
    // “Nuevo Registro”: carga el formulario con Accidentes, Lesiones y Causas
    Route::get(
        '/seguridadysalud/historial-clinico/formulario',
        [Historialclinicocontroller::class, 'create']
    )->name('historialclinico.formulario');

    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadysalud/historial-clinico/carpeta/{carpeta_id}', [Historialclinicocontroller::class, 'verCarpeta'])
        ->name('historialclinico.carpetas');
    //RUTA PARA AGREGAR DEPARTAMENTOS
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


    // Secciones de SEGURIDAD DE LA INFORMACIÓN del sidebar (con controladores)
    // ---------------------------------------------
    // RUTAS PARA BCP
    // ---------------------------------------------
    // Ruta principal para la vista de "BCP"
    Route::get('/seguridaddelainformacion/bcp', [Bcpcontroller::class, 'bcp'])
        ->name('dashboard.bcp');
    // Ruta alternativa para la vista de "BCP"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridaddelainformacion/bcp-alternativa', [Bcpcontroller::class, 'bcp'])
        ->name('bcp.index');
    // Ruta para ver el contenido de una carpeta específica en "BCP"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridaddelainformacion/bcp/carpeta/{carpeta_id}', [Bcpcontroller::class, 'verCarpeta'])
        ->name('bcp.carpetas');


    Route::resource('llegada', llegadaController::class);
    Route::post('/llegada/importar', [llegadaController::class, 'importar'])->name('llegada.importar');

    Route::get('/checkin', [LlegadaController::class, 'index3'])->name('checkin.index3');
    Route::post('/checkin', [LlegadaController::class, 'store'])->name('checkin.store');

    Route::get('/rack', [LlegadaController::class, 'index2'])->name('rack');
    Route::post('/rack/reservar', [LlegadaController::class, 'marcarReservacion'])->name('rack.reservar');

    Route::resource('catalogo', CatalogoController::class);

    Route::resource('secciones', SeccionesController::class);
    Route::post('/filtrar-habitaciones', [SeccionesController::class, 'filtrarHabitaciones'])->name('secciones.filtrar');
    Route::delete('/eliminar-seccion/{seccion}', [SeccionesController::class, 'eliminar'])->name('eliminar.seccion');

    Route::get('/tipo_status', [TipoStatusController::class, 'index'])->name('tipo_status.index');
    Route::post('/tipo_status', [TipoStatusController::class, 'store'])->name('tipo_status.store');
    Route::delete('/tipo_status/{Codigo}', [TipoStatusController::class, 'destroy'])->name('tipo_status.destroy');
    Route::put('/tipo_status/{tipo_status}', [TipoStatusController::class, 'update'])->name('tipo_status.update');

    Route::get('/creditos', [CreditosController::class, 'index'])->name('creditos.index');
    Route::post('/creditos/update', [CreditosController::class, 'update'])->name('creditos.update');

    Route::get('/asignacion', [CatalogoController::class, 'asignacion']);
    Route::put('/secciones/{seccion}', [SeccionesController::class, 'update']);
    Route::get('/secciones/{seccion}/habitaciones', function ($seccion) {
        return \App\Models\BCP\Catalogo::where('Secciones', $seccion)->pluck('N_Hab');
    });
    Route::get('/buscar-habitaciones/{seccion}', [AsignacionController::class, 'buscarHabitaciones']);
    Route::post('/asignadas/guardar', [AsignacionController::class, 'guardar'])->name('asignadas.guardar');
    Route::get('/buscar-asignadas-hoy/{camarista}', [AsignacionController::class, 'asignadasHoy']);
    Route::get('/exportar-asignadas/{camarista}', [AsignacionController::class, 'exportarHoy']);

    Route::get('/status', function () {
        return view('seguridaddelainformacion.bcp.status');
    });
    Route::get('/asignaciones-hoy', [StatusController::class, 'obtenerAsignaciones']);
    Route::get('/asignaciones-detalle/{camarista}', [StatusController::class, 'detalleAsignaciones']);
    Route::get('/tipos-status', function () {
        return \App\Models\BCP\TipoStatus::all(['Codigo']);
    });
    Route::post('/asignacion/update-status', [StatusController::class, 'updateStatus']);


    // AGREGA TUS RUTAS A PARTIR DE AQUI



    //////////////////////////////////////////////////////------------------------------------------------------

    // ---------------------------------------------
    // RUTAS PARA CONTROLES
    // ---------------------------------------------
    // Ruta principal para la vista de "Controles"
    Route::get('/seguridaddelainformacion/controles', [Controlescontroller::class, 'controles'])
        ->name('dashboard.controles');
    // Ruta alternativa para la vista de "Controles"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridaddelainformacion/controles-alternativa', [Controlescontroller::class, 'controles'])
        ->name('controles.index');
    // Ruta para ver el contenido de una carpeta específica en "Controles"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridaddelainformacion/controles/carpeta/{carpeta_id}', [Controlescontroller::class, 'verCarpeta'])
        ->name('controles.carpetas');
    // ---------------------------------------------
    // RUTAS PARA DRP
    // ---------------------------------------------
    // Ruta principal para la vista de "DRP"
    Route::get('/seguridaddelainformacion/drp', [Drpcontroller::class, 'drp'])
        ->name('dashboard.drp');
    // Ruta alternativa para la vista de "DRP"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridaddelainformacion/drp-alternativa', [Drpcontroller::class, 'drp'])
        ->name('drp.index');
    // Ruta para ver el contenido de una carpeta específica en "DRP"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridaddelainformacion/drp/carpeta/{carpeta_id}', [Drpcontroller::class, 'verCarpeta'])
        ->name('drp.carpetas');
    // ---------------------------------------------
    // RUTAS PARA MANTENIMIENTO
    // ---------------------------------------------
    // Ruta principal para la vista de "Mantenimiento"
    Route::get('/seguridaddelainformacion/mantenimiento', [Mantenimientocontroller::class, 'mantenimiento'])
        ->name('dashboard.mantenimiento');
    // Ruta alternativa para la vista de "Mantenimiento"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridaddelainformacion/mantenimiento-alternativa', [Mantenimientocontroller::class, 'mantenimiento'])
        ->name('mantenimiento.index');
    // Ruta para ver el contenido de una carpeta específica en "Mantenimiento"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridaddelainformacion/mantenimiento/carpeta/{carpeta_id}', [Mantenimientocontroller::class, 'verCarpeta'])
        ->name('mantenimiento.carpetas');
    // ---------------------------------------------
    // RUTAS PARA RIESGO TECNOLÓGICO
    // ---------------------------------------------
    // Ruta principal para la vista de "Riesgo Tecnológico"
    Route::get('/seguridaddelainformacion/riesgotecnologico', [Riesgotecnologicocontroller::class, 'riesgotecnologico'])
        ->name('dashboard.riesgotecnologico');
    // Ruta alternativa para la vista de "Riesgo Tecnológico"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridaddelainformacion/riesgo-tecnologico', [Riesgotecnologicocontroller::class, 'riesgotecnologico'])
        ->name('riesgotecnologico.index');
    // Ruta para ver el contenido de una carpeta específica en "Riesgo Tecnológico"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridaddelainformacion/riesgo-tecnologico/carpeta/{carpeta_id}', [Riesgotecnologicocontroller::class, 'verCarpeta'])
        ->name('riesgotecnologico.carpetas');
    // ---------------------------------------------
    // RUTAS PARA CIRCULARES
    // ---------------------------------------------
    // Ruta principal para la vista de "Circulares"
    Route::get('/seguridaddelainformacion/circulares', [Circularescontroller::class, 'circulares'])
        ->name('dashboard.circulares');
    // Ruta alternativa para la vista de "Mantenimiento"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridaddelainformacion/circulares-alternativa', [Circularescontroller::class, 'circulares'])
        ->name('circulares.index');
    // Ruta para ver el contenido de una carpeta específica en "Mantenimiento"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridaddelainformacion/circulares/carpeta/{carpeta_id}', [Circularescontroller::class, 'verCarpeta'])
        ->name('circulares.carpetas');



    // Secciones de SEGURIDAD ALIMENTARIA del sidebar (con controladores)
    // ---------------------------------------------
    // RUTAS PARA CADENA ALIMENTARIA
    // ---------------------------------------------
    // Ruta principal para la vista de "Cadena Alimentaria"
    Route::get('/seguridadalimentaria/cadenaalimentaria', [App\Http\Controllers\SeguridadAlimentaria\Cadenaalimentariacontroller::class, 'cadenaalimentaria'])
        ->name('dashboard.cadenaalimentaria');
    // Ruta alternativa para la vista de "Cadena Alimentaria"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadalimentaria/cadena-alimentaria', [App\Http\Controllers\SeguridadAlimentaria\Cadenaalimentariacontroller::class, 'cadenaalimentaria'])
        ->name('cadenaalimentaria.index');
    // Ruta para ver el contenido de una carpeta específica en "Cadena Alimentaria"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadalimentaria/cadena-alimentaria/carpeta/{carpeta_id}', [App\Http\Controllers\SeguridadAlimentaria\Cadenaalimentariacontroller::class, 'verCarpeta'])
        ->name('cadenaalimentaria.carpetas');

    // ---------------------------------------------
    // RUTAS PARA INOCUIDAD
    // ---------------------------------------------
    // Ruta principal para la vista de "Inocuidad"
    Route::get('/seguridadalimentaria/inocuidad', [App\Http\Controllers\SeguridadAlimentaria\Inocuidadcontroller::class, 'inocuidad'])
        ->name('dashboard.inocuidad');
    // Ruta alternativa para la vista de "Inocuidad"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadalimentaria/inocuidad-alternativa', [App\Http\Controllers\SeguridadAlimentaria\Inocuidadcontroller::class, 'inocuidad'])
        ->name('inocuidad.index');
    // Ruta para ver el contenido de una carpeta específica en "Inocuidad"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadalimentaria/inocuidad/carpeta/{carpeta_id}', [App\Http\Controllers\SeguridadAlimentaria\Inocuidadcontroller::class, 'verCarpeta'])
        ->name('inocuidad.carpetas');

    // ---------------------------------------------
    // RUTAS PARA MANIPULACION DE ALIMENTOS
    // ---------------------------------------------
    // Ruta principal para la vista de "Manipulación de Alimentos"
    Route::get('/seguridadalimentaria/manipulaciondealimentos', [App\Http\Controllers\SeguridadAlimentaria\Manipulaciondealimentoscontroller::class, 'manipulaciondealimentos'])
        ->name('dashboard.manipulaciondealimentos');
    // Ruta alternativa para la vista de "Manipulación de Alimentos"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadalimentaria/manipulacion-de-alimentos', [App\Http\Controllers\SeguridadAlimentaria\Manipulaciondealimentoscontroller::class, 'manipulaciondealimentos'])
        ->name('manipulaciondealimentos.index');
    // Ruta para ver el contenido de una carpeta específica en "Manipulación de Alimentos"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadalimentaria/manipulacion-de-alimentos/carpeta/{carpeta_id}', [App\Http\Controllers\SeguridadAlimentaria\Manipulaciondealimentoscontroller::class, 'verCarpeta'])
        ->name('manipulaciondealimentos.carpetas');


    // ---------------------------------------------
    // RUTAS PARA MEDICIÓN
    // ---------------------------------------------
    // Ruta principal para la vista de "Medición"
    Route::get('/seguridadalimentaria/medicion', [App\Http\Controllers\SeguridadAlimentaria\Medicioncontroller::class, 'medicion'])
        ->name('dashboard.medicion');

    // Ruta alternativa para la vista de "Medición"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadalimentaria/medicion-alternativa', [App\Http\Controllers\SeguridadAlimentaria\Medicioncontroller::class, 'medicion'])
        ->name('medicion.index');

    // Ruta para ver el contenido de una carpeta específica en "Medición"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadalimentaria/medicion/carpeta/{carpeta_id}', [App\Http\Controllers\SeguridadAlimentaria\Medicioncontroller::class, 'verCarpeta'])
        ->name('medicion.carpetas');


    // ---------------------------------------------
    // RUTAS PARA RIESGOS ALIMENTARIOS
    // ---------------------------------------------
    // Ruta principal para la vista de "Riesgos Alimentarios"
    Route::get('/seguridadalimentaria/riesgosalimentarios', [App\Http\Controllers\SeguridadAlimentaria\Riesgosalimentarioscontroller::class, 'riesgosalimentarios'])
        ->name('dashboard.riesgosalimentarios');
    // Ruta alternativa para la vista de "Riesgos Alimentarios"
    // Similar a la anterior, pero con un nombre de ruta diferente para mayor flexibilidad en el uso.
    Route::get('/seguridadalimentaria/riesgos-alimentarios', [App\Http\Controllers\SeguridadAlimentaria\Riesgosalimentarioscontroller::class, 'riesgosalimentarios'])
        ->name('riesgosalimentarios.index');
    // Ruta para ver el contenido de una carpeta específica en "Riesgos Alimentarios"
    // Muestra los archivos y subcarpetas dentro de una carpeta seleccionada, siempre que el usuario tenga acceso.
    Route::get('/seguridadalimentaria/riesgos-alimentarios/carpeta/{carpeta_id}', [App\Http\Controllers\SeguridadAlimentaria\Riesgosalimentarioscontroller::class, 'verCarpeta'])
        ->name('riesgosalimentarios.carpetas');

    //Ruta del controlador de administracion de usuarios
    Route::get('/Administracion/usuario', [Administracioncontroller::class, 'administracion'])->name('dashboard.usuario');
    Route::get('/admin/usuarios', [Administracioncontroller::class, 'administrarUsuarios'])
        ->name('dashboard.usuario')
        ->middleware('auth');
    Route::get('/admin/departamentos', [Administracioncontroller::class, 'administrarDepartamentos'])
        ->name('dashboard.departamentos')
        ->middleware('auth');
    Route::get('/admin/puestos', [Administracioncontroller::class, 'administrarPuestos'])
        ->name('dashboard.puestos')
        ->middleware('auth');

    //ruta para modificar usuarios
    Route::post('/modificar-user', [modificaranfitrionesController::class, 'modificar'])->name('modificar.user');
    Route::get('/Administracion/crearuser/buscar', [crearAnfitrionController::class, 'buscar'])->name('dashboard.crearuser.buscar');
    // Nueva ruta para administrar archivos
    Route::get('/dashboard/index', [ArchivoController::class, 'index'])
        ->name('dashboard.index');
    //Ruta de administrar propiedades
    Route::get('/Administracion/propiedades', [vistaPropiedadesController::class, 'configurar'])->name('dashboard.propiedades');
    //Ruta para insertar propiedades
    Route::post('/crear-propiedad', [crearPropiedadesController::class, 'crearpropiedades'])->name('crear.propiedad');
    //Ruta para eliminar propiedadaes
    Route::post('/borrar-propiedad', [borrarPropiedadesController::class, 'borrar'])->name('borrar.propiedad');
    //Ruta para modificar propiedades
    Route::post('/modificar-propiedad', [borrarPropiedadesController::class, 'actualizar_propiedad'])->name('actualizar.propiedad');
    //Ruta de creacion de usuarios
    Route::get('/Administracion/crearuser', [crearAnfitrionController::class, 'crear'])->name('dashboard.crearuser');
    Route::post('/Administracion/crearuser', [crearAnfitrionController::class, 'store'])->name('dashboard.crearuser.store');
    //Ruta de eliminacion de usuarios
    Route::post('/borrar-user', [borrarUserController::class, 'borrarAnfitrion'])->name('borrar.user');

    //rutas para la seccion de procesos
    Route::get('/Administracion/procesos', [procesosController::class, 'mostrarProcesos'])->name('dashboard.procesos');
    Route::post('/crear-proceso', [procesosController::class, 'crearProceso'])->name('crear.proceso');
    Route::post('/borrar-proceso', [procesosController::class, 'borrarProceso'])->name('borrar.proceso');
    Route::post('/modificar-proceso', [procesosController::class, 'modificar_proceso'])->name('modificar.proceso');
    //MODIFCADOR DE USUARIOS VISTA
    Route::get('/Administracion/Modificadoranfitriones', [vistaeditaranfitrionController::class, 'modificador'])->name('Administracion.Modificadoranfitriones');
    Route::get('/Administracion/buscador', [vistaeditaranfitrionController::class, 'buscador'])->name('Administracion.buscador');
    Route::get('/editar-anfitrion/{id}', [vistaeditaranfitrionController::class, 'editarAnfitrion'])->name('Administracion.editarAnfitrion');

    // ---------------------------------------------
    // RUTAS PARA EL MANEJO DE ARCHIVOS Y CARPETAS
    // ---------------------------------------------

    // Ruta para administrar una carpeta específica en una sección
    // Permite al administrador gestionar una carpeta dentro de una sección específica.
    // Requiere autenticación.
    Route::get('/admin/{seccion}/carpeta/{carpeta_id}', [AdminCarpetasController::class, 'administrarCarpeta'])
        ->name('admin.carpeta')
        ->middleware('auth');

    // Ruta para mostrar la vista principal del gestor de archivos
    // Muestra todas las carpetas principales y procesos disponibles.
    Route::get('/archivos', [ArchivoController::class, 'index'])->name('archivos.index');

    // Ruta para subir archivos al sistema
    // Permite a los usuarios subir archivos a una carpeta específica.
    Route::post('/archivos', [ArchivoController::class, 'store'])->name('archivos.store');

    // Ruta para crear una nueva carpeta
    // Permite crear carpetas principales o subcarpetas dentro de una carpeta existente.
    Route::post('/carpetas/crear', [CarpetasController::class, 'store'])->name('carpetas.store');

    // Ruta para eliminar una carpeta
    // Elimina una carpeta junto con sus archivos asociados.
    Route::delete('/carpetas/eliminar/{id}', [CarpetasController::class, 'destroy'])->name('carpetas.destroy');

    // Ruta para listar los archivos dentro de una carpeta específica
    // Muestra los archivos almacenados en una carpeta seleccionada.
    Route::get('/archivos/carpeta/{carpeta_id}', [ArchivoController::class, 'listarArchivosPorCarpeta'])
        ->name('archivos.list');

    // Ruta para obtener las subcarpetas de una carpeta específica
    // Devuelve las subcarpetas en formato JSON, útil para interfaces dinámicas.
    Route::get('/carpetas/{carpeta_id}/subcarpetas', [CarpetasController::class, 'getSubcarpetas']);

    // Ruta para listar todos los procesos
    // Devuelve todos los procesos en formato JSON, útil para integraciones o interfaces dinámicas.
    Route::get('/procesos/listar', [procesosController::class, 'obtenerProcesos']);

    // Ruta para obtener carpetas principales por subsección
    // Devuelve las carpetas principales de una subsección específica en formato JSON.
    Route::get('/carpetas/getBySubseccion', [CarpetasController::class, 'getBySubseccion']);

    // Ruta para descargar un archivo
    // Permite a los usuarios descargar un archivo si tienen los permisos necesarios.
    Route::get('/archivos/{id}/download', [ArchivoController::class, 'download'])
        ->name('archivos.download');

    // Ruta para eliminar (ocultar) un archivo
    // Marca un archivo como no visible sin eliminarlo físicamente.
    Route::delete('/archivos/{id}', [ArchivoController::class, 'destroy'])
        ->name('archivos.destroy');

    // Ruta para visualizar un archivo PDF en el navegador (CONSIDERAR ELIMIANR RUTA YA QUE NO SE UTILIZA)
    // Permite abrir un archivo PDF directamente en el navegador.
    // Requiere autenticación.
    Route::get('/archivo/{id}/ver-pdf', [ArchivoController::class, 'verPdf'])
        ->middleware('auth')
        ->name('archivos.verPdf');

    // Ruta para mostrar una imagen almacenada en el sistema
    // Devuelve una imagen almacenada en el sistema de archivos.
    Route::get('/archivos/imagen/{nombre}', [ArchivoController::class, 'imagen'])->name('archivos.imagen');

    // Ruta para ocultar un archivo
    // Cambia el estado de un archivo a "oculto" para que no sea visible en la interfaz.
    Route::post('/archivos/{id}/ocultar', [ArchivoController::class, 'ocultar'])->name('archivos.ocultar');

    // Ruta para restaurar un archivo previamente oculto
    // Cambia el estado de un archivo a "visible" para que vuelva a mostrarse en la interfaz.
    Route::post('/archivos/{id}/restaurar', [ArchivoController::class, 'restaurar'])->name('archivos.restaurar');

    Route::get('/archivos/{id}', [ArchivoController::class, 'show']);

    Route::post('/archivos/update', [ArchivoController::class, 'update'])->name('archivos.update');

    Route::get('/archivos/{id}/estado-firmas', [ArchivoController::class, 'estadoFirmas']);
    Route::get('/archivos/firmar/{id}', [ArchivoController::class, 'firmar'])->name('archivos.firmar');
    Route::post('/archivos/{id}/firmar', [ArchivoController::class, 'firmar']);
    Route::get('/archivos/{id}/responsables', [ArchivoController::class, 'responsablesPorArchivo'])->name('archivos.responsables');

    // Acceso al modulo de BCP
    Route::prefix('/bcp')->group(base_path('app/Modules/Bcp/Routes/RackRoutes.php'));
    // Acceso al modulo de bsc
    Route::prefix('/bsc')->group(base_path('app/Modules/Bsc/Routes/BscRoutes.php'));
    // Acceso al modulo de cafeteria-kali
    Route::prefix('/cafeteria-kali')->group(base_path('app/Modules/Cafeteria_kali/Routes/ChecadorRoutes.php'));
    // Acceso al modulo de control-documental
    Route::prefix('/control-documental')->group(base_path('app/Modules/Control_documental/Routes/ControldocumentalRoutes.php'));
    // Acceso al modulo de control-energetico
    Route::prefix('/control-energetico')->group(base_path('app/Modules/Control_energeticos/Routes/ControlenergeticosRoutes.php'));
    // Acceso al modulo de control-plan
    Route::prefix('/control-plan')->group(base_path('app/Modules/Control_plan/Routes/ControlplanRoutes.php'));
    // Acceso al modulo de historial-clinico
    Route::prefix('/historial-clinico')->group(base_path('app/Modules/Historial_clinico/Routes/HistorialclinicoRoutes.php'));
    // Acceso al modulo de mireservacion-eventos
    Route::prefix('/reservacion-eventos')->group(base_path('app/Modules/Mireservacion_eventos/Routes/MireservacioneventosRoutes.php'));
    // Acceso al modulo de residuos
    Route::prefix('/residuos')->group(base_path('app/Modules/Residuos/Routes/ResiduosRoutes.php'));
    // Acceso al modulo de revenue_reports
    Route::prefix('/revenue-reports')->group(base_path('app/Modules/Revenue_reports/Routes/RevenueRoutes.php'));
    // Acceso al modulo de accidentes y enfermedades
    Route::prefix('/accidentes-enfermedades')->group(base_path('app/Modules/Accidentes_enfermedades/Routes/accidentesRoutes.php'));





    // En web.php cambios Yoselin -------------------------------
    Route::get('/reportes', [Reportedecontroldeenergeticoscontroller::class, 'reportedecontroldeenergeticos'])->name('reportes');

    Route::post('/captura/agua', [Controldeaguacontroller::class, 'store'])
        ->name('captura.agua.store');

    Route::post('captura-energia', [Controldeenergiacontroller::class, 'store'])->name('captura.energia.store');

    Route::post('captura-aire', [Controldeairecontroller::class, 'store'])->name('captura.aire.store');

    // Para el módulo de control energético
    Route::prefix('control-energeticos')->group(function () {
        Route::get('/', [ControlenergeticosController::class, 'home'])->name('control.energeticos');
    });

    // Para obtener energéticos por módulo (API)
    Route::get('/api/energeticos/{modulo}', function ($modulo) {
        return response()->json(
            App\Modules\Control_energeticos\Models\Controlenergeticos::getByModulo($modulo)
        );
    });


    Route::get('/energeticos', [EnergeticoController::class, 'index'])->name('dashboard.energeticos');
    //----------------------------------------------
});
//no cambiar para nada//

Route::prefix('control-energeticos')->group(function () {
    // Ruta principal
    Route::get('/', [ControlenergeticosController::class, 'home'])->name('control.energeticos');

    // Rutas de administración
    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/', [ControlenergeticosController::class, 'adminEnergeticos'])
            ->name('control.energeticos.admin');

        // Rutas RESTful para CRUD
        Route::get('/energeticos', [ControlenergeticosController::class, 'energeticos'])
            ->name('control.energeticos.index');

        Route::post('/energeticos', [ControlenergeticosController::class, 'store'])
            ->name('control.energeticos.store');

        Route::put('/energeticos/{id}', [ControlenergeticosController::class, 'update'])
            ->name('control.energeticos.update');

        Route::delete('/energeticos/{id}', [ControlenergeticosController::class, 'destroy'])
            ->name('control.energeticos.destroy');
    });

    // API para obtener energéticos por módulo
    Route::get('/api/{modulo}', function ($modulo) {
        return response()->json(
            ControlenergeticosController::getEnergeticosPorModulo($modulo)
        );
    });
});




Route::get('/centros-consumo', [RackController::class, 'adminCentrosConsumo'])->name('bcp.admin.centros_consumo');

use App\Http\Controllers\AdminCentroConsumoController;

Route::get('/bcp/admin-racks/centros-consumo', [AdminCentroConsumoController::class, 'index'])->name('admincentrosconsumo.index');
Route::post('/bcp/admin-racks/centros-consumo', [AdminCentroConsumoController::class, 'store'])->name('admincentrosconsumo.store');

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

Route::put('/control-energeticos/{id}', [ControlenergeticosController::class, 'update'])
    ->name('control.energeticos.update');
// Autenticación (incluido por Laravel Breeze o Jetstream)
////////--------------------------------------------------------------JUAN CARLOS +----------------------------------------
// Rutas CRUD completas
Route::resource('accidentes', AccidenteController::class);
Route::resource('lesiones',  LesionController::class);
Route::resource('causas',     CausaController::class);
// Añade esto justo debajo
Route::resource('departamentos', DepartamentosController::class);
Route::get('/departamentos', [DepartamentosController::class, 'index'])
    ->name('departamentos.index');

// 1) Vista principal con menú (vacío)
Route::get(
    '/seguridadysalud/historial-clinico',
    [Historialclinicocontroller::class, 'historialclinico']
)->name('historialclinico.index');

// 2) “Nuevo Registro” → carga el formulario y le pasa $accidentes, $lesiones, $causas
Route::get(
    '/seguridadysalud/historial-clinico/formulario',
    [Historialclinicocontroller::class, 'create']
)->name('historialclinico.formulario');

Route::view('/admin/accidentes', 'administracion.accidentes')->name('dashboard.accidentes');
Route::view('/admin/lesiones', 'administracion.lesiones')->name('dashboard.lesiones');
Route::view('/admin/casos', 'administracion.casos')->name('dashboard.casos');




Route::prefix('api')->name('api.')->group(function () {
    Route::get('accidentes', [AccidenteController::class, 'index'])->name('accidentes');
    Route::get('lesiones',   [LesionController::class,   'index'])->name('lesiones');
    Route::get('causas',     [CausaController::class,    'index'])->name('causas');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // ——— Accidentes ———
    Route::get('accidentes',               [AccidenteController::class, 'listado'])->name('accidentes.index');
    Route::get('accidentes/create',        [AccidenteController::class, 'create'])->name('accidentes.create');
    Route::post('accidentes',              [AccidenteController::class, 'store'])->name('accidentes.store');
    Route::get('accidentes/{accidente}',   [AccidenteController::class, 'show'])->name('accidentes.show');
    Route::get('accidentes/{accidente}/edit', [AccidenteController::class, 'edit'])->name('accidentes.edit');
    Route::put('accidentes/{accidente}',   [AccidenteController::class, 'update'])->name('accidentes.update');
    Route::delete('accidentes/{accidente}', [AccidenteController::class, 'destroy'])->name('accidentes.destroy');

    // ——— Lesiones ———
    Route::get('lesiones',               [LesionController::class, 'listado'])->name('lesiones.index');
    Route::get('lesiones/create',        [LesionController::class, 'create'])->name('lesiones.create');
    Route::post('lesiones',              [LesionController::class, 'store'])->name('lesiones.store');
    Route::get('lesiones/{lesion}',      [LesionController::class, 'show'])->name('lesiones.show');
    Route::get('lesiones/{lesion}/edit', [LesionController::class, 'edit'])->name('lesiones.edit');
    Route::put('lesiones/{lesion}',      [LesionController::class, 'update'])->name('lesiones.update');
    Route::delete('lesiones/{lesion}',   [LesionController::class, 'destroy'])->name('lesiones.destroy');

    // ——— Causas ———
    Route::get('causas',               [CausaController::class, 'listado'])->name('causas.index');
    Route::get('causas/create',        [CausaController::class, 'create'])->name('causas.create');
    Route::post('causas',              [CausaController::class, 'store'])->name('causas.store');
    Route::get('causas/{causa}',       [CausaController::class, 'show'])->name('causas.show');
    Route::get('causas/{causa}/edit',  [CausaController::class, 'edit'])->name('causas.edit');
    Route::put('causas/{causa}',       [CausaController::class, 'update'])->name('causas.update');
    Route::delete('causas/{causa}',    [CausaController::class, 'destroy'])->name('causas.destroy');
});
/////////////////-/---------------------------------------------------------------------------------------////

// Rellena tu select por JS
Route::get('/departamentos', [DepartamentosController::class, 'index'])
    ->name('departamentos.index');

// k//////////////////////

// Devuelve departamentos según la propiedad (por su id)
// Antes era /propiedades/{propiedad}/departamentos
Route::get(
    '/propiedades/{propiedadId}/departamentos',
    [DepartamentosController::class, 'getByPropiedad']
)->name('departamentos.byPropiedad');



////////////////// -- Juan-- ///////////////////////////////////////////////
Route::get(
    'propiedades/{propiedadId}/departamentos',
    [DepartamentosController::class, 'getByPropiedad']
)->name('propiedades.departamentos');



Route::prefix('api')->name('api.')->group(function () {
    // ► Devuelve lista de áreas (propiedades)
    Route::get('propiedades', [vistaPropiedadesController::class, 'apiIndex'])
        ->name('propiedades');

    // ► Ya tenías: devuelve el departamento de una propiedad
    Route::get(
        'propiedades/{propiedadId}/departamentos',
        [DepartamentosController::class, 'getByPropiedad']
    )->name('propiedades.departamentos');


    // Listado global de puestos (opcional)
    Route::get('puestos', [PuestosController::class, 'apiIndex'])
        ->name('puestos');

    // Filtra puestos por departamento
    Route::get(
        'departamentos/{departamentoId}/puestos',
        [PuestosController::class, 'getByDepartamento']
    )->name('departamentos.puestos');
});




/////////////////////////////-- Formulario --////////////////////////////////
use App\Http\Controllers\Calidad\Seguridadysalud\FormularioAccidenteController;
////Route::post('/seguridadysalud/formulario/store', [FormularioAccidenteController::class, 'store'])->name('formulario.store');

///////// -- Lo del boton de acidentes y enfermedades -- ///////////
// Botón principal
Route::get('/accidentes-enfermedades', function () {
    return view('administracion.accidentes_enfermedades');
})->name('accidentes.enfermedades');

// Vistas tipo panel
Route::get('/admin/accidentes', [AccidenteController::class, 'listado'])->name('admin.accidentes.index');
Route::get('/admin/lesiones', [LesionController::class, 'listado'])->name('admin.lesiones.index');
Route::get('/admin/causas', [CausaController::class, 'listado'])->name('admin.causas.index');

/////////////////// -- Departamentos -- /////////////////////////

Route::get('/departamentos/{propiedadId}', [DepartamentosController::class, 'getByPropiedad']);

///////////////////// -- Puestos -- ////////////////////////////////

// Primero las rutas específicas
Route::get('/puestos/filtrar/{propiedadId}/{departamentoId}', [PuestosController::class, 'getByDepartamentoAndPropiedad']);
Route::get('/puestos/buscar/{departamentoId}/{propiedadId}/{termino}', [PuestosController::class, 'buscarPuestos']);

// Después las rutas generales
Route::get('/puestos/{id}', [PuestosController::class, 'show']);

Route::put('/puestos/{id}', [PuestosController::class, 'update']);
Route::delete('/puestos/{id}', [PuestosController::class, 'destroy']);

Route::get('/admin/puestos', [PuestosController::class, 'indexPuestos'])->name('puestos.index');
/////////////////////////////// Partes del cuerpo /////////////////
Route::get('/seguridadysalud/historial-clinico/crear', [Historialclinicocontroller::class, 'create'])->name('historialclinico.create');
Route::post('/seguridadysalud/historial-clinico', [Historialclinicocontroller::class, 'store'])->name('historialclinico.store');
Route::get('/historial/formulario', function () {
    return redirect()->route('historialclinico.create');
});

///////////////////////-- nueva ruta --/////////////////////
Route::post('/seguridadysalud/formulario/store', [FormularioAccidenteController::class, 'store'])->name('formulario.store');

////////////////////////////////////////////////////////////////////////--- Nuevo de Reportes --//////////////////////////


/////////////////////////////////////////////-- circulares--///////////////////////////////
use App\Http\Controllers\Administrador\ResponsableController;


Route::get('/administracion/responsable', [ResponsableController::class, 'index'])->name('responsable.index');
Route::post('/responsable/crear', [ResponsableController::class, 'crear'])->name('responsable.crear');
Route::post('/responsable/actualizar', [ResponsableController::class, 'actualizar'])->name('responsable.actualizar');
Route::post('/responsable/eliminar', [ResponsableController::class, 'eliminar'])->name('responsable.eliminar');

////////////////////////////////////////////-- Procesos y depas--//////////////////////////////////////////////
Route::get('/admin/departamentos', [DepartamentosController::class, 'indexAdmin']);
Route::get('/admin/departamentos', [DepartamentosController::class, 'indexAdmin'])->name('admin.departamentos');

////////////////////////////////////////// -- anfitriones --///////////////////////////////////////////////////

use App\Http\Controllers\Administrador\crearAnfitrionController as AnfitrionAJAXController;


Route::get('/anfitriones/departamentos/{id}', [AnfitrionAJAXController::class, 'getDepartamentos']);
Route::get('/anfitriones/puestos/{departamento_id}', [crearAnfitrionController::class, 'getPuestos']);

/////////////////////////////////////////////////////////////---------------AQUIIIIIII-JUANITO-------------------------------------------------------------------------
//-------------------------- Estadísticos --------------------------//
Route::prefix('seguridadysalud/estadisticos')->group(function () {
    // Vista principal
    Route::get('/', [LinealController::class, 'estadisticos'])
        ->name('seguridadysalud.estadisticos');

    // Datos JSON para AJAX
    Route::get('/data', [LinealController::class, 'datosEstadisticos'])
        ->name('seguridadysalud.estadisticos.data');

    // Exportar a PDF
    Route::post('/exportar-pdf', [LinealController::class, 'exportarEstadisticosPDF'])
        ->name('seguridadysalud.estadisticos.exportarPdf');

    // Exportar a Excel
    Route::post('/exportar-excel', [LinealController::class, 'exportarEstadisticosExcel'])
        ->name('seguridadysalud.estadisticos.exportarExcel');
});


///---mandar la informacion al formularion con nueva ruta---//
Route::get('/api/propiedades', [VistaPropiedadesController::class, 'apiIndex'])
    ->name('api.propiedades');


///---reporte---//

// Vista principal del reporte
Route::get('/seguridadysalud/reporte', [ReporteHistorialController::class, 'index'])
    ->name('seguridadysalud.reporte');

// Exportar TODOS a PDF (con filtros)
Route::get('/seguridadysalud/reporte/pdf', [ReporteHistorialController::class, 'exportPdf'])
    ->name('seguridadysalud.reporte.pdf');

// Exportar INDIVIDUAL a PDF (CORREGIDA la ruta)
Route::get('/seguridadysalud/reporte/pdf/individual/{id}', [ReporteHistorialController::class, 'exportPdfIndividual'])
    ->name('seguridadysalud.reporte.pdf.individual');

// Exportar TODOS a Excel (con filtros)
Route::get('/seguridadysalud/reporte/excel', [ReporteHistorialController::class, 'exportExcel'])
    ->name('seguridadysalud.reporte.excel');

// Exportar INDIVIDUAL a Excel
Route::get('/seguridadysalud/reporte/excel/individual/{id}', [ReporteHistorialController::class, 'exportExcelIndividual'])
    ->name('seguridadysalud.reporte.excel.individual');

// Editar un registro
Route::get('/seguridadysalud/reporte/{id}/edit', [ReporteHistorialController::class, 'edit'])
    ->name('seguridadysalud.reporte.edit');

// Actualizar un registro
Route::put('/seguridadysalud/reporte/{id}', [ReporteHistorialController::class, 'update'])
    ->name('seguridadysalud.reporte.update');

// Eliminar un registro
Route::delete('/seguridadysalud/reporte/{id}', [ReporteHistorialController::class, 'destroy'])
    ->name('seguridadysalud.reporte.destroy');


///////-----------------------------------------------------------------------------------------------------/////////-----







require __DIR__ . '/auth.php';
