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
         // Crear tabla processes
         Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('id_propiedad')->nullable();

             $table->timestamps();
           $table->foreign('id_propiedad', 'fk_processes_propiedad')
                ->references('id_propiedad')->on('propiedades')
                ->onUpdate('no action')
                ->onDelete('no action');
           
        });

        // Crear tabla subprocesses
        Schema::create('subprocesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained('processes');
            $table->string('name');
            $table->timestamps();
        });

        // Crear tabla indicators
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subprocess_id')->constrained('subprocesses');
            $table->string('name');
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicators');
        Schema::dropIfExists('subprocesses');
        Schema::dropIfExists('processes');
    }
};
