<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proceso;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = ['departamento', 'propiedad_id', 'proceso_id'];

    // ✅ Relación: un departamento pertenece a un proceso
    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id', 'id_proceso');
    }
}
