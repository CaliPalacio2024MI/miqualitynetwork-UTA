<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeredoFamiliares extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_heredofamiliares';

    protected $fillable = [
        'empleados_id',
        'fimicos',
        'luéticos',
        'diabéticos',
        'cardiópatas',
        'epilépticos',
        'oncologicos',
        'malf_congen',
        'atópicos',
        'otro'
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
