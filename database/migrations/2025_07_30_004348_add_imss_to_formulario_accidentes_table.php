<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('formulario_accidentes', function (Blueprint $table) {
            // Usamos enum para forzar solo esos tres valores
            $table->enum('imss', ['trayecto', 'interno', 'trabajo'])
                ->nullable()
                ->after('evento'); // lo insertamos justo después de 'evento'
        });
    }

    public function down()
    {
        Schema::table('formulario_accidentes', function (Blueprint $table) {
            $table->dropColumn('imss');
        });
    }
};
