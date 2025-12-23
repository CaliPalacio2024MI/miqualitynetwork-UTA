<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('departamentos', function (Blueprint $table) {
            // Solo agregamos la foreign si la columna aún no existe
            if (!Schema::hasColumn('departamentos', 'propiedad_id')) {
                $table->unsignedInteger('propiedad_id')->nullable();
            }

            // Elimina o comenta la foreign key si ya causó problemas
            // $table->foreign('propiedad_id')
            //     ->references('id_propiedad')
            //     ->on('propiedades')
            //     ->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['propiedad_id']);
            $table->dropColumn('propiedad_id');
        });
    }
};
