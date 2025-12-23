<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalesNoPatologicos extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_no_patologicos';
//SON LOS VALORES QUE ESTAN DEFINIDOS EN LA BASE DE DATOS
    protected $fillable = [
        'empleados_id',
        'no_patologicos_tabaquismo',
        'no_patologicos_tabaquismo_especifica',
        'no_patologicos_alcoholismo',
        'no_patologicos_alcoholismo_especifica',
        'no_patologicos_toxicomania',
        'no_patologicos_toxicomania_especifica',
        'no_patologicos_menarquia',
        'no_patologicos_ritmo',
        'no_patologicos_fum',
        'no_patologicos_disminorrea',
        'no_patologicos_ivsa',
        'no_patologicos_fup',
        'no_patologicos_doc',
        'no_patologicos_pf',
        'no_patologicos_g',
        'no_patologicos_p',
        'no_patologicos_c',
        'no_patologicos_a',
    ];

    // Relación con Empleado (un empleado tiene un solo registro de antecedentes heredofamiliares)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
