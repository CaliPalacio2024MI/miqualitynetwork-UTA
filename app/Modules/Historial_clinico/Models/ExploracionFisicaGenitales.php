<?php

namespace App\Modules\Historial_clinico\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaGenitales extends Model
{
    use HasFactory;
    protected $table = 'exploracion_genitales';

    protected $fillable = [
        'empleados_id',
        'fimosis',
        'varicocele',
        'hernias',
        'criptorquidias',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
