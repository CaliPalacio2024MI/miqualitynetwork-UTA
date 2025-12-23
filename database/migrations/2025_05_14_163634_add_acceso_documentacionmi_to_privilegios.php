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
    Schema::table('privilegios', function (Blueprint $table) {
        $table->boolean('acceso_documentacionmi')->default(false)->after('acceso_apoyo');
    });
}

public function down()
{
    Schema::table('privilegios', function (Blueprint $table) {
        $table->dropColumn('acceso_documentacionmi');
    });
}

};
