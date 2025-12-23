<?php

namespace App\Models\BCP;

use Illuminate\Database\Eloquent\Model;

class TipoStatus extends Model
{
    protected $table = 'tipo_status';
    protected $primaryKey = 'Codigo';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Nombre',
        'Color',
    ];
}
