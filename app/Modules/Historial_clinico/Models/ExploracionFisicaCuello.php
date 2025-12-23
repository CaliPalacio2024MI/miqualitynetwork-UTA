<?php

namespace App\Modules\Historial_clinico\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaCuello extends Model
{
    use HasFactory;
    protected $table = 'exploracion_cuello';

    protected $fillable = [
        'empleados_id',
        'ganglios',
        'movilidad',
        'tiroides',
        'pulsos',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
