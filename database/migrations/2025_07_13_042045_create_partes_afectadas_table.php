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
        Schema::create('partes_afectadas', function (Blueprint $table) {
            $table->id();

            // Esta es la columna que está dando error porque no existe
            $table->unsignedBigInteger('historial_id');

            $table->string('parte_cuerpo');
            $table->timestamps();

            // Y esta es la relación con la tabla historial_clinico
            $table->foreign('historial_id')->references('id')->on('historial_clinico')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partes_afectadas');
    }
};
