<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilegios extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'privilegios';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_privilegio';

    /**
     * Indica si el ID es auto-incremental.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indica si las marcas de tiempo (timestamps) están habilitadas.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atributos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'acceso_calidad',
        'acceso_seguridadambiental',
        'acceso_seguridadysalud',
        'acceso_seguridadinformacion',
        'acceso_seguridadalimentaria',
        'acceso_contextoorg',
        'acceso_liderazgo',
        'acceso_planificacion',
        'acceso_apoyo',
        'acceso_documentacionmi',
        'acceso_mireservaciondeeventos',
        'acceso_controldocumental',
        'acceso_documentaciondelaoperacion',
        'acceso_procesosoperativos',
        'acceso_procesosdeapoyo',
        'acceso_evaldesempeño',
        'acceso_revenuereports',
        'acceso_balancescorecard',
        'acceso_mejora',
        'acceso_controlplanesdeaccion',
        'acceso_residuos',
        'acceso_controlderesiduos',
        'acceso_reportederesiduos',
        'acceso_energia',
        'acceso_controldeenergia',
        'acceso_informaciondeenergia',
        'acceso_agua',
        'acceso_controldeagua',
        'acceso_informaciondeagua',
        'acceso_aire',
        'acceso_controldeaire',
        'acceso_informaciondeaire',
        'acceso_comunidad',
        'acceso_ruido',
        'acceso_suelo',
        'acceso_recursosnaturales',
        'acceso_reportecontroldeenergeticos',
        'acceso_gestion',
        'acceso_atencionaemergencias',
        'acceso_higiene',
        'acceso_identificacionycontrolderiesgos',
        'acceso_prevencionentrabajospeligrosos',
        'acceso_perservaciondelasalud',
        'acceso_historialclinico',
        'acceso_drp',
        'acceso_controles',
        'acceso_riesgotecnologico',
        'acceso_mantenimiento',
        'acceso_bcp',
        'acceso_circulares',
        'acceso_cadenaalimentaria',
        'acceso_riesgosalimentarios',
        'acceso_manipulaciondealimentos',
        'acceso_medicion',
        'acceso_cafeteriadeanfitriones',
        'acceso_inocuidad',
        'acceso_accidentes_enfermedades',
        'user_id',
    ];



    /**
     * Relación con el modelo User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
