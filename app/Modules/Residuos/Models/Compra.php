<?php

namespace App\Modules\Residuos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'tipo_residuo_id',
        'compra_kg',
        'anio',
        'mes',
    ];

    public function tipo_residuo()
    {
        return $this->belongsTo(\App\Modules\Residuos\Models\TipoResiduo::class, 'tipo_residuo_id');
    }
}
