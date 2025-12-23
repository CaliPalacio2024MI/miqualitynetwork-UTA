<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Bsc\Models\process;
use App\Models\Departamento;

class Propiedades extends Model
{
    protected $table = 'propiedades';
    protected $primaryKey = 'id_propiedad';
    public $timestamps = false;

    protected $fillable = [
        'id_propiedad',
        'nombre_propiedad',
        'departamento_id',
    ];

    // Relación a procesos existente
    public function processes()
    {
        return $this->hasMany(process::class, 'id_propiedad', 'id_propiedad');
    }

    // Nueva relación: cada propiedad pertenece a un departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }
}
