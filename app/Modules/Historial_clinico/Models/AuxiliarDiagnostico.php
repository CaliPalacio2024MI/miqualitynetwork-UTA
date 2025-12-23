<?php

namespace App\Modules\Historial_clinico\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxiliarDiagnostico extends Model
{
    use HasFactory;

    protected $table = 'auxiliares_diagnosticos';

    protected $fillable = [
        'empleados_id',
        'radiografias',
        'torax',
        'col_lumbar',
        'laboratorio',
        'audiometria',
        'otros'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
