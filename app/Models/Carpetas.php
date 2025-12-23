<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Carpetas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_carpeta',
        'seccion',
        'subseccion',
        'parent_id',
        'proceso_id',
        'ruta',
        'proceso',
    ];


    public function subcarpetas()
    {
        return $this->hasMany(Carpetas::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Carpetas::class, 'parent_id');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id');
    }
    protected static function boot()
{
    parent::boot();

    static::creating(function ($carpeta) {
        if (!$carpeta->ruta) {
            $carpeta->ruta = '';
        }
    });
}
}
