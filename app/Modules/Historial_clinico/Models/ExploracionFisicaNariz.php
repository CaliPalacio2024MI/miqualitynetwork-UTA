<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisicaNariz extends Model
{
    use HasFactory;
    protected $table = 'exploracion_nariz';

    protected $fillable = [
        'empleados_id',
        'tabique',
        'mucosas',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
