<?php

namespace App\Models\BCP;

use Illuminate\Database\Eloquent\Model;

class Asignada extends Model
{
    protected $table = 'asignadas';

    protected $primaryKey = null;   // No hay llave primaria
    public $incrementing = false;

    public $timestamps = false;     // No hay created_at ni updated_at

    protected $fillable = [
        'Sal_Pre',
        'N_Hab',
        'Tp_Hab',
        'Piso',
        'Status',
        'Tpo',
        'AD',
        'MN',
        'Creds',
        'Titular',
        'Camarista',
        'Fecha',
        'Hora',
    ];
}
