<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;


class Bsc_Department extends Model
{
    protected $table = 'bsc_departamento';
    
    public function proceso()
    {
        return $this->belongsTo(BscProceso::class, 'bsc_proceso');
    }
    
    public function indicadores()
    {
        return $this->hasMany(BscIndicador::class, 'bsc_departamento_id');
    }
}
