<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroConsumo extends Model
{
    protected $table = 'admin_centros_consumo'; // Tu tabla real

    protected $fillable = [
        'nombre',
        'propiedad',
        'categoria',
        'logo',
    ];
}
