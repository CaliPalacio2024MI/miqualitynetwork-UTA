<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaMiembroToracico extends Model
{
    use HasFactory;
    protected $table = 'exploracion_miembros_toracicos';

    protected $fillable = [
        'empleados_id',
        'integridad',
        'integridad_observacion',
        'forma',
        'forma_observacion',
        'articulaciones',
        'articulaciones_observacion',
        'tono_muscular',
        'tono_muscular_observacion',
        'reflejos',
        'reflejos_observacion',
        'sensibilidad',
        'sensibilidad_observacion',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
