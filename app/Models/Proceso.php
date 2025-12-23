<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carpetas;

class Proceso extends Model
{
    use HasFactory;

    protected $table = 'procesos';
    protected $primaryKey = 'id_proceso'; // ← ESTO es lo que Laravel necesita

    public $incrementing = true; // ← por si acaso Laravel se confunde
    protected $keyType = 'int';  // ← importante si no es string

    public $timestamps = true;

    protected $fillable = [
        'nombre_proceso',
        'tipo',
        'responsable1',
        'responsable2',
        'responsable3',
    ];

    public function carpetas()
    {
        return $this->hasMany(Carpetas::class, 'proceso_id');
    }
}
