<?php

namespace App\Modules\Residuos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoResiduo extends Model
{
    use HasFactory;

    protected $table = 'tipos_residuos';

    protected $fillable = ['nombre', 'color', 'precio'];

    public function salidas()
    {
        return $this->hasMany(Salida::class, 'tipo_residuo_id', 'id');
    }
}
