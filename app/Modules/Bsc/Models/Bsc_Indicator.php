<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;


class Bsc_Indicator extends Model
{
    protected $table = 'bsc_indicador';

    protected $fillable = [
        'bsc_departamento_id',
        'name',
        'data'
    ];
    protected $casts = [
        'data' => 'array'
    ];
    
    public function departamento()
    {
        return $this->belongsTo(BscDepartamento::class, 'bsc_departamento_id');
    }

    public function setDataAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['data'] = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } else {
            $this->attributes['data'] = $value;
        }
    }
}
