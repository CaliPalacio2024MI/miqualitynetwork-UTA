<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $table = 'consumos';
    
    protected $fillable = [
        'propiedad_id',
        'energetico_id',
        'cantidad_utilizada',
        'costo',
        'fecha'
    ];
    
    protected $dates = ['fecha'];
    
    public function propiedad()
    {
        return $this->belongsTo(\App\Core\Models\Propiedades::class, 'propiedad_id', 'id_propiedad');
    }
    
    public function energetico()
    {
        return $this->belongsTo(\App\Core\Models\Energetico::class, 'energetico_id');
    }
}