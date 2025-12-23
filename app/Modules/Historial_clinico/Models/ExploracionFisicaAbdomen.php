<?php

namespace App\Modules\Historial_clinico\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaAbdomen extends Model
{
    use HasFactory;
    protected $table = 'exploracion_abdomen';

    protected $fillable = [
        'empleados_id',
        'megalias',
        'hernias',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
