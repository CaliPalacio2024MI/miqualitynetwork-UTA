<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('procesos', function (Blueprint $table) {
            $table->dropColumn(['responsable1', 'responsable2', 'responsable3']);
        });
    }

    public function down(): void
    {
        Schema::table('procesos', function (Blueprint $table) {
            $table->string('responsable1')->default('');
            $table->string('responsable2')->nullable();
            $table->string('responsable3')->nullable();
        });
    }
};