<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationsToPuestosTable extends Migration
{
    public function up(): void
    {
        Schema::table('puestos', function (Blueprint $table) {
            // 1) Renombrar columna puesto → nombre_puesto
            if (Schema::hasColumn('puestos', 'puesto')) {
                $table->renameColumn('puesto', 'nombre_puesto');
            }

            // 2) Asegurarnos de que exista proceso_id
            if (! Schema::hasColumn('puestos', 'proceso_id')) {
                $table->unsignedBigInteger('proceso_id')
                    ->nullable()
                    ->after('propiedad_id');
            }

            // 3) Agregar FK de proceso_id → procesos.id_proceso
            $table->foreign('proceso_id', 'fk_puestos_proceso')
                ->references('id_proceso')
                ->on('procesos')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('puestos', function (Blueprint $table) {
            // 1) Eliminar FK
            $table->dropForeign('fk_puestos_proceso');

            // 2) Renombrar nombre_puesto → puesto
            if (Schema::hasColumn('puestos', 'nombre_puesto')) {
                $table->renameColumn('nombre_puesto', 'puesto');
            }

            // 3) Quitar columna proceso_id si la acabamos de agregar
            if (Schema::hasColumn('puestos', 'proceso_id')) {
                $table->dropColumn('proceso_id');
            }
        });
    }
}
