<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaOjos extends Model
{
    use HasFactory;
    protected $table = 'exploracion_ojos';

    protected $fillable = [
        'empleados_id',
        'conjuntivas',
        'pupilas',
        'parpados',
        'reflejos',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
