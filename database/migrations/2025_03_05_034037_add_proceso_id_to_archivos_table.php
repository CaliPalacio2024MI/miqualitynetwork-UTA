<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('archivos', function (Blueprint $table) {
            $table->unsignedBigInteger('proceso_id')->nullable()->after('carpeta_id');
            $table->foreign('proceso_id')->references('id_proceso')->on('procesos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('archivos', function (Blueprint $table) {
            $table->dropForeign(['proceso_id']);
            $table->dropColumn('proceso_id');
        });
    }
};
