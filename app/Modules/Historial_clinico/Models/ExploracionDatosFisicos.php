<?php

namespace App\Modules\Historial_clinico\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionDatosFisicos extends Model
{
    use HasFactory;
    protected $table = 'datos_fisicos';

    protected $fillable = [
        'empleados_id',
        'fisico_peso',
        'fisico_talla',
        'fisico_ta',
        'fisico_fc',
        'fisico_fr',
        'fisico_imc',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
