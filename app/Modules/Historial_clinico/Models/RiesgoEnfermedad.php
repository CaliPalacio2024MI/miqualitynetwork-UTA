<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiesgoEnfermedad extends Model
{
    use HasFactory;

    protected $table = 'incapacidad_por_enfermedad';

    protected $fillable = [
        'empleados_id',
        'enfermedad',
        'enfermedad_evaluacion',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
