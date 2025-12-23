<?php

namespace App\Modules\Residuos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $table = 'residuos_salidas';

    protected $fillable = [
        'entrada_id',
        'tipo_residuo_id',
        'cantidad_kg',
        'fecha_salida',
        'quien_se_lo_lleva',
        'testigo'
    ];

    public function tipoResiduo()
    {
        return $this->belongsTo(TipoResiduo::class, 'tipo_residuo_id', 'id');
    }
}
