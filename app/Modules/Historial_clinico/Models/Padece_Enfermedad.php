<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padece_Enfermedad extends Model
{
    use HasFactory;

    protected $table = 'padece_alguna_enfermedad';

    protected $fillable = [
        'empleados_id',
        'padece_enfermedad',
        'especifique_enfermedad',
        'mano_dominante',
        'firma',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
