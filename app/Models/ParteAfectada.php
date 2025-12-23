<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Historialclinico; // 👈 Asegúrate de importar el modelo

class ParteAfectada extends Model
{
    use HasFactory;

    protected $table = 'partes_afectadas';

    protected $fillable = [
        'historial_id',
        'parte_cuerpo',
    ];

    /**
     * Relación con el historial clínico
     */
    public function historial()
    {
        return $this->belongsTo(Historialclinico::class, 'historial_id');
    }
}
