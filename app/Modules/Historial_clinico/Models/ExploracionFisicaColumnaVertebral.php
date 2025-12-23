<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaColumnaVertebral extends Model
{
    use HasFactory;
    protected $table = 'exploracion_columna_vertebral';

    protected $fillable = [
        'empleados_id',
        'escoleosis',
        'evaluacion_escoleosis',
        'cifosis',
        'evaluacion_cifosis',
        'lordosis',
        'evaluacion_lordosis',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
