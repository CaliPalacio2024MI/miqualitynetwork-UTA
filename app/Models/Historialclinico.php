<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historialclinico extends Model
{
    use HasFactory;

    protected $table = 'historial_clinico';

    protected $fillable = [
        // aquí pon todos los campos que vas a guardar desde el formulario
        'propiedad_id',
        'departamento_evento',
        'puesto_id',
        'fecha_reporte',
        'numero_caso',
        'nombre_lesionado',
        'numero_lesionado',
        'edad_lesionado',
        'genero_lesionado',
        'turno_lesionado',
        'telefono_lesionado',
        'puesto_actual',
        'antiguedad_empresa',
        'antiguedad_puesto',
        'tiempo_funcion',
        'direccion_particular',
        'actividad_accidente',
        // y todos los demás campos que uses...
        'otra_parte',
        // ...
    ];

    public function partesAfectadas()
    {
        return $this->hasMany(ParteAfectada::class, 'historial_id');
    }
}
