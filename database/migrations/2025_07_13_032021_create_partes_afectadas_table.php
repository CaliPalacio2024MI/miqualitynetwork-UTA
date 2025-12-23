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
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('parte_cuerpo');
            $table->timestamps();
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
