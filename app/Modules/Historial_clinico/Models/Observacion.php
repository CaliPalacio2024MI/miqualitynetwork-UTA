<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;

    protected $table = 'observaciones';

    protected $fillable = [
        'empleados_id',
        'diagnosticos',
        'recomendaciones',
        'evaluacion_satisfactoria',
        'fecha_formulario',
        'firma_formulario',
        'salud_ocupacional'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
