<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaPiel extends Model
{
    use HasFactory;
    protected $table = 'exploracion_piel_anexos';

    protected $fillable = [
        'empleados_id',
        'nevos',
        'cicatrices',
        'varices',
        'edemas',
        'micosis',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
