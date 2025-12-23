<?php

namespace App\Modules\Residuos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'residuos_entradas';

    protected $fillable = [
        'fecha_entrada',
        'tipo_residuo_id',
        'area_procedencia_id',
        'cantidad_kg',
        'observaciones'
    ];

    public function tipoResiduo()
    {
        return $this->belongsTo(TipoResiduo::class, 'tipo_residuo_id');
    }

    public function areaProcedencia()
    {
        return $this->belongsTo(AreaProcedencia::class, 'area_procedencia_id');
    }
}
