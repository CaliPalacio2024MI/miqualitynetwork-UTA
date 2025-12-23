<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Archivo extends Model
{

    use HasFactory;

    protected $table = 'archivos';  // Nombre de la tabla

    protected $primaryKey = 'id_archivo';  // Especificamos la clave primaria

    public $timestamps = true; 
    protected $fillable = [
        'id_archivo',
        'tiempo_numero',
        'tiempo_unidad',
        'nombre_archivo',
        'ruta_archivo',
        'tipoarchivo_mime',
        'tamano',
        'fecha_emision',
        'fechasubida',
        'seccion',
        'subseccion',
        'carpeta_id',
        'proceso_id',
        'updated_at',
        'tipo_proceso',
        'tipo_documento',
        'medio_soporte',
        'identificacion',
        'responsable_almacenamiento',
        'tiempo_conservacion',
        'disposicion_final',
        'edicion',
        'estatus_actual',
        'primera_vez',
        'cambio_realizado',
        'visible', // Campo para controlar si el archivo está visible
        'razon_eliminacion', // Razón de eliminación
        'fecha_eliminacion', // Fecha de eliminación
        'responsable_eliminacion', // Responsable de eliminación
        'nueva_edicion',
        'responsable_cambio',
        'nueva_fecha_emision',
        'se_ha_hecho_cambio',
    ];

    public function carpeta()
    {
        return $this->belongsTo(Carpetas::class, 'carpeta_id');
    }
    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id', 'id_proceso');
    }
}
