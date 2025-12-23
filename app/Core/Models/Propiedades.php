<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Propiedades  extends Model
{
    protected $table = 'propiedades';
    protected $primaryKey = 'id_propiedad';
    public $timestamps = false;

    protected $fillable = [
        'id_propiedad',
        'nombre_propiedad',
    ];
public function consumos()
{
    return $this->hasMany(Consumo::class, 'propiedad_id', 'id_propiedad');
}

}
