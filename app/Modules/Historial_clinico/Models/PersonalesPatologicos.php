<?php

namespace App\Modules\Historial_clinico\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalesPatologicos extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_patologicos';

    protected $fillable = [
        'empleados_id',
        'fimicos',
        'lueticos',
        'diabeticos',
        'renales',
        'cardiacos',
        'hipertensos',
        'atopicos',
        'lumbalgias',
        'traumaticos',
        'oncologicos',
        'epilepticos',
        'quirurgicos',
        'otro',
    ];


    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id');
    }
}
