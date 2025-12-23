<?php

namespace App\Models\BCP;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogo';

    protected $primaryKey = 'N_Hab';
    public $incrementing = false;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'N_Hab',
        'Tp_Hab',
        'Edificio',
        'Piso',
        'Cred_Pasaje',
        'Cred_Salida',
        'Secciones',
        'Status'
    ];

    public function tipoStatus()
    {
        return $this->belongsTo(TipoStatus::class, 'Status', 'Codigo');
    }
}
