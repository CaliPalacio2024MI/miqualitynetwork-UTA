<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('procesos', function (Blueprint $table) {
            //
            $table->string('responsable1', 255)->default('')->after('updated_at');
            $table->string('responsable2', 255)->nullable()->after('responsable1');
            $table->string('responsable3', 255)->nullable()->after('responsable2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procesos', function (Blueprint $table) {
            //
            $table->dropColumn([
                'responsable1',
                'responsable2',
                'responsable3',
            ]);
        });
    }
};
