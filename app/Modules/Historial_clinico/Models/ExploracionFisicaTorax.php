<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaTorax extends Model
{
    use HasFactory;
    protected $table = 'exploracion_torax';

    protected $fillable = [
        'empleados_id',
        'forma',
        'ritmos_Cardiacos',
        'campos_pulm',
        'mamas',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
