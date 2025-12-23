<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Proceso;
use App\Models\Propiedades;


class Bsc_Proceso_propiedad extends Model
{
    protected $table = 'bsc_proceso_propiedad';

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
        'id_proceso',
        'id_propiedad'
    ];

     public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso', 'id_proceso');
    }
    
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id_propiedad');
    }
    
    public function bscProcesos()
    {
        return $this->hasMany(BscProceso::class, 'bsc_proceso_propiedad');
    }
}
