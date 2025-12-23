<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'agentes';

    // Clave primaria de la tabla (si no es 'id')
    protected $primaryKey = 'id';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'agente',
    ];
}
