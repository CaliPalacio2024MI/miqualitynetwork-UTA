<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formulario_accidentes', function (Blueprint $table) {
            $table->id();
            $table->string('evento')->nullable();
            $table->unsignedBigInteger('puesto_id')->nullable();
            $table->unsignedBigInteger('propiedad_id')->nullable();
            $table->string('departamento_evento')->nullable();
            $table->date('fecha_evento')->nullable();
            $table->time('hora_evento')->nullable();
            $table->date('fecha_reporte')->nullable();
            $table->string('numero_caso')->nullable();
            $table->string('nombre_lesionado')->nullable();
            $table->string('numero_lesionado')->nullable();
            $table->integer('edad_lesionado')->nullable();
            $table->string('genero_lesionado')->nullable();
            $table->string('turno_lesionado')->nullable();
            $table->string('telefono_lesionado')->nullable();
            $table->string('puesto_actual')->nullable();
            $table->string('antiguedad_empresa')->nullable();
            $table->string('antiguedad_puesto')->nullable();
            $table->string('tiempo_funcion')->nullable();
            $table->string('direccion_particular')->nullable();
            $table->string('actividad_accidente')->nullable();
            $table->string('auxilios')->nullable();
            $table->string('prescripcion')->nullable();
            $table->string('incapacidad')->nullable();
            $table->string('atencion')->nullable();
            $table->string('retiro')->nullable();
            $table->string('registrable')->nullable();
            $table->string('laboratorio')->nullable();
            $table->string('vendaje')->nullable();
            $table->string('restriccion')->nullable();
            $table->text('tipo_incapacidad')->nullable();
            $table->text('especificar_atencion')->nullable();
            $table->string('lesion')->nullable();
            $table->integer('dias_incapacidad')->nullable();
            $table->boolean('cabeza')->nullable();
            $table->boolean('ojo')->nullable();
            $table->boolean('oido')->nullable();
            $table->boolean('brazo')->nullable();
            $table->boolean('mano')->nullable();
            $table->boolean('espalda')->nullable();
            $table->boolean('dedos')->nullable();
            $table->boolean('pierna')->nullable();
            $table->boolean('cara')->nullable();
            $table->boolean('torso')->nullable();
            $table->text('otra_parte')->nullable();
            $table->string('accidente')->nullable();
            $table->string('agente_accidente')->nullable();
            $table->string('requiere_epp')->nullable();
            $table->string('usaba_epp')->nullable();
            $table->string('proporcion_epp')->nullable();
            $table->string('anfitrion_trabajando')->nullable();
            $table->string('capacitacion_puesto')->nullable();
            $table->string('conocimiento_puesto')->nullable();
            $table->string('postura_anfitrion')->nullable();
            $table->string('supervision')->nullable();
            $table->string('accidentes_previos')->nullable();
            $table->text('descripcion_dano')->nullable();
            $table->text('parte_afectada')->nullable();
            $table->string('costo_estimado')->nullable();
            $table->string('costo_real')->nullable();
            $table->text('descripcion_accidente')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('descripcion_escena')->nullable();
            $table->text('area_trabajo')->nullable();
            $table->text('equipos_usados')->nullable();
            $table->text('objetos_encontrados')->nullable();
            $table->string('causa')->nullable();
            $table->string('acto_inseguro')->nullable();
            $table->string('condiciones_inseguras')->nullable();
            $table->string('ambas')->nullable();
            $table->boolean('incapacidad_temporal')->nullable();
            $table->boolean('incapacidad_parcial')->nullable();
            $table->boolean('incapacidad_muerte')->nullable();
            $table->boolean('sin_incapacidad')->nullable();
            $table->boolean('no_especificada')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->string('responsable_recomendacion')->nullable();
            $table->date('fecha_recomendacion')->nullable();
            $table->string('aval_anfitrion')->nullable();
            $table->string('aval_supervisor')->nullable();
            $table->string('aval_patron')->nullable();
            $table->string('aval_trabajadores')->nullable();
            $table->text('signaturePadAnfitrion_data')->nullable();
            $table->text('signaturePadSupervisor_data')->nullable();
            $table->text('signaturePadPatron_data')->nullable();
            $table->text('signaturePadTrabajador_data')->nullable();
            $table->string('memoria_fotografica')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulario_accidentes');
    }
};
