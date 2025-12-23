<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('archivos', function (Blueprint $table) {
            $table->string('tipo_documento', 100)->default('')->after('updated_at');
            $table->string('identificacion', 255)->default('')->after('tipo_documento');
            $table->string('responsable_almacenamiento', 255)->nullable()->after('identificacion');
            $table->string('tiempo_conservacion', 100)->default('')->after('responsable_almacenamiento');
            $table->string('disposicion_final', 100)->default('')->after('tiempo_conservacion');
            $table->string('edicion', 100)->default('')->after('disposicion_final');
            $table->string('estatus_actual', 100)->default('')->after('edicion');
            $table->boolean('se_ha_hecho_cambio')->default(0)->after('estatus_actual');
            $table->text('cambio_realizado')->nullable()->after(`se_ha_hecho_cambio`);
            $table->string('medio_soporte', 100)->default('')->after('cambio_realizado');
            $table->text('razon_eliminacion')->nullable()->after('medio_soporte');
            $table->date('fecha_eliminacion')->nullable()->after('razon_eliminacion');
            $table->string('responsable_eliminacion', 255)->nullable()->after('fecha_eliminacion');
            $table->string('tipo_proceso', 255)->nullable()->after('responsable_eliminacion');
            $table->date('fecha_emision')->nullable()->after('tipo_proceso');
            $table->string('nueva_edicion', 100)->nullable()->after('fecha_emision');
            $table->string('responsable_cambio', 100)->nullable()->after('nueva_edicion');
            $table->date('nueva_fecha_emision')->nullable()->after('responsable_cambio');
            $table->boolean('firma1')->default(0)->after('responsable_cambio');
            $table->boolean('firma2')->default(0)->after('firma1');
            $table->boolean('firma3')->default(0)->after('firma2');
            $table->timestamp('fechafirma1')->nullable()->after('firma1');
            $table->timestamp('fechafirma2')->nullable()->after('firma2');
            $table->timestamp('fechafirma3')->nullable()->after('firma3');
        });
    }

    public function down(): void
    {
        Schema::table('archivos', function (Blueprint $table) {
            $table->dropColumn([
                'tipo_documento',
                'identificacion',
                'responsable_almacenamiento',
                'tiempo_conservacion',
                'disposicion_final',
                'edicion',
                'estatus_actual',
                'se_ha_hecho_cambio',
                'cambio_realizado',
                'medio_soporte',
                'razon_eliminacion',
                'fecha_eliminacion',
                'responsable_eliminacion',
                'tipo_proceso',
                'fecha_emision',
                'nueva_edicion',
                'responsable_cambio',
                'nueva_fecha_edicion',
                'firma1',
                'firma2',
                'firma3',
                'fechafirma1',
                'fechafirma2',
                'fechafirma3',
            ]);
        });
    }
};
