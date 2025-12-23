<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Energetico extends Model
{
    protected $table = 'control_energeticos_tables';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
        'unidad',
        'modulo',
        'color'
    ];

    // Relación con consumos (si aplica)
    public function consumos()
    {
        return $this->hasMany(Consumo::class, 'energetico_id');
    }
}