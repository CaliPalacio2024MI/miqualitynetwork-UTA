<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin_centros_consumo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('propiedad');
            $table->string('categoria')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_centros_consumo');
    }
};
