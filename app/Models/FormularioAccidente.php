<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioAccidente extends Model
{
    use HasFactory;

    protected $table = 'formulario_accidentes';

    protected $fillable = [
        'evento',
        'puesto_id',
        'propiedad_id',
        'departamento_evento',
        'fecha_evento',
        'hora_evento',
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
        'auxilios',
        'prescripcion',
        'incapacidad',
        'atencion',
        'retiro',
        'registrable',
        'laboratorio',
        'vendaje',
        'restriccion',
        'tipo_incapacidad',
        'especificar_atencion',
        'lesion',
        'dias_incapacidad',
        'cabeza',
        'ojo',
        'oido',
        'brazo',
        'mano',
        'espalda',
        'dedos',
        'pierna',
        'cara',
        'torso',
        'otra_parte',
        'accidente',
        'agente_accidente',
        'requiere_epp',
        'usaba_epp',
        'proporcion_epp',
        'anfitrion_trabajando',
        'capacitacion_puesto',
        'conocimiento_puesto',
        'postura_anfitrion',
        'supervision',
        'accidentes_previos',
        'descripcion_dano',
        'parte_afectada',
        'costo_estimado',
        'costo_real',
        'descripcion_accidente',
        'observaciones',
        'descripcion_escena',
        'area_trabajo',
        'equipos_usados',
        'objetos_encontrados',
        'causa',
        'acto_inseguro',
        'condiciones_inseguras',
        'ambas',
        'incapacidad_temporal',
        'incapacidad_parcial',
        'incapacidad_muerte',
        'sin_incapacidad',
        'no_especificada',
        'recomendaciones',
        'responsable_recomendacion',
        'fecha_recomendacion',
        'aval_anfitrion',
        'aval_supervisor',
        'aval_patron',
        'aval_trabajadores',
        'signaturePadAnfitrion_data',
        'signaturePadSupervisor_data',
        'signaturePadPatron_data',
        'signaturePadTrabajador_data',
        'memoria_fotografica',
        'imss'
    ];
    public function propiedad()
    {
        return $this->belongsTo(\App\Models\Propiedades::class, 'propiedad_id', 'id_propiedad');
    }
}
