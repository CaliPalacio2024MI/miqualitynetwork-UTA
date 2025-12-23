<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Bsc\Models\Bsc_Proceso_propiedad;
use App\Models\Proceso;
use App\Models\Propiedades;


class Bsc_Proceso extends Model
{
     protected $table = 'bsc_proceso';
    
    public function procesoPropiedad()
    {
        return $this->belongsTo(BscProcesoPropiedad::class, 'bsc_proceso_propiedad');
    }
    
    public function departamentos()
    {
        return $this->hasMany(BscDepartamento::class, 'bsc_proceso');
    }
}
