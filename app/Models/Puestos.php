<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proceso;

class Puestos extends Model
{
    use HasFactory;

    protected $table = 'puestos';

    protected $fillable = [
        'puesto',
        'departamento_id',
        'propiedad_id',
        'proceso_id', // ← nuevo campo agregado
    ];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id');
    }
}
