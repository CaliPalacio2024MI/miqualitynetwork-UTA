<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialLaboral extends Model
{
    use HasFactory;

    protected $table = 'historial_laboral';  // Este es el nombre de la tabla historial_laboral

    protected $fillable = [
        'empleados_id',
        'edad_inicio_labores',
        'empresas_laborado',
        'puestos_ocupados',
        'tiempo_laborado',
        'agentes',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }   
}
