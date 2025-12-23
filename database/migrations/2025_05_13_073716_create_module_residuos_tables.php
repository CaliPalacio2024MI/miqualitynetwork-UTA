<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas_procedencia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('tipos_residuos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('color', 7);
            $table->decimal('precio', 10, 2)->default(0.00);
            $table->timestamps();
        });

        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->smallInteger('anio');
            $table->tinyInteger('mes');
            $table->foreignId('tipo_residuo_id')->constrained('tipos_residuos')->onDelete('cascade');
            $table->decimal('compra_kg', 10, 2);
            $table->timestamps();
        });

        Schema::create('poblaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->smallInteger('anio');
            $table->tinyInteger('mes');
            $table->date('fecha_fin');
            $table->integer('huespedes');
            $table->integer('anfitriones');
            $table->integer('visitantes');
            $table->integer('probedores');
            $table->integer('pax');
            $table->timestamps();
        });

        Schema::create('residuos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->decimal('kg', 10, 2)->nullable();
            $table->decimal('ton', 10, 2)->nullable();
            $table->decimal('precio_kg', 10, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->decimal('reciclado', 10, 2)->nullable();
            $table->integer('pax')->nullable();
            $table->decimal('residuo_por_pax', 5, 2)->nullable();
            $table->date('fecha');
            $table->timestamps();
        });

        Schema::create('residuos_entradas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_entrada');
            $table->timestamp('hora_entrada')->useCurrent();
            $table->foreignId('tipo_residuo_id')->constrained('tipos_residuos')->onDelete('cascade');
            $table->decimal('cantidad_kg', 10, 2);
            $table->decimal('cantidad_ton', 10, 4)->nullable();
            $table->string('observaciones')->nullable();
            $table->foreignId('area_procedencia_id')->constrained('areas_procedencia')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('residuos_salidas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_salida');
            $table->timestamp('hora_salida')->useCurrent();
            $table->foreignId('tipo_residuo_id')->constrained('tipos_residuos')->onDelete('cascade');
            $table->string('quien_se_lo_lleva');
            $table->string('testigo')->nullable();
            $table->decimal('cantidad_kg', 8, 2)->default(0.00);
            $table->timestamps();
            $table->foreignId('entrada_id')->nullable()->constrained('residuos_entradas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residuos_salidas');
        Schema::dropIfExists('residuos_entradas');
        Schema::dropIfExists('residuos');
        Schema::dropIfExists('poblaciones');
        Schema::dropIfExists('compras');
        Schema::dropIfExists('tipos_residuos');
        Schema::dropIfExists('areas_procedencia');
    }
};
