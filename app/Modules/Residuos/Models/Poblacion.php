<?php

namespace App\Modules\Residuos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    use HasFactory;

    protected $table = 'poblaciones';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'huespedes',
        'anfitriones',
        'visitantes',
        'probedores',
        'pax',
        'anio',
        'mes',
    ];
}
