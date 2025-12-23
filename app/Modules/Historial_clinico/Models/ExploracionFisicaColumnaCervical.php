<?php

namespace App\Modules\Historial_clinico\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaColumnaCervical extends Model
{
    use HasFactory;
    protected $table = 'exploracion_columna_cervical';

    protected $fillable = [
        'empleados_id',
        'integridad',
        'integridad_observacion',
        'forma',
        'forma_observacion',
        'movimientos',
        'movimientos_observacion',
        'fuerza',
        'fuerza_observacion',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
