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
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropColumn('propiedad'); // ⚠️ Esto elimina la columna vieja
        });
    }

    public function down()
    {
        Schema::table('departamentos', function (Blueprint $table) {
            $table->string('propiedad')->nullable(); // O como estaba originalmente
        });
    }

};
