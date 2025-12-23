<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;



    protected $fillable = [
        'id_objetivo',
        'nombre_objetivo',
        'url_api',
        'resultado',
        'promedio_esperado',
    ];

    // Relación con la tabla de usuarios personalizados
    public function nombreObjetivo()
    {
        return $this->belongsTo(Objetivo::class, 'objetivo_id');
    }
}
