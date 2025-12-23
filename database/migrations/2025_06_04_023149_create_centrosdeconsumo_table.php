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
        Schema::create('centrosdeconsumo', function (Blueprint $table) {
            $table->id();
            $table->string('Propiedad', 100);
            $table->string('Centroconsumo', 100);
            $table->integer('Mesa');
            $table->integer('Habitacion')->nullable();
            $table->string('Huesped', 100)->nullable();
            $table->float('Pax')->nullable();
            $table->string('Mesero', 100)->nullable();
            $table->text('Categoria')->nullable();
            $table->text('Cantidad')->nullable();
            $table->text('Descripcion')->nullable();
            $table->text('Importe')->nullable();
            $table->decimal('Propina', 10, 2)->nullable();
            $table->decimal('Descuento', 10, 2)->nullable();
            $table->string('Forma_Pago', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centrosdeconsumo');
    }
};
