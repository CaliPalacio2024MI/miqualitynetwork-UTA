<?php

//namespace App\Models;
namespace App\Modules\Control_plan\Models;

use Illuminate\Database\Eloquent\Model;

class Acciones extends Model
{
    protected $table = 'acciones';

    protected $primaryKey = 'id_accion';

    public $timestamps = false; 
    protected $fillable = [
        'id_plan',
        'proceso',
        'o_mejora',
        'criterio',
        'c_raiz',
        'tipo_sol',
        'desc_sol',
        'costo',
        'observaciones',
        'fecha_creacion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'resultado',
        'fecha_cerrado'
    ];

    public function planes()
    {
        return $this->belongsTo(Planes::class, 'id_accion');
    }
}
