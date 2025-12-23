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
        Schema::create('historial_clinico', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('propiedad_id')->nullable();
            $table->unsignedBigInteger('departamento_evento')->nullable();
            $table->unsignedBigInteger('puesto_id')->nullable();

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
            $table->text('actividad_accidente')->nullable();
            $table->text('otra_parte')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_clinico');
    }
};
