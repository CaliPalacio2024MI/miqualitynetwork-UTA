<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'peso',
        'property_id',
        'parent_id',
        'api_url',
        'indicador_key',
        'meta',
        'color'
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    // Relación con la propiedad
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Relación con el padre
    public function parent()
    {
        return $this->belongsTo(Objetivo::class, 'parent_id');
    }

    // Relación con los hijos
    public function children()
    {
        return $this->hasMany(Objetivo::class, 'parent_id');
    }

    // Generar URL completa con parámetros
    public function getFullApiUrlAttribute()
    {
        return $this->api_url;
    }

    // Configuración predeterminada del gráfico
    public function getChartConfigAttribute()
    {
        return [
            'type' => 'doughnut',
            'color' => $this->color ?? '#3c8dbc',
            'showValues' => true,
            'options' => [
                'cutoutPercentage' => 70,
                'legend' => [
                    'position' => 'right'
                ]
            ]
        ];
    }
    public function getChartDataAttribute()
{
    return [
        'departamento' => $this->meta['departamento'] ?? null,
        'datos' => [
            'resultado' => $this->meta['resultado'] ?? 0,
            'promedio_esperado' => $this->meta['promedio_esperado'] ?? 0,
            // Agrega más campos si es necesario
        ],
        'config' => [
            'type' => 'doughnut',
            'colors' => [
                $this->color, // Color principal del objetivo
                '#e0e0e0',    // Color de fondo
                '#ffcc00'     // Color para promedio esperado
            ]
        ]
    ];
}
}